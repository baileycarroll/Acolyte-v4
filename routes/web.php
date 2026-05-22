<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\LearningStyleController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResourceTypesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SetupKeysController;
use App\Http\Controllers\StudentResourcesController;
use App\Http\Controllers\UserContentController;
use App\Http\Controllers\UserController;
use App\Models\Discussions;
use App\Models\SetupKeys;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [SessionController::class, 'login'])->middleware('throttle:login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionController::class, 'logout']);

    Route::get('/home', function () {
        return view('home', [
            'instance_name' => SetupKeys::where('key', '=', 'instance_name')->first()->value,
            'discussion' => Discussions::where('month', '=', (date('n') - 1))->first(),
        ]);
    });

    Route::get('/my_profile', [UserController::class, 'showProfile'])->name('my_profile');
    Route::post('/update_account_details', [UserController::class, 'updateAccount'])
        ->middleware('demo.feature:writes');

    Route::get('/course_catalog', [CatalogController::class, 'showCourseCatalog']);
    Route::get('/class_catalog', [CatalogController::class, 'showClassCatalog']);

    Route::get('/student_resources', [StudentResourcesController::class, 'showStudentResources']);

    Route::controller(UserContentController::class)->group(function () {
        Route::get('/view_class/{id}', 'viewClass');
        Route::get('/view_course/{id}', 'viewCourse');
        Route::get('/my_content', 'showUsersContent');
        Route::get('/view_course/{course_id}/view_modules/{module_id}', 'viewModule');
        Route::post('//add_to_user_content', 'addUserToContent')
            ->middleware('demo.feature:writes');
    });

    Route::controller(MembershipController::class)->middleware('demo.feature:billing')->group(function () {
        Route::get('/membership', 'showMemberships');
        Route::get('/manage_my_membership', 'billingPortal');
        Route::post('/membership', 'subscribeUser');
    });

    Route::middleware('role:Support')->group(function () {
        Route::get('/permissions', function () {
            return view('sessions.admin.permissions');
        });

        Route::middleware('demo.feature:writes')->group(function () {
            Route::post('/create_permission', [PermissionsController::class, 'createPermission']);
            Route::post('/update_permission', [PermissionsController::class, 'updatePermission']);
            Route::post('/delete_permission', [PermissionsController::class, 'deletePermission']);
        });
    });

    Route::middleware('can:ViewSystem')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/users', 'showUsers');
            Route::get('/user_information/read/{id}', 'userInformationRead');
            Route::get('/user_information/{id}', 'userInformation');
        });

        Route::controller(DepartmentController::class)->group(function () {
            Route::get('/departments', 'showDepartments');
            Route::get('/departments/read/{id}', 'departmentInformationRead');
            Route::get('/departments/{id}', 'departmentInformation');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/categories', 'showCategories');
            Route::get('/categories/read/{id}', 'categoryInformationRead');
            Route::get('/categories/{id}', 'categoryInformation');
        });

        Route::controller(LicenseController::class)->group(function () {
            Route::get('/licenses', 'showLicenses');
            Route::get('/licenses/read/{id}', 'licenseInformationRead');
            Route::get('/licenses/{id}', 'licenseInformation');
        });

        Route::controller(ResourceTypesController::class)->group(function () {
            Route::get('/resource_types', 'showResourceTypes');
            Route::get('/resource_types/read/{id}', 'resourceTypeInformationRead');
            Route::get('/resource_types/{id}', 'resourceTypeInformation');
        });

        Route::get('/resources', [StudentResourcesController::class, 'showResources']);

        Route::controller(LearningStyleController::class)->group(function () {
            Route::get('/learning_styles', 'showLearningStyles');
            Route::get('/ls_information/read/{id}', 'lsInformationRead');
            Route::get('/ls_information/{id}', 'lsInformation');
        });

        Route::controller(AwardController::class)->group(function () {
            Route::get('/awards', 'showAwards');
            Route::get('/award_information/read/{id}', 'awardInformationRead');
            Route::get('/award_information/{id}', 'awardInformation');
        });

        Route::controller(SetupKeysController::class)->group(function () {
            Route::get('/setup_keys', 'showSetupKeys');
            Route::get('/key_information/{id}', 'setupKeyInformation');
        });

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

        Route::middleware(['demo.feature:mail', 'can:ViewSystem'])->group(function () {
            Route::get('send-mail', [MailController::class, 'index']);
            Route::get('/contact_user/{id}', function ($id) {
                return view('sessions.admin.contact_user', [
                    'contact' => User::find($id),
                ]);
            });
            Route::post('/contact_user/{id}', [MailController::class, 'contactUser']);
        });

        Route::middleware('demo.feature:writes')->group(function () {
            Route::post('/add_user', [UserController::class, 'adminAddUser']);
            Route::post('/delete_user/{id}', [UserController::class, 'adminDelUser']);
            Route::post('/update_user', [UserController::class, 'adminUpdateUser']);
            Route::post('/user_add_role/{user_id}/{role_id}', [UserController::class, 'addRole']);
            Route::post('/add_department', [DepartmentController::class, 'addDepartment']);
            Route::post('/update_department', [DepartmentController::class, 'updateDepartment']);
            Route::post('/delete_department', [DepartmentController::class, 'deleteDepartment']);
            Route::post('/add_category', [CategoryController::class, 'addCategory']);
            Route::post('/update_category', [CategoryController::class, 'updateCategory']);
            Route::post('/delete_category', [CategoryController::class, 'deleteCategory']);
            Route::post('/add_license', [LicenseController::class, 'addLicense']);
            Route::post('/update_license', [LicenseController::class, 'updateLicense']);
            Route::post('/delete_license', [LicenseController::class, 'deleteLicense']);
            Route::post('/add_resource_type', [ResourceTypesController::class, 'addResourceType']);
            Route::post('/update_resource_type', [ResourceTypesController::class, 'updateResourceType']);
            Route::post('/delete_resource_type', [ResourceTypesController::class, 'deleteResourceType']);
            Route::post('/add_resource', [StudentResourcesController::class, 'addResource']);
            Route::post('/update_resource', [StudentResourcesController::class, 'updateResource']);
            Route::post('/delete_resource', [StudentResourcesController::class, 'deleteResource']);
            Route::post('/add_learning_style', [LearningStyleController::class, 'addLearningStyle']);
            Route::post('/update_learning_style', [LearningStyleController::class, 'updateLearningStyle']);
            Route::post('/delete_learning_style', [LearningStyleController::class, 'deleteLearningStyle']);
            Route::post('/create_award', [AwardController::class, 'createAward']);
            Route::post('/update_award', [AwardController::class, 'updateAward']);
            Route::post('/add_award_to_user', [AwardController::class, 'addAwardToUser']);
            Route::post('/give_award_to_user', [AwardController::class, 'giveAwardToUser']);
            Route::post('/add_setup_key', [SetupKeysController::class, 'addSetupKey']);
            Route::post('/update_setup_key', [SetupKeysController::class, 'updateSetupKey']);
            Route::post('/update_color_style', [SetupKeysController::class, 'updateColorStyle']);
            Route::post('/create_frontend_keys', [SetupKeysController::class, 'generateCustomLinkKeys']);
            Route::post('/create_role', [PermissionsController::class, 'createRole'])->middleware('can:CreateSystem');
            Route::post('/update_role', [PermissionsController::class, 'updateRole'])->middleware('can:UpdateSystem');
            Route::post('/give_all_permissions/{id}', [PermissionsController::class, 'giveAllPermissions'])->middleware('can:UpdateSystem');
            Route::post('/delete_role', [PermissionsController::class, 'deleteRole'])->middleware('can:DeleteSystem');
        });
    });

    Route::middleware('can:ViewContent')->group(function () {
        Route::controller(ClassController::class)->group(function () {
            Route::get('/classes', 'showClasses');
            Route::get('/class_information/{id}', 'classInformation');
            Route::get('/class_information/read/{id}', 'classInformationRead');
        });

        Route::controller(CourseController::class)->group(function () {
            Route::get('/courses', 'showCourses');
            Route::get('/course_information/read/{id}', 'courseInformationRead');
            Route::get('/course_information/{id}', 'courseInformation');
        });

        Route::controller(ModuleController::class)->group(function () {
            Route::get('/module_information/{id}', 'moduleInformation');
            Route::get('/module_information/read/{id}', 'moduleInformationRead');
        });

        Route::middleware('demo.feature:writes')->group(function () {
            Route::post('/add_user_to_class', [UserContentController::class, 'addUserToClass']);
            Route::post('/set_spotlight_class', [ContentController::class, 'setSpotlightClass']);
            Route::post('/set_spotlight_course', [ContentController::class, 'setSpotlightCourse']);
            Route::post('/add_class', [ClassController::class, 'createClass']);
            Route::post('/update_class', [ClassController::class, 'updateClass']);
            Route::post('/delete_class', [ClassController::class, 'deleteClass']);
            Route::post('/create_course', [CourseController::class, 'createCourse']);
            Route::post('/update_course', [CourseController::class, 'updateCourse']);
            Route::post('/create_module', [ModuleController::class, 'CreateModule']);
            Route::post('/update_module', [ModuleController::class, 'UpdateModule']);
            Route::post('/create_class_quiz', [QuizController::class, 'createClassQuiz']);
            Route::post('/update_class_quiz', [QuizController::class, 'updateClassQuiz']);
            Route::post('/create_module_quiz', [QuizController::class, 'createModuleQuiz']);
            Route::post('/update_module_quiz', [QuizController::class, 'updateModuleQuiz']);
        });

        Route::middleware(['demo.feature:writes', 'demo.feature:uploads'])->group(function () {
            Route::post('/upload_class_content', [ContentController::class, 'uploadClassContent']);
            Route::post('/upload_class_thumbnail', [ContentController::class, 'uploadClassThumbnail']);
            Route::post('/upload_course_thumbnail', [ContentController::class, 'uploadCourseThumbnail']);
            Route::post('/upload_module_content', [ContentController::class, 'uploadModuleContent']);
        });
    });

    Route::middleware('can:ViewForum')->group(function () {
        Route::controller(DiscussionsController::class)->group(function () {
            Route::get('/discussions', 'showDiscussions');
            Route::get('/discussions/read/{id}', 'discussionInformationRead');
            Route::get('/discussions/{id}', 'discussionInformation');
        });

        Route::middleware('demo.feature:writes')->group(function () {
            Route::post('/add_discussion', [DiscussionsController::class, 'createDiscussion']);
            Route::post('/update_discussion', [DiscussionsController::class, 'updateDiscussion']);
        });
    });

    Route::post('/grade_quiz', [GradebookController::class, 'gradeQuiz'])
        ->middleware('demo.feature:writes');
});
