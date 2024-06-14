<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function createRole(Request $request) {
        $attributes = $request->validate([
           'role_name' => ['required', 'unique:roles,name']
        ]);
        Role::create(['name'=>$attributes['role_name']]);
        throw ValidationException::withMessages([
            'status'=>'Role Already Exists'
        ]);
        return redirect('/roles')->with('success', 'Role Created!');
    }
    public function createPermission(Request $request) {
        $attributes = $request->validate(['permission_name'=>['required', 'unique:permissions,name']]);
        Permission::create(['name'=>$attributes['permission_name']]);
        throw ValidationException::withMessages([
            'status'=>'Permission Already Exists'
        ]);
        return redirect('/permissions')->with('success', 'Permission Created!');
    }
    public function updateRole(Request $request) {
        $role = Role::find($request->role_id);
//        System Permissions
        if($request->ViewSystem == "on") {
            $role->givePermissionTo('ViewSystem');
        } else {
            $role->revokePermissionTo('ViewSystem');
        }
        if($request->ViewDeptSystem == "on") {
            $role->givePermissionTo('ViewDeptSystem');
        } else {
            $role->revokePermissionTo('ViewDeptSystem');
        }
        if($request->ViewSelfSystem == "on") {
            $role->givePermissionTo('ViewSelfSystem');
        }
        else {
            $role->revokePermissionTo('ViewSelfSystem');
        }
        if($request->UpdateSystem == "on") {
            $role->givePermissionTo('UpdateSystem');
        }
        else {
            $role->revokePermissionTo('UpdateSystem');
        }
        if($request->CreateSystem == "on") {
            $role->givePermissionTo('CreateSystem');
        } else {
            $role->revokePermissionTo('CreateSystem');
        }
//        Content
        if($request->ViewContent == "on") {
            $role->givePermissionTo('ViewContent');
        } else {
            $role->revokePermissionTo('ViewContent');
        }
        if($request->ViewDeptContent == "on") {
            $role->givePermissionTo('ViewDeptContent');
        } else {
            $role->revokePermissionTo('ViewDeptContent');
        }
        if($request->ViewSelfContent == "on") {
            $role->givePermissionTo('ViewSelfContent');
        }
        else {
            $role->revokePermissionTo('ViewSelfContent');
        }
        if($request->UpdateContent == "on") {
            $role->givePermissionTo('UpdateContent');
        }
        else {
            $role->revokePermissionTo('UpdateContent');
        }
        if($request->CreateContent == "on") {
            $role->givePermissionTo('CreateContent');
        } else {
            $role->revokePermissionTo('CreateContent');
        }
//        Grade
        if($request->ViewGrade == "on") {
            $role->givePermissionTo('ViewGrade');
        } else {
            $role->revokePermissionTo('ViewGrade');
        }
        if($request->ViewDeptGrade == "on") {
            $role->givePermissionTo('ViewDeptGrade');
        } else {
            $role->revokePermissionTo('ViewDeptGrade');
        }
        if($request->ViewSelfGrade == "on") {
            $role->givePermissionTo('ViewSelfGrade');
        }
        else {
            $role->revokePermissionTo('ViewSelfGrade');
        }
        if($request->UpdateGrade == "on") {
            $role->givePermissionTo('UpdateGrade');
        }
        else {
            $role->revokePermissionTo('UpdateGrade');
        }
        if($request->CreateGrade == "on") {
            $role->givePermissionTo('CreateGrade');
        } else {
            $role->revokePermissionTo('CreateGrade');
        }
//        Forum
        if($request->ViewForum == "on") {
            $role->givePermissionTo('ViewForum');
        } else {
            $role->revokePermissionTo('ViewForum');
        }
        if($request->ViewDeptForum == "on") {
            $role->givePermissionTo('ViewDeptForum');
        } else {
            $role->revokePermissionTo('ViewDeptForum');
        }
        if($request->ViewSelfForum == "on") {
            $role->givePermissionTo('ViewSelfForum');
        }
        else {
            $role->revokePermissionTo('ViewSelfForum');
        }
        if($request->UpdateForum == "on") {
            $role->givePermissionTo('UpdateForum');
        }
        else {
            $role->revokePermissionTo('UpdateForum');
        }
        if($request->CreateForum == "on") {
            $role->givePermissionTo('CreateForum');
        } else {
            $role->revokePermissionTo('CreateForum');
        }
//        Announcement
        if($request->ViewAnnounce == "on") {
            $role->givePermissionTo('ViewAnnounce');
        } else {
            $role->revokePermissionTo('ViewAnnounce');
        }
        if($request->ViewDeptAnnounce == "on") {
            $role->givePermissionTo('ViewDeptAnnounce');
        } else {
            $role->revokePermissionTo('ViewDeptAnnounce');
        }
        if($request->ViewSelfAnnounce == "on") {
            $role->givePermissionTo('ViewSelfAnnounce');
        }
        else {
            $role->revokePermissionTo('ViewSelfAnnounce');
        }
        if($request->UpdateAnnounce == "on") {
            $role->givePermissionTo('UpdateAnnounce');
        }
        else {
            $role->revokePermissionTo('UpdateAnnounce');
        }
        if($request->CreateAnnounce == "on") {
            $role->givePermissionTo('CreateAnnounce');
        } else {
            $role->revokePermissionTo('CreateAnnounce');
        }
        return redirect("/role_information/{$request->role_id}")->with('status', 'Role Permissions Updated');
    }
    public static function updateSupportUser() {
        $user = User::find(1);
        $role = Role::find(1);
        $role->syncPermissions(Permission::all());
        $user->assignRole($role->name);
    }
    public function giveAllPermissions($id) {
        Role::find($id)->syncPermissions(Permission::all());
        return redirect("/role_information/{$id}")->with('status', 'Role Permissions Updated');
    }
    public function deleteRole(Request $request) {
//        User::all()->removeRole(Role::find($request->role_id));
        Role::find($request->role_id)->delete();
        return redirect('/roles')->with('success', 'Role Deleted!');
    }
}
