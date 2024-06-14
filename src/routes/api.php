<?php


use App\Models\Award;
use App\Models\Category;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Department;
use App\Models\discussions;
use App\Models\Gradebook;
use App\Models\Learning_Style;
use App\Models\Licenses;
use App\Models\Module;
use App\Models\Resource_Types;
use App\Models\SetupKeys;
use App\Models\Student_Resources;
use App\Models\User_Award;
use App\Models\User_Content;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getUsers', function() {
    return User::ajaxUsers();
});
Route::get('/getUsersRole/{id}', function($id) {
    return User::getUsersWithRole($id);
});
Route::get('/getAwards', function () {
    return array_values(Award::all()->toArray());
});


Route::get('/getRoles', function() {
    return array_values(Role::where('id', '!=', '1')->get()->toArray());
});
Route::get('/getPermissions', function() {
    return array_values(Permission::all()->toArray());
});
// Awards
Route::get('/getUsersWithAward/{id}', function ($id) {
    return User_Award::getUsersWithAward($id);
});
Route::get('/getUserAwards/{user}', function($user) {
   return User_Award::getUsersAwards($user);
});
Route::get('/getUserCourses/{user}', function($user) {
    return User_Content::getUsersCourses($user);
});
Route::get('/getUserTranscripts/{user}', function($user) {
   return Gradebook::getTranscripts($user);
});
// Classes
Route::get('/getClasses', function() {
   return array_values(Classes::getClasses());
});
Route::get('/getUsersWithClass/{id}', function ($id) {
    return array_values(Classes::getUsersWithClass($id));
});
// Courses
Route::get('/getCourses', function() {
    return array_values(Course::getCourses());
});
// Modules
Route::get('/getModules/{id}', function($id) {return array_values(Module::where('course', '=', $id)->get()->toArray());});
// Learning Styles
Route::get('/getLearningStyles', function() {return array_values(Learning_Style::all()->toArray());});
Route::get('/getUsersWithLS/{id}', function ($id) {return array_values(User::where('learning_style', '=', $id)->get()->toArray());});
// Resources
Route::get('/getResources', function() {return array_values(Student_Resources::getResources());});
// Resource Types
Route::get('/getResourceTypes', function() {return array_values(Resource_Types::all()->toArray());});
// Departments
Route::get('/getDepartments', function() {return array_values(Department::all()->toArray());});
// Categories
Route::get('/getCategories', function() { return array_values(Category::all()->toArray()); });
// Licenses
Route::get('/getLicenses', function() { return array_values(Licenses::all()->toArray());});
//Setup Keys
Route::get('/getKeys', function() { return array_values(SetupKeys::all()->toArray());});
// Support Only
Route::get('/delete_award/{id}', function($id) {
    $award = Award::find($id);
    Storage::delete(["awards/$award->name.png", "awards/$award->name.jpg", "awards/$award->name.jpeg", "awards/$award->name.webp", "awards/$award->name.svg"]);
    $award->delete();
    return redirect('/awards')->with('status', 'Award Deleted!');
});
Route::get('/delete_class/{id}', function($id) {
   Classes::findorfail($id)->delete();
   return redirect('/classes')->with('status', 'Class Deleted');
});
// Discussions
Route::get('/getDiscussions', function() {return array_values(discussions::all()->toArray());});
