<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function login(Request $request){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        return ;
    }

    public function register(Request $request){

    }

    public function postRegister(Request $request){

    }

    public function dashboard(Request $request){
        return view('admin.dashboard');
    }
}
