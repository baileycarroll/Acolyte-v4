<?php

namespace Database\Seeders;

use App\Models\Licenses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Licenses
        Licenses::create(['name'=>'User', 'description'=>'User License', 'price'=>5.00, 'stripe_api_id'=>'prod_Qw4Nhp6LmUR7Ib', 'trial'=>0, 'admin'=>0]);
        Licenses::create(['name'=>'Admin', 'description'=>'Admin License', 'price'=>0, 'stripe_api_id'=>'', 'trial'=>0, 'admin'=>1]);
    }
}
