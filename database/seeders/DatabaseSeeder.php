<?php

namespace Database\Seeders;

use App\Models\Content_Types;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\SetupKeys;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $department = Department::firstOrCreate([
            'name' => 'Support',
        ]);

        $learningStyle = Learning_Styles::firstOrCreate([
            'name' => 'Unknown',
        ]);

        Licenses::updateOrCreate(
            ['name' => 'Trial'],
            [
                'description' => 'Trial License',
                'price' => 0,
                'stripe_api_id' => '0',
                'trial' => 1,
                'admin' => 0,
            ]
        );

        Licenses::updateOrCreate(
            ['name' => 'Admin'],
            [
                'description' => 'Admin License',
                'price' => 0,
                'stripe_api_id' => '0',
                'trial' => 0,
                'admin' => 1,
            ]
        );

        $permissionNames = [
            'ViewSystem',
            'ViewDeptSystem',
            'ViewSelfSystem',
            'CreateSystem',
            'UpdateSystem',
            'DeleteSystem',
            'ViewContent',
            'ViewDeptContent',
            'ViewSelfContent',
            'UpdateContent',
            'CreateContent',
            'DeleteContent',
            'ViewGrade',
            'ViewDeptGrade',
            'ViewSelfGrade',
            'UpdateGrade',
            'CreateGrade',
            'DeleteGrade',
            'ViewForum',
            'ViewDeptForum',
            'ViewSelfForum',
            'UpdateForum',
            'CreateForum',
            'DeleteForum',
            'ViewAnnounce',
            'ViewDeptAnnounce',
            'ViewSelfAnnounce',
            'UpdateAnnounce',
            'CreateAnnounce',
            'DeleteAnnounce',
        ];

        foreach ($permissionNames as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $supportRole = Role::firstOrCreate(['name' => 'Support']);
        $supportRole->syncPermissions(Permission::all());
        Role::firstOrCreate(['name' => 'User']);
        Role::firstOrCreate(['name' => 'Administrator']);

        $setupKeys = [
            'Primary Color' => '#73020c',
            'awards_at_class_complete' => '0',
            'instance_name' => config('app.name'),
            'allow_class_retakes' => '0',
            'allow_module_retakes' => '0',
            'Support_Email' => 'helpdesk@example.com',
            'use_subscriptions' => '0',
            'use_custom_frontend' => '0',
            'num_custom_links' => '0',
        ];

        foreach ($setupKeys as $key => $value) {
            SetupKeys::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $user = User::updateOrCreate(
            ['email' => 'support@example.com'],
            [
                'first_name' => 'Acolyte',
                'last_name' => 'Support',
                'phone' => '555-555-5555',
                'primary_department' => $department->id,
                'user_status' => 'Active',
                'username' => 'acolyte',
                'password' => bcrypt(config('app.support_password')),
                'learning_style' => $learningStyle->id,
                'license' => Licenses::where('name', 'Admin')->value('id'),
                'license_starts' => '2026-01-01',
                'license_origin' => '2026-01-01',
                'license_ends' => '2031-12-31',
            ]
        );

        $user->assignRole('Support');

        if (! $user->stripe_id && config('services.stripe.key') && config('services.stripe.secret')) {
            $user->createAsStripeCustomer();
        }

        Content_Types::firstOrCreate(['name' => 'Course']);
        Content_Types::firstOrCreate(['name' => 'Class']);
    }
}
