<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\AuthoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebsiteController::class,'home']);
Route::get('about', [WebsiteController::class,'about']);
Route::get('contact', [WebsiteController::class,'contact']);
Route::get('services', [WebsiteController::class,'services']);

////////

Route::get('admin/login', [AuthoController::class,'login']);
Route::post('admin/user-login', [AuthoController::class,'userlogin']);
Route::get('admin/teacher-register', [AuthoController::class,'teacherRegister']);
Route::post('admin/teacher-registration', [AuthoController::class,'teacherRegistration']);
Route::get('admin/student-register', [AuthoController::class,'studentRegister']);
Route::post('admin/student-registration', [AuthoController::class,'studentRegistration']);
//Route::get('admin/pending-users', [UserController::class,'pendingusers']);
//Route::post('admin/store-pending-users', [UserController::class,'storependingusers']);


Route::get('admin/dashboard', [AdminLayoutController::class,'dashboard']);
Route::get('admin/admin-register', [AuthoController::class,'adminRegister']);
Route::post('admin/admin-registration', [AuthoController::class,'adminRegistration']);
Route::get('admin/admin-list', [AuthoController::class,'adminlist']);
Route::get('admin/student-list', [AuthoController::class,'studentlist']);
Route::get('admin/teacher-list', [AuthoController::class,'teacherlist']);

////////////////////


Route::middleware(['checkLogin'])->group(function () {

    //Route::get('admin/dashboard', [AdminLayoutController::class,'dashboard']);
    Route::get('admin/tables', [AdminLayoutController::class,'tables']);
    Route::get('admin/logout', [AuthoController::class,'logout']);

    Route::middleware(['checkIfAdmin'])->group(function () {

        Route::get('admin/pending-users', [UserController::class,'pendingusers']);
        //Route::get('admin/store-pending-users', [UserController::class,'storependingusers']);

        Route::get('admin/approve-users/{userid}', [UserController::class,'approveusers']);
        Route::get('admin/student-list/{userid}', [UserController::class,'editstudent']);

    });

    Route::middleware(['checkIfStudent'])->group(function () {
          Route::get('admin/student-enroll', [EnrollController::class,'Enroll']);

    });

});

/////////////////////////////////////

//Course
Route::get('/admin/create-course',[AdminLayoutController::class,'createCourse']);
Route::post('/admin/store-course',[AdminLayoutController::class,'storeCourse']);
Route::get('/admin/all-courses',[AdminLayoutController::class,'allCourses']);
Route::get('/admin/edit-course/{id}',[AdminLayoutController::class,'editCourse']);
Route::get('/admin/delete-course/{id}',[AdminLayoutController::class,'deleteCourse']);
Route::post('/admin/update-course/{id}',[AdminLayoutController::class,'updateCourse']);

//assign-course
Route::get('/admin/assign-course',[AdminLayoutController::class,'assignCourse']);
Route::post('/admin/store-assigncourse',[AdminLayoutController::class,'storeAsssignCourse']);

//Session
Route::get('/admin/create-session',[AdminLayoutController::class,'createSession']);
Route::post('/admin/store-session',[AdminLayoutController::class,'storeSession']);
Route::get('/admin/all-sessions',[AdminLayoutController::class,'allSessions']);
Route::get('/admin/update-session/{id}',[AdminLayoutController::class,'updateSession']);

//Section
Route::get('/admin/create-section',[AdminLayoutController::class,'createSection']);
Route::post('/admin/store-section',[AdminLayoutController::class,'storeSection']);


//enrollment
Route::get('/admin/enrollment',[AdminLayoutController::class,'enrollments']);
Route::get('/admin/enroll-approve/{id}',[AdminLayoutController::class,'enrollApprove']);

Route::get('/test',[AdminLayoutController::class,'test']);

Route::get('/admin/form',[AdminLayoutController::class,'checkForm']);


//Teacher
Route::get('/admin/create-teacher',[AdminLayoutController::class,'createTeacher']);
Route::post('/admin/store-teacher',[AdminLayoutController::class,'storeTeacher']);
Route::post('/admin/update-teacher/{id}',[AdminLayoutController::class,'updateTeacher']);
Route::get('/admin/all-teachers',[AdminLayoutController::class,'allTeachers']);
Route::get('/admin/edit-teacher/{id}',[AdminLayoutController::class,'editTeacher']);
Route::get('/admin/delete-teacher/{id}',[AdminLayoutController::class,'deleteTeacher']);


//Student
Route::get('/admin/create-student',[AdminLayoutController::class,'createStudent']);
Route::post('/admin/store-student',[AdminLayoutController::class,'storeStudent']);
Route::get('/admin/edit-student/{id}',[AdminLayoutController::class,'editStudent']);
Route::get('/admin/delete-student/{id}',[AdminLayoutController::class,'deleteStudent']);
Route::post('/admin/update-student/{id}',[AdminLayoutController::class,'updateStudent']);
Route::get('/admin/all-students',[AdminLayoutController::class,'allStudents']);


//student-teacher

Route::get('/student/dashboard',[StudentController::class,'dashboard']);
Route::post('/student/update-profile',[StudentController::class,'updateProfile']);
Route::get('/student/enrollment',[StudentController::class,'enrollment']);
Route::get('/student/get-session-course/{id}',[StudentController::class,'getAssignedCourses']);
Route::post('/student/store-enroll',[StudentController::class,'storeEnroll']);

//
Route::get('/teacher/dashboard',[TeacherController::class,'dashboard']);
Route::post('/teacher/update-profile',[TeacherController::class,'updateProfile']);
Route::get('/teacher/create-course',[TeacherController::class,'createCourse']);
Route::get('/teacher/get-session-course/{id}',[TeacherController::class,'getCourse']);
Route::post('/teacher/store-course',[TeacherController::class,'storeCourse']);
Route::get('/teacher/create-group',[TeacherController::class,'createGroup']);


//admin

Route::get('/admin/dashboard',[AdminLayoutController::class,'dashboard']);
Route::get('/admin/form',[AdminLayoutController::class,'checkForm']);
Route::get('/admin/table',[AdminLayoutController::class,'checkTable']);
Route::post('/admin/update-profile',[AdminLayoutController::class,'updateProfile']);

//project

Route::get('admin/project_idea', [ProjectController::class, 'ProjectIdea']);
Route::post('admin/project_submit', [ProjectController::class, 'ProjectSubmit']);
Route::get('admin/projectsub', [ProjectController::class, 'projects']);
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('admin/project/{projectId}', [ProjectController::class, 'approve']);
Route::get('admin/project/{projectId}/approve', [ProjectController::class, 'approveProject'])->name('project.approve');

//department

Route::get('/department/create',[DepartmentController::class, 'create']);
Route::post('/department/store',[DepartmentController::class, 'store']);
Route::get('/department/all',[DepartmentController::class, 'all']);
Route::get('/department/edit/{id}',[DepartmentController::class, 'edit']);
Route::post('/department/update/{id}',[DepartmentController::class, 'update']);
Route::get('/department/delete/{id}',[DepartmentController::class, 'delete']);




