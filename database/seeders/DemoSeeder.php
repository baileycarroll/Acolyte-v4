<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Seed the complete LMS demo dataset on top of the platform bootstrap data.
     */
    public function run(): void
    {
        $this->call([
            DatabaseSeeder::class,
            DemoBootstrapSeeder::class,
            DemoUserSeeder::class,
            DemoContentSeeder::class,
            DemoActivitySeeder::class,
            DemoMediaSeeder::class,
        ]);
    }
}
