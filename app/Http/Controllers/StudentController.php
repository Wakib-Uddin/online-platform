<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Assigncourse;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function dashboard(){
        $id = Session::get('id');
        $student = Student::where('id', $id)->first();
        return view('student.pages.dashboard',compact('student'));
    }
    public function updateProfile(Request $r){
        $id = Session::get('id');
        $student = Student::find($id);

        $student->name = $r->name;
        $student->email = $r->email;

        if($r->image!=null){
            $originalImage = $r->file('image');
            //dd($originalImage);
            $thumbnailImage = Image::make($originalImage);

            $thumbnailPath = public_path().'/thumbnail/';
            $originalPath = public_path().'/img/';

            //rename image;
            $temp = $originalImage->getClientOriginalName();
            $temp_ext=(explode(".",$temp));
            $ext = end($temp_ext);
            $filename = time().'.'.$ext;

            $thumbnailImage->save($originalPath.$filename);
            $thumbnailImage->resize(250,250);
            $thumbnailImage->save($thumbnailPath.$filename);

            //rename image
            
            $old_img = $student->image;
            if($old_img!='user.jpg'){
                if(File::exists(public_path('img/'.$old_img))){
                    File::delete(public_path('img/'.$old_img));
                }
                if( File::exists(public_path('thumbnail/'.$old_img))){
                    File::delete(public_path('thumbnail/'.$old_img));
                }
            }

            $student->image=$filename;
        }
        if($student->save()){
            Session::put('image',$student->image);
            return redirect()->to('student/dashboard');
        }
    }
    public function enrollment(){
        $sessions = Session::where('status','=',1)->get();
        return view('student.pages.enrollment',compact('sessions'));
    }
    public function getAssignedCourses ($id){
        $courses = Assigncourse::where('session_id','=',$id)
                            ->join('teachers','teachers.id','=','assigncourses.teacher_id')
                            ->join('courses','courses.id','=','assigncourses.course_id')
                            ->join('sections','sections.id','=','assigncourses.section_id')
                            ->select('assigncourses.id as id','teachers.name as teacher','courses.name as course','sections.name as section')
                            ->get();
        if($courses){
            return response()->json(array('courses'=> $courses));
        }
    }
    public function storeEnroll(Request $r){
        $id = Session::get('id');
        $acid = $r->input('check');
        $len = count($acid);
        for($i=0;$i<$len;$i++){
            $enroll = new Enrollment();
            $enroll->ac_id = $acid[$i];
            $enroll->student_id = $id;
            $enroll->status = 0;
            $enroll->save();
        }
        return redirect()->back()->with('info','Successfully enrolled');
    }
    




}
