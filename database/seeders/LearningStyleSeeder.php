<?php

namespace Database\Seeders;

use App\Models\Learning_Styles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Learning Styles
        Learning_Styles::create(['name'=>'Kinesthetic','description'=>'For users who learn best by doing.']);
        Learning_Styles::create(['name'=>'Visual','description'=>'For users who learn best by seeing.']);
        Learning_Styles::create(['name'=>'Auditory','description'=>'For users who learn best by hearing.']);
    }
}
