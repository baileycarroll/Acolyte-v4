<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserContentController;
use App\Models\Award;
use App\Models\Content_Type;
use App\Models\Course;
use App\Models\discussions;
use App\Models\Gradebook;
use App\Models\Module;
use App\Models\SetupKeys;
use App\Models\User_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Models
use App\Models\User;
use App\Models\Licenses;
use App\Models\Department;
use App\Models\Learning_Style;
use App\Models\Category;
use App\Models\Resource_Types;
use App\Models\Student_Resources;
use App\Models\Classes;
use App\Models\Quiz;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ResourceTypesController;
use App\Http\Controllers\StudentResourcesController;
use App\Http\Controllers\LearningStyleController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QuizController;
use \App\Http\Controllers\PermissionsController;
use App\Http\Controllers\SetupKeysController;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Support Only Views
Route::group(['middleware'=>'role:Support'], function () {
    Route::get('/permissions', function(){ return view('sessions.admin.permissions'); });
    Route::post('/create_permission', [PermissionsController::class, 'createPermission']);
    Route::post('/update_permission', [PermissionsController::class, 'updatePermission']);
    Route::post('/delete_permission', [PermissionsController::class, 'deletePermission']);
});
// Universal Views
// Will be added upon merging with customer base.

// Register/Login
Route::middleware('guest')->group( function() {
    Route::get('/register', function () { return view('register');});
    Route::post('/register', [RegisterController::class, 'createUser']);
    Route::get('/login', function () {return view('login');})->name('login');
    Route::post('/login', [SessionController::class, 'login'] );
});

