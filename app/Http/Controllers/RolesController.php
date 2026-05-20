<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use function Aws\boolean_value;

class RolesController extends Controller
{
    public static function updateRole(Request $request) {
        $role = Role::find($request->role_id);
        $role->name = $request->name;
        $role->description = $request->description;

//        User Permissions
        $role->user_delete = 0;
        $role->user_view = intval(boolean_value($request->user_view));
        $role->user_view_dept = intval(boolean_value($request->user_view_dept));
        $role->user_view_self = intval(boolean_value($request->user_view_self));
        $role->user_create = intval(boolean_value($request->user_create));
        $role->user_update = intval(boolean_value($request->user_update));
//        Content Permissions
        $role->content_delete = 0;
        $role->content_view = intval(boolean_value($request->content_view));
        $role->content_view_dept = intval(boolean_value($request->content_view_dept));
        $role->content_view_self = intval(boolean_value($request->content_view_self));
        $role->content_create = intval(boolean_value($request->content_create));
        $role->content_update = intval(boolean_value($request->content_update));
//        Announcement Permissions
        $role->announce_delete = 0;
        $role->announce_view = intval(boolean_value($request->announce_view));
        $role->announce_view_dept = intval(boolean_value($request->announce_view_dept));
        $role->announce_view_self = intval(boolean_value($request->announce_view_self));
        $role->announce_create = intval(boolean_value($request->announce_create));
        $role->announce_update = intval(boolean_value($request->announce_update));
//        Grade Permissions
        $role->grade_delete = 0;
        $role->grade_view = intval(boolean_value($request->grade_view));
        $role->grade_view_dept = intval(boolean_value($request->grade_view_dept));
        $role->grade_view_self = intval(boolean_value($request->grade_view_self));
        $role->grade_create = intval(boolean_value($request->grade_create));
        $role->grade_update = intval(boolean_value($request->grade_update));
//        Forum Permissions
        $role->forum_delete = 0;
        $role->forum_view = intval(boolean_value($request->forum_view));
        $role->forum_view_dept = intval(boolean_value($request->forum_view_dept));
        $role->forum_view_self = intval(boolean_value($request->forum_view_self));
        $role->forum_create = intval(boolean_value($request->forum_create));
        $role->forum_update = intval(boolean_value($request->forum_update));
//        System Permissions
        $role->system_delete = 0;
        $role->system_view = intval(boolean_value($request->system_view));
        $role->system_view_dept = intval(boolean_value($request->system_view_dept));
        $role->system_view_self = intval(boolean_value($request->system_view_self));
        $role->system_create = intval(boolean_value($request->system_create));
        $role->system_update = intval(boolean_value($request->system_update));

        $role->save();
        return redirect('/roles')->with('status', 'Role Updated!');
    }
}
