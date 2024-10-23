<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Session;
use App\Models\Teacher;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\File;


class TeacherController extends Controller
{

    public function dashboard(){
        $id = Session::get('id');
        $teacher = Teacher::find($id);
        return view('teacher.pages.dashboard',compact('teacher'));
    }
    public function updateProfile(Request $r){
        $id = Session::get('id');
        $teacher = Teacher::find($id);

        $teacher->name = $r->name;
        $teacher->email = $r->email;

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
            
            $old_img = $teacher->image;
            if($old_img!='user.jpg'){
                if(File::exists(public_path('img/'.$old_img))){
                    File::delete(public_path('img/'.$old_img));
                }
                if(File::exists(public_path('thumbnail/'.$old_img))){
                    File::delete(public_path('thumbnail/'.$old_img));
                }
            }

            $teacher->image=$filename;
        }
        if($teacher->save()){
            Session::put('image',$teacher->image);
            return redirect()->to('teacher/dashboard');
        }
    }
    public function createCourse(){
        $sessions = Session::where('status','=',1)->get();
        return view('teacher.pages.createCourse',compact('sessions'));
    }
    public function getCourse($id){
        $courses = Course::where('session_id','=',$id)->get();
        if($courses){
            return response()->json(array('courses'=> $courses));
        }
    }
    public function storeCourse(Request $r){
        $id = Session::get('id');
        Course::where('session_id','=',$r->session_id)
                ->where('teacher_id','=',$id)
                ->delete();
        
        $courses = $r->input('course');
        
        $len = count($courses);

        for($i = 0; $i < $len; $i++){  
           $c = new Course();
           $c->session_id = $r->session_id;
           $c->name = $courses[$i];
           $c->teacher_id = $id;
           $c->save();
        }
        return redirect()->back()->with('scs','Successfully inserted');
    }

    public function createGroup(){
        $sessions = Session::where('status','=',1)->get();
        return view('teacher.pages.createGroup',compact('sessions'));
    }
    



}
