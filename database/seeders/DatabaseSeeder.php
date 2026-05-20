<?php

namespace Database\Seeders;

use App\Models\Content_Types;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\SetupKeys;
use App\Models\User;
use Hamcrest\Core\Set;
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
        // Departments
        $department = new Department();
        $department->name = "Support";
        $department->save();

        // Learning Styles
        $learning_style = new Learning_Styles();
        $learning_style->name = "Unknown";
        $learning_style->save();

        // Licenses
        $license = new Licenses();
        $license->name = "Trial";
        $license->description = "Trial License";
        $license->price = 0;
        $license->stripe_api_id = 0;
        $license->trial = 1;
        $license->admin = 0;
        $license->save();

        $license = new Licenses();
        $license->name = "Admin";
        $license->description = "Admin License";
        $license->price = 0;
        $license->stripe_api_id = 0;
        $license->trial = 0;
        $license->admin = 1;
        $license->save();

        // Permissions
        $permission =new Permission();
        $permission->name = "ViewSystem";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewDeptSystem";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewSelfSystem";
        $permission->save();
        $permission = new Permission();
        $permission->name = "CreateSystem";
        $permission->save();
        $permission =new Permission();
        $permission->name = "UpdateSystem";
        $permission->save();
        $permission = new Permission();
        $permission->name = "DeleteSystem";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ViewContent";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewDeptContent";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewSelfContent";
        $permission->save();
        $permission = new Permission();
        $permission->name = "UpdateContent";
        $permission->save();
        $permission = new Permission();
        $permission->name = "CreateContent";
        $permission->save();
        $permission = new Permission();
        $permission->name = "DeleteContent";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ViewGrade";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewDeptGrade";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewSelfGrade";
        $permission->save();
        $permission = new Permission();
        $permission->name = "UpdateGrade";
        $permission->save();
        $permission = new Permission();
        $permission->name = "CreateGrade";
        $permission->save();
        $permission = new Permission();
        $permission->name = "DeleteGrade";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ViewForum";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewDeptForum";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewSelfForum";
        $permission->save();
        $permission = new Permission();
        $permission->name = "UpdateForum";
        $permission->save();
        $permission = new Permission();
        $permission->name = "CreateForum";
        $permission->save();
        $permission = new Permission();
        $permission->name = "DeleteForum";
        $permission->save();

        $permission = new Permission();
        $permission->name = "ViewAnnounce";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewDeptAnnounce";
        $permission->save();
        $permission = new Permission();
        $permission->name = "ViewSelfAnnounce";
        $permission->save();
        $permission = new Permission();
        $permission->name = "UpdateAnnounce";
        $permission->save();
        $permission = new Permission();
        $permission->name = "CreateAnnounce";
        $permission->save();
        $permission = new Permission();
        $permission->name = "DeleteAnnounce";
        $permission->save();

        // Roles
        $role = Role::create(['name'=>'Support']);
        Role::find(1)->syncPermissions(Permission::all());
        $role = Role::create(['name'=>'User']);
        $role = Role::create(['name'=>'Administrator']);

        // Setup Keys
        $setup = new SetupKeys();
        $setup->key = "Primary Color";
        $setup->value = "#73020c";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "awards_at_class_complete";
        $setup->value = "0";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "instance_name";
        $setup->value = config('app.name');
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "allow_class_retakes";
        $setup->value = "0";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "allow_module_retakes";
        $setup->value = "0";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "Support_Email";
        $setup->value = "helpdesk@pattisparadoxes.com";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "use_subscriptions";
        $setup->value = "0";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "use_custom_frontend";
        $setup->value = "0";
        $setup->save();
        $setup = new SetupKeys();
        $setup->key = "num_custom_links";
        $setup->value = "0";
        $setup->save();


        // Support User
        $user = new User();
        $user->first_name = "Acolyte";
        $user->last_name = "Support";
        $user->phone = "775-470-2487";
        $user->email = "support@pattisparadoxes.com";
        $user->primary_department = Department::where('name', '=', "Support")->first()->id;
        $user->user_status = "Active";
        $user->username = "acolyte";
        $user->password = bcrypt(config('app.support_password'));
        $user->learning_style = Learning_Styles::where('name', '=', "Unknown")->first()->id;
        $user->license = Licenses::where('name', '=', "Admin")->first()->id;
        $user->license_ends = date('Y-m-d', strtotime(" +1 year"));
        $user->save();
        $user->assignRole('Support');
        $user->createAsStripeCustomer();

        // Content Types
        $ct = new Content_Types();
        $ct->name = 'Course';
        $ct->save();
        $ct = new Content_Types();
        $ct->name = 'Class';
        $ct->save();
    }
}
