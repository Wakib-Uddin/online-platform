<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(){
        return view('website.pages.home');

    }

    public function about(){
        return view('website.pages.about');
    }

    public function contact(){
        return view('website.pages.contact');
    }

    public function services(){
        return view('website.pages.services');
    }
}
