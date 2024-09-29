<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions
        Permission::create(['name'=>'ViewSystem']);
        Permission::create(['name'=>'ViewDeptSystem']);
        Permission::create(['name'=>'ViewSelfSystem']);
        Permission::create(['name'=>'UpdateSystem']);
        Permission::create(['name'=>'CreateSystem']);
        Permission::create(['name'=>'DeleteSystem']);
        Permission::create(['name'=>'ViewContent']);
        Permission::create(['name'=>'ViewDeptContent']);
        Permission::create(['name'=>'ViewSelfContent']);
        Permission::create(['name'=>'UpdateContent']);
        Permission::create(['name'=>'CreateContent']);
        Permission::create(['name'=>'DeleteContent']);
        Permission::create(['name'=>'ViewGrade']);
        Permission::create(['name'=>'ViewDeptGrade']);
        Permission::create(['name'=>'ViewSelfGrade']);
        Permission::create(['name'=>'UpdateGrade']);
        Permission::create(['name'=>'CreateGrade']);
        Permission::create(['name'=>'DeleteGrade']);
        Permission::create(['name'=>'ViewForum']);
        Permission::create(['name'=>'ViewDeptForum']);
        Permission::create(['name'=>'ViewSelfForum']);
        Permission::create(['name'=>'UpdateForum']);
        Permission::create(['name'=>'CreateForum']);
        Permission::create(['name'=>'DeleteForum']);
        Permission::create(['name'=>'ViewAnnounce']);
        Permission::create(['name'=>'ViewDeptAnnounce']);
        Permission::create(['name'=>'ViewSelfAnnounce']);
        Permission::create(['name'=>'UpdateAnnounce']);
        Permission::create(['name'=>'CreateAnnounce']);
        Permission::create(['name'=>'DeleteAnnounce']);
    }
}