// Admin Views
Route::middleware('auth')->group(function() {
    Route::get('/home', function () {
        return view('home', [
            'instance_name' => SetupKeys::where('key', '=', 'instance_name')->first()->value,
            'discussion' => discussions::where('month', '=', (date('n')-1))->first(),
    ]);
});
    Route::post('/logout', [SessionController::class, 'logout']);
// User Management
    Route::get('/users', function () {
        return view('sessions/admin/users', [
            'active_users' => User::getActiveUsers(),
            'inactive_users' => User::getInactiveUsers(),
            'todays_users' => User::getTodaysUsers(),
            'departments' => Department::getDepartments(),
            'licenses' => Licenses::getLicenses(),
            'learning_styles' => Learning_Style::getLearningStyles(),
        ]);
    });
    Route::get('/user_information/{id}', function($id) {
//        ddd(User::find($id)->getRoleNames());
        return view('sessions/admin/user_information', [
            'user' => User::getUserInformation($id),
            'departments' => Department::getDepartments(),
            'licenses' => Licenses::getLicenses(),
            'awards' => Award::all(),
            'learning_styles' => Learning_Style::getLearningStyles(),
            'user_roles' => User::find($id)->getRoleNames(),
            'roles' => Role::where('id', '!=', 1)->get(),
            'classes' =>Classes::all(),
            'average_grade' => Gradebook::calculateAverage($id),
        ]);
    });
    Route::controller(UserController::class)->group(function () {
        Route::post('/add_user', 'adminAddUser');
        Route::post('/delete_user/{id}', 'adminDelUser');
        Route::post('/update_user', 'adminUpdateUser');
        Route::post('/user_add_role/{user_id}/{role_id}', 'addRole');
    });
    Route::post('/add_user_to_class', [UserContentController::class, 'addUserToClass']);
    Route::post('/give_award_to_user', [AwardController::class, 'giveAwardToUser']);

//System Permissions
    Route::group(['middleware'=>['can:ViewSystem']], function() {
        //Role Management
        Route::get('/roles', function() { return view('sessions/admin/roles'); });
        Route::get('/role_information/{id}', function($id) {
            $users = User::role($id)->count();
           $role = Role::find($id);
           return view('sessions.admin.role_information', [
              'role' => $role,
               'users' => $users,
           ]);
        });
        Route::get('/role_information/read/{id}', function($id) {
            $users = User::role($id)->count();
            $role = Role::find($id);
            return view('sessions.admin.role_information_readonly', [
                'role' => $role,
                'users' => $users,
            ]);
        });

        Route::group(['middleware'=>['can:CreateSystem']], function () {
            Route::post('/create_role', [PermissionsController::class, 'createRole']);
        });
        Route::group(['middleware'=>['can:UpdateSystem']], function () {
            Route::post('/update_role', [PermissionsController::class, 'updateRole']);
            Route::post('/give_all_permissions/{id}', [PermissionsController::class, 'giveAllPermissions']);
        });
        Route::group(['middleware'=>['can:DeleteSystem']], function () {
            Route::post('/delete_role', [PermissionsController::class, 'deleteRole']);

        });
    });
// Department Management
    Route::get('/departments', function() {
        return view('sessions/admin/departments',[
            'numUsersWithDepts' => User::getCountUsersWithDepts(),
            'numDepts' => Department::getCountDepts(),
            'numUsersWithoutDepts' => User::getCountUsersWithoutDepts(),
            'departments' => Department::getDepartments()
        ]);
    });
    Route::get('departments/read/{id}', function($id) {return view('sessions.admin.department_information_readonly', ['department' => Department::find($id)]);});
    Route::get('departments/{id}', function($id) {return view('sessions.admin.department_information', ['department' => Department::find($id)]);});
    Route::post('/add_department', [DepartmentController::class, 'addDepartment']);
    Route::post('/update_department', [DepartmentController::class, 'updateDepartment']);
    Route::post('/delete_department', [DepartmentController::class, 'deleteDepartment']);

//Category Management
    Route::get('/categories', function() {
        return view('sessions/admin/categories', [
            'categories' => Category::getCategories()
        ]);
    });
    Route::post('/add_category', [CategoryController::class, 'addCategory']);
    Route::post('/update_category', [CategoryController::class, 'updateCategory']);
    Route::post('/delete_category', [CategoryController::class, 'deleteCategory']);
    Route::get('categories/read/{id}', function($id) {return view('sessions.admin.category_information_readonly', ['category' => Category::find($id)]);});
    Route::get('categories/{id}', function($id) {return view('sessions.admin.category_information', ['category' => Category::find($id)]);});

//License Management
    Route::get('/licenses', function() {
        return view('sessions/admin/licenses', [
            'licenses' => Licenses::getLicenses()
        ]);
    });
    Route::get('licenses/read/{id}', function($id) {return view('sessions.admin.license_information_readonly', ['license' => Licenses::find($id)]);});
    Route::get('licenses/{id}', function($id) {return view('sessions.admin.license_information', ['license' => Licenses::find($id)]);});
    Route::post('/add_license', [LicenseController::class, 'addLicense']);
    Route::post('/update_license', [LicenseController::class, 'updateLicense']);
    Route::post('/delete_license', [LicenseController::class, 'deleteLicense']);

//Resource Management
    Route::get('/resource_types', function() {
        return view('sessions/admin/resource_types', [
            'resource_types' => Resource_Types::getResourceTypes()
        ]);
    });
    Route::get('resource_types/read/{id}', function($id) {return view('sessions.admin.resource_types_information_readonly', ['resource_type' => Resource_Types::find($id)]);});
    Route::get('resource_types/{id}', function($id) {return view('sessions.admin.resource_types_information', ['resource_type' => Resource_Types::find($id)]);});
    Route::post('/add_resource_type', [ResourceTypesController::class, 'addResourceType']);
    Route::post('/update_resource_type', [ResourceTypesController::class, 'updateResourceType']);
    Route::post('/delete_resource_type', [ResourceTypesController::class, 'deleteResourceType']);

    Route::get('/resources', function() {
        return view('sessions/admin/resources', [
            'resources' => Student_Resources::getResources(),
            'resource_types' => Resource_Types::getResourceTypes()
        ]);
    });
    Route::post('/add_resource', [StudentResourcesController::class, 'addResource']);
    Route::post('/update_resource', [StudentResourcesController::class, 'updateResource']);
    Route::post('/delete_resource', [StudentResourcesController::class, 'deleteResource']);

// Content Management
// Learning Styles
    Route::get('/learning_styles', function() {
        return view('sessions/admin/learning_styles', [
            'learning_styles' => Learning_Style::getLearningStylesAdmin()
        ]);
    });
    Route::get('/ls_information/read/{id}', function($id) { return view('sessions.admin.ls_information_readonly', ['lstyle' => Learning_Style::find($id)]);});
    Route::get('/ls_information/{id}', function($id) { return view('sessions.admin.ls_information', ['lstyle' => Learning_Style::find($id)]);});
    Route::post('/add_learning_style', [LearningStyleController::class, 'addLearningStyle']);
    Route::post('/update_learning_style', [LearningStyleController::class, 'updateLearningStyle']);
    Route::post('/delete_learning_style', [LearningStyleController::class, 'deleteLearningStyle']);

// Class Management
    Route::get('/classes', function() {
        return view('sessions/admin/classes', [
            'classes' => Classes::getClassesAdmin(),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all()
        ]);
    });
    Route::post('/add_class', [ClasseController::class, 'createClass']);
    Route::post('/delete_class', [ClasseController::class, 'deleteClass']);

    Route::get("/class_information/{id}", function($id) {
        return view("sessions/admin/class_information", [
            'class' => Classes::getClassesUpdateAdmin($id),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'class_name' => str_replace(" ", "_", Classes::find($id)->name),
            'thumb_filepath' => "thumbnails/classes/".Classes::find($id)->name."/".Classes::find($id)->name.".jpg",
            'filepath' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quizzes' => Quiz::all()->where('class_id', '=', $id),
            'avg_grade' => Gradebook::getAverageClassGrade($id),
            'last_graded' => Gradebook::getLastClassGrade($id)
        ]);
    });
    Route::get("/class_information/read/{id}", function($id) {
        return view("sessions/admin/class_information_readonly", [
            'class' => Classes::getClassesUpdateAdmin($id),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'class_name' => str_replace(" ", "_", Classes::find($id)->name),
            'thumb_filepath' => "thumbnails/classes/".Classes::find($id)->name."/".Classes::find($id)->name.".jpg",
            'filepath' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quizzes' => Quiz::all()->where('class_id', '=', $id),
            'avg_grade' => Gradebook::getAverageClassGrade($id),
            'last_graded' => Gradebook::getLastClassGrade($id)
        ]);
    });
    Route::post('/update_class', [ClasseController::class, 'updateClass']);
    Route::post('/upload_class_content', [ContentController::class, 'uploadClassContent']);
    Route::post('/upload_class_thumbnail', [ContentController::class, 'uploadClassThumbnail']);
    Route::post('/set_spotlight_class', function(Request $request) {
        $spotlight = Classes::find($request->id);
        if($spotlight->status != 'Active'){
            return redirect("/class_information/$request->id")->with('status', 'Not an active class, unable to set as spotlight.');
        }
        Classes::where('spotlight', '=', 1)->update(['spotlight'=>0]);
        $spotlight->spotlight = 1;
        $spotlight->save();
        return redirect("/class_information/$request->id")->with('status', 'Set as Spotlight Class');
    });

// Quiz Management
    Route::post('/create_class_quiz', [QuizController::class, 'createClassQuiz']);
    Route::post('/update_class_quiz', [QuizController::class, 'updateClassQuiz']);

// Award Management
    Route::get('/awards', function() {
        return view('sessions/admin/awards', ['awards' => Award::all()]);
    });
    Route::post('/create_award', [AwardController::class, 'createAward']);
    Route::get('/award_information/read/{id}', function($id) {
        $file = Award::find($id)->name;
        return view('sessions.admin.award_information_readonly', [
            'award' => Award::find($id),
            'image' => Storage::temporaryUrl("awards/$file.png", now()->addMinutes(10)),
        ]);
    });
    Route::get('/award_information/{id}', function($id) {
        $file = Award::find($id)->filename;
        return view('sessions.admin.award_information', [
            'award' => Award::find($id),
            'users' => User::all(),
            'image' => Storage::temporaryUrl("awards/$file", now()->addMinutes(10)),
        ]);
    });
    Route::post('/update_award', [AwardController::class, 'updateAward']);
    Route::post('/add_award_to_user', [AwardController::class, 'addAwardToUser']);
});

