<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function updateDepartment(Request $request) {
        $department = Department::findOrFail($request->department_id);
        $department->name = $request->department_name;
        $department->save();
        return redirect('/departments')->with('status', 'Department Updated!');
    }
    public function deleteDepartment(Request $request) {
        $department = Department::findOrFail($request->department_id);
        $department->delete();
        return redirect('/departments')->with('status', 'Department Deleted!');
    }
    public function addDepartment(Request $request) {
        $department = new Department;
        $department -> name = $request->department_name;
        $department->save();
        return redirect('/departments')->with('status', 'Department Created!');
    }
}
