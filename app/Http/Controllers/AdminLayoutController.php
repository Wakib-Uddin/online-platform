<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Models\Session;
use App\Models\Assigncourse;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Models\Student;

class AdminLayoutController extends Controller
{

    public function dashboard(){
        return view('admin.pages.dashboard');
    }

    public function tables(){
        return view('admin.pages.tables');
    }

    public function login(){
        return view('admin.pages.login');
    }

    public function register(){
        return view('admin.pages.register');
    }

    // Course management
    public function createCourse(){
        return view('admin.pages.createCourse');
    }

    public function storeCourse(Request $r){
        $course = Course::where('code','=',$r->code)->first();
        if($course){
            return redirect()->back()->with('err','course already exists');
        }
        else{
            $course = new Course();
            $course->name = $r->name;
            $course->code = $r->code;
            if($course->save()){
                return redirect()->back()->with('info','course created successfully');
            }
        }
    }

    public function allCourses(){
        $courses = Course::all();
        return view('admin.pages.allCourses',compact('courses'));
    }

    public function editCourse($id){
        $u = Course::find($id);
        return view('admin.pages.editCourse',compact('u'));
    }

    public function deleteCourse($id){
        $Course = Course::find($id);
        if(!is_null($Course)){
            $Course->delete();
            return redirect()->back()->with('scs','Course deleted successfully');
        }
    }

    public function updateCourse($id,Request $r){
        $course = Course::find($id);
        $code = $r->code;
        $name = $r->name;
        $c = Course::where('code','=',$code)->first();
        if($course->code != $code && $c){
            return redirect()->back()->with('err','course already exists');
        }
        else{
            $course->name = $name;
            $course->code = $code;
            if($course->save()){
                return redirect()->back()->with('info','course edited successfully');
            }
        }
    }

    // Section management
    public function createSection(){
        return view('admin.pages.createSection');
    }

    public function storeSection(Request $r){
        $section = Section::where('name','=',$r->name)->first();
        if($section){
            return redirect()->back()->with('err','section already exists');
        }
        else{
            $section = new Section();
            $section->name = $r->name;
            if($section->save()){
                return redirect()->back()->with('info','section created successfully');
            }
        }
    }

    // Session management
    public function createSession(){
        return view('admin.pages.createSession');
    }

    public function storeSession(Request $r){
        $session = Session::where('name','=',$r->name)->first();
        if($session){
            return redirect()->back()->with('err','session already exists');
        }
        else{
            $session = new Session();
            $session->name = $r->name;
            $session->status = 1;
            if($session->save()){
                return redirect()->back()->with('info','sesssion created successfully');
            }
        }
    }

    public function allSessions(){
        $users = Session::all();
        return view('admin.pages.allSessions',compact('users'));
    }

    public function updateSession($id){
        $session = Session::find($id);
        $session->status = $session->status == 0 ? 1 : 0;
        if($session->save()){
            return redirect()->to('admin/all-sessions');
        }
    }

    // Assigning courses
    public function assignCourse(){
        $sessions = Session::where('status','=',1)->get();
        $sections = Section::all();
        $courses = Course::all();
        $teachers = Teacher::all();

        return view('admin.pages.assignCourse',compact('sessions','sections','courses','teachers'));
    }

    public function storeAsssignCourse(Request $r){
        $session = $r->session;
        $course = $r->input('course');
        $section = $r->input('section');
        $teacher = $r->input('teacher');

        // Check if $course is an array before calling count()
        if (is_array($course)) {
            $len = count($course);
            for($i = 0; $i < $len; $i++){
                $ac = Assigncourse::where('session_id', '=', $session)
                                ->where('section_id', '=', $section[$i])
                                ->where('course_id', '=', $course[$i])
                                ->where('teacher_id', '=', $teacher[$i])
                                ->delete();

                $ac = new Assigncourse();
                $ac->session_id = $session;
                $ac->section_id = $section[$i];
                $ac->course_id = $course[$i];
                $ac->teacher_id = $teacher[$i];
                $ac->save();
            }
            return redirect()->back()->with('info','Courses assigned successfully');
        } else {
            return redirect()->back()->with('err', 'No course data provided');
        }
    }