// Course Management
    Route::get('/courses', function() {
        return view('sessions.admin.courses', [
            'courses' => Course::all(),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
        ]);
    });
    Route::post('/create_course', [CourseController::class, 'createCourse']);
    Route::post('/update_course', [CourseController::class, 'updateCourse']);
    Route::get('/course_information/read/{id}', function($id) {
        return view('sessions.admin.course_information_readonly', [
            'course' => Course::getCoursesUpdateAdmin($id),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'modules' => Module::where('course', '=', $id)->get(),
            'filepath' => "thumbnails/".Course::find($id)->name.'/'.Course::find($id)->name.'.jpg',
            'avg_grade' => Gradebook::getAverageCourseGrade($id),
            'last_graded' => Gradebook::getLastCourseGrade($id)
        ]);
    });
    Route::get('/course_information/{id}', function($id) {
        return view('sessions.admin.course_information', [
            'course' => Course::getCoursesUpdateAdmin($id),
            'learning_styles' => Learning_Style::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'modules' => Module::where('course', '=', $id)->get(),
            'filepath' => "thumbnails/".Course::find($id)->name.'/'.Course::find($id)->name.'.jpg',
            'avg_grade' => Gradebook::getAverageCourseGrade($id),
            'last_graded' => Gradebook::getLastCourseGrade($id)
        ]);
    });
    Route::post('/upload_course_thumbnail', [ContentController::class, 'uploadCourseThumbnail']);
    Route::post('/set_spotlight_course', function(Request $request) {
        $spotlight = Course::find($request->id);
        if($spotlight->status != 'Active'){
            return redirect("/course_information/$request->id")->with('status', 'Not an active course, unable to set as spotlight.');
        }
        Course::where('spotlight', '=', 1)->update(['spotlight'=>0]);
        $spotlight->spotlight = 1;
        $spotlight->save();
        return redirect("/course_information/$request->id")->with('status', 'Set as Spotlight Course');
    });
