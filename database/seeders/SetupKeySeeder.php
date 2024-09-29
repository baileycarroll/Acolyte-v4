<?php

namespace Database\Seeders;

use App\Models\SetupKeys;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetupKeys::create(['key' => 'Primary Color', 'value' => '#73020c']);
        SetupKeys::create(['key' => 'awards_at_class_complete', 'value' => '0']);
        SetupKeys::create(['key' => 'instance_name', 'value' => config('app.name')]);
        SetupKeys::create(['key' => 'allow_class_retakes', 'value' => '0']);
        SetupKeys::create(['key' => 'allow_module_retakes', 'value' => '0']);
        SetupKeys::create(['key' => 'Support_Email', 'value' => 'support@acolyte.com']);
        SetupKeys::create(['key' => 'use_subscriptions', 'value' => '0']);
        SetupKeys::create(['key' => 'use_custom_frontend', 'value' => '0']);
        SetupKeys::create(['key' => 'num_custom_links', 'value' => '0']);
    }
}
