<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DemoUserSeeder extends Seeder
{
    private const DEFAULT_PASSWORD = 'DemoPass123!';
    private const DEMO_LICENSE_START = '2026-01-01';
    private const DEMO_LICENSE_END = '2031-12-31';
    private const DEMO_TRIAL_END = '2027-12-31';

    /**
     * Seed stable demo personas with fixed credentials.
     */
    public function run(): void
    {
        $adminLicenseId = Licenses::where('name', 'Admin')->value('id');
        $standardLicenseId = Licenses::where('name', 'Standard Monthly')->value('id');
        $professionalLicenseId = Licenses::where('name', 'Professional Monthly')->value('id');

        $departmentIds = Department::query()->pluck('id', 'name');
        $learningStyleIds = Learning_Styles::query()->pluck('id', 'name');

        $personas = [
            [
                'email' => 'support@example.com',
                'roles' => ['Support'],
                'password' => config('app.support_password') ?: self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Acolyte',
                    'last_name' => 'Support',
                    'preferred_name' => 'Support Desk',
                    'phone' => '555-0100',
                    'primary_department' => $departmentIds['Support'],
                    'secondary_department' => $departmentIds['Training'],
                    'user_status' => 'Active',
                    'username' => 'acolyte',
                    'learning_style' => $learningStyleIds['Unknown'],
                    'license' => $adminLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'admin.demo@example.com',
                'roles' => ['Administrator'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Jordan',
                    'last_name' => 'Harper',
                    'preferred_name' => 'Jordan',
                    'phone' => '555-0101',
                    'primary_department' => $departmentIds['Operations'],
                    'secondary_department' => $departmentIds['Support'],
                    'user_status' => 'Active',
                    'username' => 'jharper-admin',
                    'learning_style' => $learningStyleIds['Visual'],
                    'license' => $adminLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDay()->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'morgan.lee@example.com',
                'roles' => ['Instructor'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Morgan',
                    'last_name' => 'Lee',
                    'preferred_name' => 'Morgan',
                    'phone' => '555-0102',
                    'primary_department' => $departmentIds['Training'],
                    'secondary_department' => $departmentIds['Operations'],
                    'user_status' => 'Active',
                    'username' => 'morgan.lee',
                    'learning_style' => $learningStyleIds['Collaborative'],
                    'license' => $professionalLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(2)->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'sam.rivera@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Sam',
                    'last_name' => 'Rivera',
                    'preferred_name' => 'Sam',
                    'phone' => '555-0201',
                    'primary_department' => $departmentIds['Support'],
                    'secondary_department' => null,
                    'user_status' => 'Active',
                    'username' => 'sam.rivera',
                    'learning_style' => $learningStyleIds['Visual'],
                    'license' => $standardLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDay()->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
        ];

        foreach ($personas as $persona) {
            $user = User::updateOrCreate(
                ['email' => $persona['email']],
                array_merge($persona['attributes'], [
                    'password' => Hash::make($persona['password']),
                    'email_verified_at' => now(),
                ])
            );

            $user->syncRoles($persona['roles']);
        }

        $this->seedDemoSubscriptions();
    }

    private function seedDemoSubscriptions(): void
    {
        $subscribedUsers = User::query()
            ->whereIn('email', [
                'morgan.lee@example.com',
                'sam.rivera@example.com',
            ])
            ->get();

        foreach ($subscribedUsers as $user) {
            $license = Licenses::findOrFail($user->license);
            $subscriptionId = DB::table('subscriptions')->where('user_id', $user->id)->value('id');
            $stripeSubscriptionId = 'sub_demo_'.str_pad((string) $user->id, 6, '0', STR_PAD_LEFT);
            $stripeItemId = 'si_demo_'.str_pad((string) $user->id, 6, '0', STR_PAD_LEFT);
            $subscriptionPayload = [
                'user_id' => $user->id,
                'name' => 'acolyte',
                'stripe_id' => $stripeSubscriptionId,
                'stripe_status' => $license->trial ? 'trialing' : 'active',
                'stripe_price' => $license->stripe_api_id,
                'quantity' => 1,
                'trial_ends_at' => $license->trial ? self::DEMO_TRIAL_END.' 00:00:00' : null,
                'ends_at' => null,
                'updated_at' => now(),
            ];

            if (Schema::hasColumn('subscriptions', 'type')) {
                $subscriptionPayload['type'] = 'acolyte';
            }

            if ($subscriptionId) {
                DB::table('subscriptions')->where('id', $subscriptionId)->update($subscriptionPayload);
            } else {
                $subscriptionId = DB::table('subscriptions')->insertGetId(array_merge(
                    $subscriptionPayload,
                    ['created_at' => now()]
                ));
            }

            $subscriptionItemPayload = [
                'subscription_id' => $subscriptionId,
                'stripe_id' => $stripeItemId,
                'stripe_product' => 'prod_demo_acolyte',
                'stripe_price' => $license->stripe_api_id,
                'quantity' => 1,
                'updated_at' => now(),
            ];

            $existingItemId = DB::table('subscription_items')
                ->where('subscription_id', $subscriptionId)
                ->value('id');

            if ($existingItemId) {
                DB::table('subscription_items')->where('id', $existingItemId)->update($subscriptionItemPayload);
            } else {
                DB::table('subscription_items')->insert(array_merge(
                    $subscriptionItemPayload,
                    ['created_at' => now()]
                ));
            }
        }

        $staleSubscriptionIds = DB::table('subscriptions')
            ->whereNotIn('user_id', $subscribedUsers->pluck('id'))
            ->where('name', 'acolyte')
            ->pluck('id');

        if ($staleSubscriptionIds->isNotEmpty()) {
            DB::table('subscription_items')
                ->whereIn('subscription_id', $staleSubscriptionIds)
                ->delete();

            DB::table('subscriptions')
                ->whereIn('id', $staleSubscriptionIds)
                ->delete();
        }
    }
}
