<?php

namespace Database\Seeders;

use App\Models\Student_Resources;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student_Resources::create(['name'=>'Demo PDF', 'description'=>'A Basic Template PDF Taken from Google Docs',
            'url'=>'https://drive.google.com/file/d/196hdn7ZpJrlrbqx6OB8_582f86PaIPMO/view?usp=sharing', 'type'=>1]);
        Student_Resources::create(['name'=>'Demo Video', 'description'=>'A Basic Template Video Taken from YouTube',
            'url'=>'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'type'=>2]);
        Student_Resources::create(['name'=>'Demo Link', 'description'=>'A Basic Template Link Taken from Google',
            'url'=>'https://www.google.com', 'type'=>3]);
    }
}