// Modules
    Route::get('/course_information/modules', function() {
        return view('sessions.admin.modules');
    });
    Route::get('/module_information/{id}', function($id) {
        $filepath = "modules/".str_replace(" ", "_", Module::find($id)->name)."/".str_replace(" ", "_", Module::find($id)->name).".mp4";
        return view('sessions.admin.module_information', [
            'module' => Module::findorfail($id),
            'filepath' => $filepath,
            'quizzes' => Quiz::all()->where('module_id', '=', $id),
            'avg_grade' => Gradebook::getAverageModuleGrade($id),
            'last_graded' => Gradebook::getLastModuleGrade($id)
        ]);
    });
    Route::post('/create_module', [ModuleController::class, 'CreateModule']);
    Route::post('/update_module', [ModuleController::class, 'UpdateModule']);
    Route::post('/create_module_quiz', [QuizController::class, 'createModuleQuiz']);
    Route::post('/update_module_quiz', [QuizController::class, 'updateModuleQuiz']);
    Route::post('/upload_module_content', [ContentController::class, 'uploadModuleContent']);
// Setup Keys
    Route::get('/setup_keys', function() {return view('sessions.admin.setup_keys', ['keys' => SetupKeys::all()]);});
    Route::post('/add_setup_key', [SetupKeysController::class, 'addSetupKey']);
    Route::post('/update_setup_key', [SetupKeysController::class, 'updateSetupKey']);
    Route::post('/update_color_style', [SetupKeysController::class, 'updateColorStyle']);
    Route::get('/key_information/{id}', function($id) { return view('sessions.admin.setup_key_information', ['key' => SetupKeys::find($id)]);});

// User Views
Route::get('/catalog', function() {
    if(request('content_type')) {
        if(request('content_type') === 'Class'){
            return view('sessions.user.catalog', [
                'contents' => Classes::where("status", '=', 'Active')->get(),
                'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                'categories' => Category::all(),
                'content_types' => Content_Type::all(),
            ]);
        } else {
            return view('sessions.user.catalog', [
                'contents' => Course::where("status", '=', 'Active')->get(),
                'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                'categories' => Category::all(),
                'content_types' => Content_Type::all(),
            ]);
        }
    } else
    if(request('category')) {
        return view('sessions.user.catalog', [
            $courses = Course::where("status", '=', 'Active')->where('category_1', '=', request('category'))->orWhere('category_2', '=', request('category'))->orWhere('category_3', '=', request('category')),
            'contents' => Classes::where("status", '=', 'Active')->where('category_1', '=', request('category'))->orWhere('category_2', '=', request('category'))->orWhere('category_3', '=', request('category'))->get()->merge($courses),
            'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
            'categories' => Category::all(),
            'content_types' => Content_Type::all(),
        ]);
    } else {
        return view('sessions.user.catalog', [
            $courses = Course::where("status", '=', 'Active'),
            'contents' => Classes::where("status", '=', 'Active')->get()->merge($courses),
            'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
            'categories' => Category::all(),
            'content_types' => Content_Type::all(),
        ]);
    }
});
Route::post('/add_to_user_content', [UserContentController::class, 'addUserToContent']);

