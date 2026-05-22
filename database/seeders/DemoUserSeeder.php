<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $trialLicenseId = Licenses::where('name', 'Trial')->value('id');
        $standardLicenseId = Licenses::where('name', 'Standard Monthly')->value('id');
        $professionalLicenseId = Licenses::where('name', 'Professional Monthly')->value('id');
        $enterpriseLicenseId = Licenses::where('name', 'Enterprise Monthly')->value('id');

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
                'email' => 'avery.shaw@example.com',
                'roles' => ['Instructor'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Avery',
                    'last_name' => 'Shaw',
                    'preferred_name' => 'Avery',
                    'phone' => '555-0103',
                    'primary_department' => $departmentIds['Sales'],
                    'secondary_department' => $departmentIds['Training'],
                    'user_status' => 'Active',
                    'username' => 'avery.shaw',
                    'learning_style' => $learningStyleIds['Reading/Writing'],
                    'license' => $enterpriseLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(3)->toDateString(),
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
            [
                'email' => 'jamie.chen@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Jamie',
                    'last_name' => 'Chen',
                    'preferred_name' => 'Jamie',
                    'phone' => '555-0202',
                    'primary_department' => $departmentIds['Operations'],
                    'secondary_department' => $departmentIds['Support'],
                    'user_status' => 'Active',
                    'username' => 'jamie.chen',
                    'learning_style' => $learningStyleIds['Reading/Writing'],
                    'license' => $professionalLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(5)->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'taylor.nguyen@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Taylor',
                    'last_name' => 'Nguyen',
                    'preferred_name' => 'Taylor',
                    'phone' => '555-0203',
                    'primary_department' => $departmentIds['Sales'],
                    'secondary_department' => null,
                    'user_status' => 'Active',
                    'username' => 'taylor.nguyen',
                    'learning_style' => $learningStyleIds['Kinesthetic'],
                    'license' => $standardLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(1)->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'riley.brooks@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Riley',
                    'last_name' => 'Brooks',
                    'preferred_name' => 'Riley',
                    'phone' => '555-0204',
                    'primary_department' => $departmentIds['Human Resources'],
                    'secondary_department' => $departmentIds['Training'],
                    'user_status' => 'Active',
                    'username' => 'riley.brooks',
                    'learning_style' => $learningStyleIds['Collaborative'],
                    'license' => $enterpriseLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(4)->toDateString(),
                    'trial_ends_at' => null,
                ],
            ],
            [
                'email' => 'casey.patel@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Casey',
                    'last_name' => 'Patel',
                    'preferred_name' => 'Casey',
                    'phone' => '555-0205',
                    'primary_department' => $departmentIds['Training'],
                    'secondary_department' => null,
                    'user_status' => 'Active',
                    'username' => 'casey.patel',
                    'learning_style' => $learningStyleIds['Visual'],
                    'license' => $trialLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_TRIAL_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(6)->toDateString(),
                    'trial_ends_at' => self::DEMO_TRIAL_END,
                ],
            ],
            [
                'email' => 'devon.kim@example.com',
                'roles' => ['User'],
                'password' => self::DEFAULT_PASSWORD,
                'attributes' => [
                    'first_name' => 'Devon',
                    'last_name' => 'Kim',
                    'preferred_name' => 'Devon',
                    'phone' => '555-0206',
                    'primary_department' => $departmentIds['Support'],
                    'secondary_department' => $departmentIds['Operations'],
                    'user_status' => 'Inactive',
                    'username' => 'devon.kim',
                    'learning_style' => $learningStyleIds['Reading/Writing'],
                    'license' => $standardLicenseId,
                    'license_starts' => self::DEMO_LICENSE_START,
                    'license_ends' => self::DEMO_LICENSE_END,
                    'license_origin' => self::DEMO_LICENSE_START,
                    'last_active' => now()->subDays(45)->toDateString(),
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
                'avery.shaw@example.com',
                'sam.rivera@example.com',
                'jamie.chen@example.com',
                'taylor.nguyen@example.com',
                'riley.brooks@example.com',
                'casey.patel@example.com',
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
