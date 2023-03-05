<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class WelcomeController extends Controller
{
    public function welcome(){
        
        Session::flash('message','Welcome to our website');
       return view('welcome');
    }
}
