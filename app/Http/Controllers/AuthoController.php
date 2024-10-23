<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Session; 

class AuthoController extends Controller
{
    

    public function login(){
        return view('admin.pages.authoraization.login');
    }

    public function userlogin(Request $req){

         $email=$req->email;
         $password=md5($req->password);

        $user=User::where('email','=',$email)
                    ->where('password','=',$password)
                    ->first();
        if($user){

            if($user->status==1){

            Session::put('user_fname',$user->first_name);
            Session::put('user_lname',$user->last_name);
            Session::put('user_email',$user->email);
            Session::put('user_role',$user->role);
            return redirect('admin/dashboard');


            }

            else{
                return redirect()->back()->with('error','User not Approved yet');


            }

        }
        else{
            return redirect()->back()->with('error','User Account not fund');


        }   

    }

    public function teacherRegister(){

        return view('admin.pages.authoraization.teacher_register');

    }
    public function teacherRegistration(Request $req){

        if($req->password==$req->confirm_password){

            $user_exists=user::where('email','=',$req->email)->first();
            if($user_exists){

                return redirect()->back()->with('error','Email already taken');


            }
            else{

                $user=new user();
            $user->first_name=$req->first_name;
            $user->last_name=$req->last_name;
            $user->email=$req->email;
            $user->password= md5($req->password);
            $user->role='Teacher';

            if($user->save()){
                return redirect()->back()->with('success','user registered... waiting for admin approval');
            }


            }

        }
        else{
            return redirect()->back()->with('error','miss-matched');
           
        }
       
        //$user->role=$req->name;
        //$user->status=$req->name;
        //dd($email, ' pass : ' .$password);
        //dd("yes");

       
    }

    public function studentRegister(){

        return view('admin.pages.authoraization.student_register');
    }

    public function studentRegistration(Request $req){

        if($req->password==$req->confirm_password){

            $user_exists=user::where('email','=',$req->email)->first();
            if($user_exists){

                return redirect()->back()->with('error','Email already taken');


            }
            else{

                $user=new user();
            $user->first_name=$req->first_name;
            $user->last_name=$req->last_name;
            $user->student_id=$req->roll;
            $user->email=$req->email;
            $user->password= md5($req->password);
            $user->role='Student';

            if($user->save()){
                return redirect()->back()->with('success','user registered... waiting for admin approval');
            }


            }

        }
        else{
            return redirect()->back()->with('error','miss-matched');
           
        }
    }

    public function logout(Request $req){

        $req->Session()->forget(['user_fname', 'user_lname', 'user_email', 'user-role']);

        return redirect ('admin/login');
    }

    public function adminlist(){
        $user_admin=user::where('role','=','Admin')->get();
        $get_admin=compact('user_admin');

        return view('admin.pages.adminlist')->with($get_admin);

    }

    public function studentlist(){
        $user_student=user::where('role','=','Student')->get();
        $get_student=compact('user_student');

        return view('admin.pages.studentlist')->with($get_student);

    }

    public function teacherlist(){
        $user_teacher=user::where('role','=','Teacher')->get();
        $get_teacher=compact('user_teacher');

        return view('admin.pages.teacherlist')->with($get_teacher);

    }






    public function adminRegister(){

        return view('admin.pages.authoraization.admin_register');

    }
    public function adminRegistration(Request $req){

        if($req->password==$req->confirm_password){

            $user_exists=user::where('email','=',$req->email)->first();
            if($user_exists){

                return redirect()->back()->with('error','Email already taken');


            }
            else{

                $user=new user();
            $user->first_name=$req->first_name;
            $user->last_name=$req->last_name;
            $user->email=$req->email;
            $user->password= md5($req->password);
            $user->role='Admin';

            if($user->save()){
                return redirect()->back()->with('success','user registered... waiting for admin approval');
            }


            }

        }
        else{
            return redirect()->back()->with('error','miss-matched');
           
        }
       
    }


}
