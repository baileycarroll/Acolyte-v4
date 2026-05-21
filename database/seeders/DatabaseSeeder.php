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

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Departments
        $department = Department::firstOrCreate([
            'name' => 'Support',
        ]);

        // Learning Styles
        $learning_style = Learning_Styles::firstOrCreate([
            'name' => 'Unknown',
        ]);

        // Licenses
        Licenses::updateOrCreate(
            ['name' => 'Trial'],
            [
                'description' => 'Trial License',
                'price' => 0,
                'stripe_api_id' => 0,
                'trial' => 1,
                'admin' => 0,
            ]
        );

        Licenses::updateOrCreate(
            ['name' => 'Admin'],
            [
                'description' => 'Admin License',
                'price' => 0,
                'stripe_api_id' => 0,
                'trial' => 0,
                'admin' => 1,
            ]
        );

        // Permissions
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

        // Roles
        $supportRole = Role::firstOrCreate(['name' => 'Support']);
        $supportRole->syncPermissions(Permission::all());
        Role::firstOrCreate(['name' => 'User']);
        Role::firstOrCreate(['name' => 'Administrator']);

        // Setup Keys
        $setupKeys = [
            'Primary Color' => '#73020c',
            'awards_at_class_complete' => '0',
            'instance_name' => config('app.name'),
            'allow_class_retakes' => '0',
            'allow_module_retakes' => '0',
            'Support_Email' => 'helpdesk@pattisparadoxes.com',
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


        // Support User
        $user = User::updateOrCreate(
            ['email' => 'support@pattisparadoxes.com'],
            [
                'first_name' => 'Acolyte',
                'last_name' => 'Support',
                'phone' => '775-470-2487',
                'primary_department' => $department->id,
                'user_status' => 'Active',
                'username' => 'acolyte',
                'password' => bcrypt(config('app.support_password')),
                'learning_style' => $learning_style->id,
                'license' => Licenses::where('name', '=', 'Admin')->first()->id,
                'license_ends' => date('Y-m-d', strtotime(' +1 year')),
            ]
        );

        $user->assignRole('Support');
        if (! $user->stripe_id && config('services.stripe.key') && config('services.stripe.secret')) {
            $user->createAsStripeCustomer();
        }

        // Content Types
        Content_Types::firstOrCreate(['name' => 'Course']);
        Content_Types::firstOrCreate(['name' => 'Class']);
    }
}
