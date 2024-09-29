<?php

namespace Database\Seeders;

use App\Models\Resource_Types;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resource_Types::create(['name'=>'PDF']);
        Resource_Types::create(['name'=>'Video']);
        Resource_Types::create(['name'=>'Link']);
    }
}