    public function test(){
        $as = Assigncourse::all();
    }

    // Enrollment management
    public function checkForm(){
        return view('admin.pages.forms');
    }

    public function enrollments(){
        $enrolls = Enrollment::where('enrollments.status','=',0)
                        ->join('students','students.id','=','enrollments.student_id')
                        ->join('assigncourses','assigncourses.id','=','enrollments.ac_id')
                        ->join('teachers','teachers.id','=','assigncourses.teacher_id')
                        ->join('courses','courses.id','=','assigncourses.course_id')
                        ->join('sections','sections.id','=','assigncourses.section_id')
                        ->join('sessions','sessions.id','=','assigncourses.session_id')
                        ->select('enrollments.id as id','sessions.name as session','students.name as student','teachers.name as teacher','courses.name as course','sections.name as section')
                        ->get();

        return view('admin.pages.enrollments',compact('enrolls'));
    }

    public function enrollApprove($id){
        $enroll = Enrollment::find($id);
        $enroll->status = 1;
        $enroll->save();
        return redirect()->to('admin/enrollment');
    }

    // Student management
    public function createStudent(){
        return view('admin.pages.createStudent');
    }

    public function storeStudent(Request $r){
        $name = $r->name;
        $email = $r->email;
        $password = $r->password;
        $student = Student::where('email','=',$email)->first();
        if($student){
            return redirect()->back()->with('err','email already exists');
        }
        else{
            $student = new Student();
            $student->name = $name;
            $student->email = $email;
            $student->password = md5($password);
            $student->image = 'user.jpg';
            if($student->save()){
                return redirect()->back()->with('info','student created successfully');
            }
        }
    }

    public function allStudents(){
        $users = Student::all();
        return view('admin.pages.allStudents',compact('users'));
    }

    public function editStudent($id){
        $u = Student::find($id);
        return view('admin.pages.editStudent',compact('u'));
    }

    public function updateStudent($id, Request $r){
        $student = Student::find($id);
        $name = $r->name;
        $email = $r->email;
        $s = Student::where('email','=',$email)->first();
        if($student->email != $email && $s){
            return redirect()->back()->with('err','email already exists');
        }
        else{
            $student->name = $name;
            $student->email = $email;
            if($student->save()){
                return redirect()->back()->with('info','student edited successfully');
            }
        }
    }

    public function deleteStudent($id){
        $student = Student::find($id);
        if(!is_null($student)){
            $student->delete();
            return redirect()->back()->with('scs','student deleted successfully');
        }
    }

    // Teacher management
    public function createTeacher(){
        return view('admin.pages.createTeacher');
    }

    public function storeTeacher(Request $r){
        $name = $r->name;
        $email = $r->email;
        $password = $r->password;
        $teacher = Teacher::where('email','=',$email)->first();
        if($teacher){
            return redirect()->back()->with('err','email already exists');
        }
        else{
            $teacher = new Teacher();
            $teacher->name = $name;
            $teacher->email = $email;
            $teacher->password = md5($password);
            $teacher->image = 'user.jpg';
            if($teacher->save()){
                return redirect()->back()->with('info','teacher created successfully');
            }
        }
    }

    public function allTeachers(){
        $users = Teacher::all();
        return view('admin.pages.allTeachers',compact('users'));
    }

    public function editTeacher($id){
        $u = Teacher::find($id);
        return view('admin.pages.editTeacher',compact('u'));
    }

    public function updateTeacher($id, Request $r){
        $teacher = Teacher::find($id);
        $name = $r->name;
        $email = $r->email;
        $s = Teacher::where('email','=',$email)->first();
        if($teacher->email != $email && $s){
            return redirect()->back()->with('err','email already exists');
        }
        else{
            $teacher->name = $name;
            $teacher->email = $email;
            if($teacher->save()){
                return redirect()->back()->with('info','teacher edited successfully');
            }
        }
    }

    public function deleteTeacher($id){
        $teacher = Teacher::find($id);
        if(!is_null($teacher)){
            $teacher->delete();
            return redirect()->back()->with('scs','teacher deleted successfully');
        }
    }

}

