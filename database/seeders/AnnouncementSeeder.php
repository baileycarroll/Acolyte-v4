<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'content' => 'Welcome to the Acolyte v4 Demo! Please feel free to explore as you wish.',
            'department' => 1,
            'department_only' => 0,
            'expiration' => NULL
        ]);
    }
}
