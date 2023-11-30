<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
        return view('user.register');
    }

    public function postRegister(Request $request){
        try{
            $data = $request->all();
            $validator = Validator::make([
                'email' => 'required|email',
                'password' => ['required',
                'string',
                'min:6',
                function ($attribute, $value, $fail) {
                    $patterns = [
                        '/[A-Z]/' => 'uppercase letter',
                        '/[a-z]/' => 'lowercase letter',
                        '/[0-9]/' => 'digit',
                        '/[@#$%^&+=]/' => 'special character',
                    ];
        
                    foreach ($patterns as $pattern => $patternDescription) {
                        if (!preg_match($pattern, $value)) {
                            $fail("The password must contain at least one $patternDescription.");
                        }
                    }
                },]
            ]);
            
            if ($validator->fails()){

            }
        }catch(\Exception $e){

        }
    }
}
