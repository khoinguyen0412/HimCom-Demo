<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function login(Request $request){
        return view('user.login');
    }

    public function postLogin(Request $request){
        try{
            $data = $request->all();
            $validator = Validator::make($data,[
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
                    },
                ]
            ]);
            
            if ($validator->fails()){
                return redirect('/user/login')->withErrors($validator->errors());
            }
          
        }catch(\Exception $e){
            return redirect('/user/login')->withErrors('Error registering user');
        }
    }

    public function register(Request $request){
        return view('user.register');
    }

    public function postRegister(Request $request){
        try{
            DB::beginTransaction();
            $data = $request->all();
            $validator = Validator::make($data,[
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
                    },
                ]
            ]);
            
            if ($validator->fails()){
                return redirect('/user/register')->withErrors($validator->errors());
            }
            $user = new User();
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();
            DB::commit();
            return redirect('/user/login')->with('success','Successfully created user');

        }catch(\Exception $e){
            DB::rollBack();
            return redirect('/user/register')->withErrors('Error registering user');
        }
    }
}
