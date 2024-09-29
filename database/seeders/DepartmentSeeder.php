<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Departments
        Department::create(['name'=>'Acolyte Support']);
        Department::create(['name'=>'Sales']);
        Department::create(['name'=>'IT']);
        Department::create(['name'=>'Engineering']);
    }
}
