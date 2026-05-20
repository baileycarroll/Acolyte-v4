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
    public static function getDepartments() {
        return Department::query()->select('id', 'name', 'updated_at')->paginate(10);
    }
    public static function getCountDepts() {
        return Department::all()->count();
    }
    public static function showDepartments() {
        return view('sessions.admin.departments',[
            'numUsersWithDepts' => UserController::getCountUsersWithDepts(),
            'numDepts' => self::getCountDepts(),
            'numUsersWithoutDepts' => UserController::getCountUsersWithoutDepts(),
            'departments' => DepartmentController::getDepartments()
        ]);
    }
    public static function departmentInformation($id) {
        return view('sessions.admin.department_information', ['department' => Department::find($id)]);
    }
    public static function departmentInformationRead($id) {
        return view('sessions.admin.department_information_readonly', ['department' => Department::find($id)]);
    }
}
