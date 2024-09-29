<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MembershipController;
use App\Models\Licenses;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

//Models
use App\Models\User;
use App\Models\Discussions;
use App\Models\SetupKeys;

// Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ResourceTypesController;
use App\Http\Controllers\StudentResourcesController;
use App\Http\Controllers\LearningStyleController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\SetupKeysController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserContentController;

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
Route::middleware('guest')->group( function() {
    Route::get('/', function () {return redirect('/login');});
    Route::get('/login', function () {return view('login');});
    Route::post('/login', [SessionController::class, 'login'] );
});


// Admin Views
Route::middleware('auth')->group(function() {
    Route::get('/home', function () {
        return view('home', [
            'instance_name' => SetupKeys::where('key', '=', 'instance_name')->first()->value,
            'discussion' => Discussions::where('month', '=', (date('n')-1))->first(),
        ]);
    });
});
// Payment Processing
Route::controller(MembershipController::class)->group(function() {
    Route::get('/membership', 'showMemberships');
    Route::get('/manage_my_membership', 'billingPortal');
    Route::post('/membership', 'subscribeUser');
});
//User Sessions
    Route::post('/logout', [SessionController::class, 'logout']);
// User Management
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'showUsers');
        Route::get('/user_information/read/{id}', 'userInformation');
        Route::get('/user_information/{id}', 'userInformation');
        Route::post('/add_user', 'adminAddUser');
        Route::post('/delete_user/{id}', 'adminDelUser');
        Route::post('/update_user', 'adminUpdateUser');
        Route::post('/user_add_role/{user_id}/{role_id}', 'addRole');
        Route::get('/my_profile', 'showProfile')->name('my_profile');
        Route::post('/update_account_details', 'updateAccount');
    });
    Route::post('/add_user_to_class', [UserContentController::class, 'addUserToClass']);
    Route::post('/give_award_to_user', [AwardController::class, 'giveAwardToUser']);
// Department Management
    Route::controller(DepartmentController::class)->group(function() {
        Route::get('/departments', 'showDepartments');
        Route::get('departments/read/{id}', 'departmentInformationRead');
        Route::get('departments/{id}', 'departmentInformation');
        Route::post('/add_department', 'addDepartment');
        Route::post('/update_department', 'updateDepartment');
        Route::post('/delete_department', 'deleteDepartment');
    });
//Category Management
    Route::controller(CategoryController::class)->group(function() {
       Route::get('/categories', 'showCategories');
       Route::get('categories/read/{id}', 'categoryInformationRead');
       Route::get('categories/{id}', 'categoryInformation');
       Route::post('/add_category', 'addCategory');
       Route::post('/update_category', 'updateCategory');
       Route::post('/delete_category', 'deleteCategory');
    });
//License Information
    Route::controller(LicenseController::class)->group(function() {
       Route::get('/licenses', 'showLicenses');
       Route::get('licenses/read/{id}', 'licenseInformationRead');
       Route::get('licenses/{id}', 'licenseInformation');
       Route::post('/add_license', 'addLicense');
       Route::post('/update_license', 'updateLicense');
       Route::post('/delete_license', 'deleteLicense');
    });
// Resource Types
    Route::controller(ResourceTypesController::class)->group(function() {
       Route::get('/resource_types', 'showResourceTypes');
       Route::get('resource_types/read/{id}', 'resourceTypeInformationRead');
       Route::get('resource_types/{id}', 'resourceTypeInformation');
       Route::post('/add_resource_type', 'addResourceType');
       Route::post('/update_resource_type', 'updateResourceType');
       Route::post('/delete_resource_type', 'deleteResourceType');
    });
// Student Resources
    Route::controller(StudentResourcesController::class)->group(function() {
        Route::get('/resources', 'showResources');
        Route::get('/student_resources', 'showStudentResources');
        Route::post('/add_resource', 'addResource');
        Route::post('/update_resource', 'updateResource');
        Route::post('/delete_resource', 'deleteResource');
    });
// Learning Styles
    Route::controller(LearningStyleController::class)->group(function() {
       Route::get('/learning_styles', 'showLearningStyles');
       Route::get('ls_information/read/{id}', 'lsInformationRead');
       Route::get('ls_information/{id}', 'lsInformation');
       Route::post('/add_learning_style', 'addLearningStyle');
       Route::post('/update_learning_style', 'updateLearningStyle');
       Route::post('/delete_learning_style', 'deleteLearningStyle');
    });
// Content Management
    Route::controller(ContentController::class)->group(function() {
        Route::post('/set_spotlight_class', 'setSpotlightClass');
        Route::post('/set_spotlight_course', 'setSpotlightCourse');
        Route::post('/upload_class_content', 'uploadClassContent');
        Route::post('/upload_class_thumbnail', 'uploadClassThumbnail');
        Route::post('/upload_course_thumbnail', 'uploadCourseThumbnail');
        Route::post('/upload_module_content', 'uploadModuleContent');
    });
