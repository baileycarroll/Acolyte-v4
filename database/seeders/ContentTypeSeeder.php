<?php

namespace Database\Seeders;

use App\Models\Content_Types;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Content Types
        Content_Types::create(['name'=>'Course']);
        Content_Types::create(['name'=>'Class']);
    }
}
