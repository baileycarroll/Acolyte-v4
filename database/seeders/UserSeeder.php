<?php

namespace Database\Seeders;

use App\Models\Licenses;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Support User
        $user = new User();
        $user->first_name = "Acolyte";
        $user->last_name = "Demo";
        $user->phone = "206-555-5555";
        $user->email = "support@acolyte.com";
        $user->primary_department = 1;
        $user->user_status = "Active";
        $user->username = "acolyte";
        $user->password = bcrypt(config('app.support_password'));
        $user->learning_style = 1;
        $user->license = Licenses::where('name', '=', "Admin")->first()->id;
        $user->license_ends = date('Y-m-d', strtotime(" +1 year"));
        $user->save();
        $user->assignRole('Support');

        // Basic User
        $user = new User();
        $user->first_name = "Acolyte";
        $user->last_name = "User";
        $user->phone = "206-555-5550";
        $user->email = "user@acolyte.com";
        $user->primary_department = 1;
        $user->user_status = "Active";
        $user->username = 'User';
        $user->password = bcrypt('User');
        $user->learning_style = 1;
        $user->license = Licenses::where('name', '=', 'Admin')->first()->id;
        $user->license_ends = date('Y-m-d', strtotime(" +1 year"));
        $user->save();
        $user->assignRole('User');

        // Instructor User
        $user = new User();
        $user->first_name = "Acolyte";
        $user->last_name = "Instructor";
        $user->phone = "206-555-5551";
        $user->email = "instructor@acolyte.com";
        $user->primary_department = 1;
        $user->user_status = "Active";
        $user->username = 'Instructor';
        $user->password = bcrypt('Instructor');
        $user->learning_style = 1;
        $user->license = Licenses::where('name', '=', 'Admin')->first()->id;
        $user->license_ends = date('Y-m-d', strtotime(" +1 year"));
        $user->save();
        $user->assignRole('Instructor');

        // Admin User
        $user = new User();
        $user->first_name = "Acolyte";
        $user->last_name = "Admin";
        $user->phone = "206-555-5552";
        $user->email = "admin@acolyte.com";
        $user->primary_department = 1;
        $user->user_status = "Active";
        $user->username = 'Admin';
        $user->password = bcrypt('Admin');
        $user->learning_style = 1;
        $user->license = Licenses::where('name', '=', 'Admin')->first()->id;
        $user->license_ends = date('Y-m-d', strtotime(" +1 year"));
        $user->save();
        $user->assignRole('Administrator');
    }
}