// View Content
Route::get('/view_class/{id}', function($id) {
    $last_active = User_Content::where('user', '=', Auth::id())->where('class', '=', $id)->first();
    $last_active->last_accessed = date('Y-m-d');
    $last_active->save();

    if(Gradebook::where('user', '=', Auth::id())->where('class', '=', $id)->get()->isEmpty()){
        $show_quiz = 1;
        $grade = NULL;
    } else {
        $show_quiz = 0;
        $grade = Gradebook::where('user', '=', Auth::id())->where('class', '=', $id)->first()->grade;
    }
    if(SetupKeys::where('key', '=', 'allow_class_retakes')->where('value', '=', 1)->first()->value) {
        $show_quiz = 1;
    }
    if (Quiz::where('class_id', '=', $id)->first() != NULL) {
        return view('sessions.user.view_class', [
            'class' => Classes::find($id),
            'content' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quiz' => Quiz::where('class_id', '=', $id)->first(),
            'show_quiz' => $show_quiz,
            'grade' => $grade
        ]);
    }
    return view('sessions.user.view_class', [
        'class' => Classes::find($id),
        'content' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
        'quiz' => NULL,
        'show_quiz' => $show_quiz,
        'grade' => $grade
    ]);
});
Route::get('/view_course/{id}', function($id) {
    return view('sessions.user.view_course', [
        'course' => Course::find($id),
        'modules' => Module::where('course', '=', $id)->where('status', '=', 'Active')->get(),
    ]);
});
Route::get('/view_course/{course_id}/view_module/{module_id}', function($course_id, $module_id) {
    $last_active = User_Content::where('user', '=', Auth::id())->where('course', '=', $course_id)->first();
    $last_active->last_accessed = date('Y-m-d');
    $last_active->save();

    if(Gradebook::where('user', '=', Auth::id())->where('course', '=', $course_id)->where('module', '=', $module_id)->get()->isEmpty()){
        $show_quiz = 1;
        $grade = NULL;
    } else {
        $show_quiz = 0;
        $grade = Gradebook::where('user', '=', Auth::id())->where('course', '=', $course_id)->where('module', '=', $module_id)->first()->grade;
    }
    if(SetupKeys::where('key', '=', 'allow_class_retakes')->where('value', '=', 1)->first()->value) {
        $show_quiz = 1;
    }
    if (Quiz::where('module_id', '=', $module_id)->first() != NULL) {
        return view('sessions.user.view_course_module', [
            'modules' => Module::where('course', '=', $course_id)->where('status', '=', 'Active')->where('id', '!=', $module_id)->get(),
            'course' => Course::find($course_id),
            'module' => Module::find($module_id),
            'content' => "modules/".str_replace(" ", "_", Module::find($module_id)->name)."/".str_replace(" ", "_", Module::find($module_id)->name).".mp4",
            'quiz' => Quiz::where('module_id', '=', $module_id)->first(),
            'show_quiz' => $show_quiz,
            'grade' => $grade
        ]);
    }
    return view("sessions.user.view_course_module", [
        'modules' => Module::where('course', '=', $course_id)->where('status', '=', 'Active')->where('id', '!=', $module_id)->get(),
        'course' => Course::find($course_id),
        'module' => Module::find($module_id),
        'content' => "modules/".str_replace(" ", "_", Module::find($module_id)->name)."/".str_replace(" ", "_", Module::find($module_id)->name).".mp4",
        'quiz' => NULL,
        'show_quiz' => $show_quiz,
        'grade' => $grade
    ]);
});
// Grade Quiz
Route::post('/grade_quiz', [GradebookController::class, 'gradeQuiz']);

Route::get('/my_content', function() {
    return view("sessions.user.my_content", [
        'courses' => Course::all(),
        'classes' => Classes::all()
    ]);
});
Route::get('/student_resources', function() {
    return view("sessions.user.student_resources", [
        'resources' => Student_Resources::getResources(),
        'resource_types' => Resource_Types::getResourceTypes()
    ]);
});
// Discussion Management
Route::get('/discussions', function() {
    return view('sessions/admin/discussions',[
        'classes' => Classes::all(),
        'modules' => Module::all(),
    ]);
});
Route::get('discussions/read/{id}', function($id) {return view('sessions.admin.discussion_information_readonly', ['discussion' => discussions::find($id), 'classes' => Classes::all(), 'modules' => Module::all()]);});
Route::get('discussions/{id}', function($id) {return view('sessions.admin.discussion_information', ['discussion' => discussions::find($id), 'classes' => Classes::all(), 'modules' => Module::all()]);});
Route::post('/add_discussion', [DiscussionsController::class, 'createDiscussion']);
Route::post('/update_discussion', [DiscussionsController::class, 'updateDiscussion']);
