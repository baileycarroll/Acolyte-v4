<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        Role::create(['name'=>'Support']);
        Role::find(1)->syncPermissions(Permission::all());
        Role::create(['name'=>'User']);
        Role::create(['name'=>'Instructor']);
        Role::create(['name'=>'Administrator']);
    }
}
