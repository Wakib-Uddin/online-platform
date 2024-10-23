<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollController extends Controller
{
    public function Enroll(){
        return view('admin.pages.enroll');
    }
}
