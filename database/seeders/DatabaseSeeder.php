<?php

namespace Database\Seeders;

use App\Models\Content_Types;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Licenses;
use App\Models\SetupKeys;
use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SetupKeySeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            DepartmentSeeder::class,
            LicenseSeeder::class,
            LearningStyleSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            ContentTypeSeeder::class,
            CourseSeeder::class,
            ModuleSeeder::class,
            ClassSeeder::class,
            DiscussionSeeder::class,
            ResourceTypeSeeder::class,
            ResourceSeeder::class,
            AwardSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
