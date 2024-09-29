<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Quiz;
use App\Models\User_Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classes::create([
            'department' => 2,
            'name' => 'Demo Class',
            'description' => 'Demo Course Information',
            'excerpt' => 'A demo class for Acolyte v4',
            'instructor' => 3,
            'status' => 'Active',
            'spotlight' => 1,
            'learning_style' => 1,
            'category_1' => 2,
            'content_type' => 2,
        ]);

        User_Content::create([
            'user' => 2,
            'class' => 1,
            'last_accessed' => '2022-01-01',
            'completed_on' => '2022-01-01',
        ]);

        Quiz::create([
            'class_id' => 1,
            'module_id' => null,
            'num_questions' => 3,
            'question_1' => 'This is a question?',
            'q1_opt_1' => 'Yes',
            'q1_opt_2' => 'No',
            'q1_opt_3' => 'Maybe',
            'q1_correct' => 'No',
            'question_2' => 'How many questions can the system have?',
            'q2_opt_1' => '3',
            'q2_opt_2' => '5',
            'q2_opt_3' => 'Unlimited',
            'q2_correct' => 'Unlimited',
            'question_3' => 'Acolyte R.E.A.L.M.S. - The acronym stands for?',
            'q3_opt_1' => 'Remote Engagement And Learning Management System',
            'q3_opt_2' => 'Rick Engaged All Live Money Styles',
            'q3_opt_3' => 'Read Every Animal Life Manual Style',
            'q3_correct' => 'Remote Engagement And Learning Management System',
        ]);
    }
}
