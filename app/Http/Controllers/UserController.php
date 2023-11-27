<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function login(Request $request){
        return view('user.login');
    }

    public function postLogin(Request $request){
        
    }

    public function register(Request $request){

    }

    public function postRegister(Request $request){
        
    }
}
