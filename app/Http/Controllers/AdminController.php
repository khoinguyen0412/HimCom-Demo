<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function login(Request $request){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        try{
            $data = $request->all();
            $validator = Validator::make($data,[
                'email' => 'required|email',
                'password'=>'required'
            ]);
            
            if ($validator->fails()){
                return redirect('/admin/login')->withErrors($validator->errors());
            }

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)){
                return redirect()->intended('admin/dashboard');
            }
            else{
                return redirect('/admin/login')->with(['message' => 'Invalid credentials']);
            }

            
        }catch(\Exception $e){
            return redirect('/admin/login')->with('message', 'Something went wrong. Please try again');
        };
    }

    // public function register(Request $request){
    //     return view('admin.register');
    // }

    // public function postRegister(Request $request){
    
    // }

    public function dashboard(Request $request){
        return view('admin.dashboard');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin-login')->with('success','Successfully logged out');
    }
}
