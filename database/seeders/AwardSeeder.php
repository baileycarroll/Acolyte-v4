<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Award::create(['name'=>'Atlassian Completed', 'description'=>'Awarded for completing the Atlassian course', 'filename'=>'Atlassian Completed.png']);
    }
}