// Classes
    Route::controller(ClassController::class)->group(function() {
        Route::get('/classes', 'showClasses');
        Route::get('/class_information/{id}', 'classInformation');
        Route::get('/class_information/read/{id}', 'classInformationRead');
        Route::post('/add_class', 'createClass');
        Route::post('/update_class', 'updateClass');
        Route::post('/delete_class', 'deleteClass');
    });
// Courses
    Route::controller(CourseController::class)->group(function() {
        Route::get('/courses', 'showCourses');
        Route::get('/course_information/read/{id}', 'courseInformationRead');
        Route::get('/course_information/{id}', 'courseInformation');
        Route::post('/create_course', 'createCourse');
        Route::post('/update_course', 'updateCourse');
    });
// Modules
    Route::controller(ModuleController::class)->group(function() {
        Route::get('/module_information/{id}', 'moduleInformation');
        Route::get('/module_information/read/{id}', 'moduleInformationRead');
        Route::post('/create_module', 'CreateModule');
        Route::post('/update_module', 'UpdateModule');
    });
// Quizzes
    Route::controller(QuizController::class)->group(function() {
        Route::post('/create_class_quiz', 'createClassQuiz');
        Route::post('/update_class_quiz', 'updateClassQuiz');
        Route::post('/create_module_quiz','createModuleQuiz');
        Route::post('/update_module_quiz','updateModuleQuiz');
    });
// Catalog
    Route::controller(CatalogController::class)->group(function() {
        Route::get('/course_catalog', 'showCourseCatalog');
        Route::get('/class_catalog', 'showClassCatalog');
    });
    Route::controller(UserContentController::class)->group(function () {
        Route::get('/view_class/{id}', 'viewClass');
        Route::get('/view_course/{id}', 'viewCourse');
        Route::get('/my_content', 'showUsersContent');
//        Route::get('/catalog', 'showCatalog');
        Route::get('/view_course/{course_id}/view_modules/{module_id}', 'viewModule');
        Route::post('//add_to_user_content', 'addUserToContent');
    });
// Discussion Management
    Route::controller(DiscussionsController::class)->group(function() {
        Route::get('/discussions', 'showDiscussions');
        Route::get('discussions/read/{id}', 'discussionInformationRead');
        Route::get('discussions/{id}', 'discussionInformation');
        Route::post('/add_discussion', 'createDiscussion');
        Route::post('/update_discussion', 'updateDiscussion');
    });
// Awards
    Route::controller(AwardController::class)->group(function() {
        Route::get('/awards', 'showAwards');
        Route::get('/award_information/read/{id}', 'awardInformationRead');
        Route::get('/award_information/{id}', 'awardInformation');
        Route::post('/create_award', 'createAward');
        Route::post('/update_award', 'updateAward');
        Route::post('/add_award_to_user', 'addAwardToUser');
    });
// Setup Keys
    Route::controller(SetupKeysController::class)->group(function() {
        Route::get('/setup_keys', 'showSetupKeys');
        Route::get('/key_information/{id}', 'setupKeyInformation');
        Route::post('/add_setup_key', 'addSetupKey');
        Route::post('/update_setup_key', 'updateSetupKey');
        Route::post('/update_color_style', 'updateColorStyle');
        Route::post('/create_frontend_keys', 'generateCustomLinkKeys');
    });

//System Permissions
    Route::group(['middleware'=>['can:ViewSystem']], function() {
        //Role Management
        Route::get('/roles', function () {
            return view('sessions/admin/roles');
        });
        Route::get('/role_information/{id}', function ($id) {
            $users = User::role($id)->count();
            $role = Role::find($id);
            return view('sessions.admin.role_information', [
                'role' => $role,
                'users' => $users,
            ]);
        });
        Route::get('/role_information/read/{id}', function ($id) {
            $users = User::role($id)->count();
            $role = Role::find($id);
            return view('sessions.admin.role_information_readonly', [
                'role' => $role,
                'users' => $users,
            ]);
        });
        Route::group(['middleware' => ['can:CreateSystem']], function () {
            Route::post('/create_role', [PermissionsController::class, 'createRole']);
        });
        Route::group(['middleware' => ['can:UpdateSystem']], function () {
            Route::post('/update_role', [PermissionsController::class, 'updateRole']);
            Route::post('/give_all_permissions/{id}', [PermissionsController::class, 'giveAllPermissions']);
        });
        Route::group(['middleware' => ['can:DeleteSystem']], function () {
            Route::post('/delete_role', [PermissionsController::class, 'deleteRole']);
        });
    });

// Grade Quiz
Route::post('/grade_quiz', [GradebookController::class, 'gradeQuiz']);

// Email
Route::get('send-mail', [MailController::class, 'index']);
Route::get('/contact_user/{id}', function($id) {
   return view('sessions.admin.contact_user', [
      'contact' => User::find($id)
   ]);
});
Route::post('/contact_user/{id}', [MailController::class, 'contactUser']);
