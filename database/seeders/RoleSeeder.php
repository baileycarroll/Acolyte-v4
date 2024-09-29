<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        Role::create(['name'=>'Support']);
        Role::find(1)->syncPermissions(Permission::all());
        Role::create(['name'=>'User']);
        $rolesPermissions = [
            'Administrator' => [
                'ViewSystem', 'ViewDeptSystem', 'ViewSelfSystem', 'UpdateSystem', 'CreateSystem', 'DeleteSystem',
                'ViewContent', 'ViewDeptContent', 'ViewSelfContent', 'UpdateContent', 'CreateContent', 'DeleteContent',
                'ViewGrade', 'ViewDeptGrade', 'ViewSelfGrade', 'UpdateGrade', 'CreateGrade', 'DeleteGrade',
                'ViewForum', 'ViewDeptForum', 'ViewSelfForum', 'UpdateForum', 'CreateForum', 'DeleteForum',
                'ViewAnnounce', 'ViewDeptAnnounce', 'ViewSelfAnnounce', 'UpdateAnnounce', 'CreateAnnounce', 'DeleteAnnounce'
            ],
            'Instructor' => [
                'ViewContent', 'ViewDeptContent', 'ViewSelfContent', 'UpdateContent', 'CreateContent',
                'ViewAnnounce', 'ViewDeptAnnounce', 'ViewSelfAnnounce', 'UpdateAnnounce', 'CreateAnnounce',
                'ViewGrade', 'ViewDeptGrade', 'ViewSelfGrade', 'UpdateGrade', 'CreateGrade',
                'ViewForum', 'ViewDeptForum', 'ViewSelfForum', 'UpdateForum', 'CreateForum'
            ],
        ];

        // Create roles and assign permissions
        foreach ($rolesPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
