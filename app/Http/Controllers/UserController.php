<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class UserController extends Controller
{
    public function pendingusers(){
        $pending_user= User::where('status','=','0')->get();

        return view('admin.pages.pending_user',compact('pending_user'));
    }

    public function approveusers($id){
        
        user::where('id', $id)
              ->update(['status'=>true]);
        return redirect()->back();


    }

    //public function approveusers($id){
        //$pending_user = user::find($id);
       // $pending_user->is_approved = 1;
        //if($pending_user->save()){
            //return redirect()->back();
        //}
    //} 









    public function editstudent($id){
        $user_student=user::where('id','=',$id)->get();
        $get_student=compact('user_student');

        return view('admin.pages.authoraization.student_register')->with($get_student);



    }

}
