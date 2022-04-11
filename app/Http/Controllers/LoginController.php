<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {   
        if(Auth::check()){
            return route('home');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => 'Username không được để trống',
                'password.required' => 'Password không được để trống'
            ]
        );

        if( Auth::attempt(['name' => $request->name, 'password' => $request->password])){
            return redirect()->route('home');
        }else{
            return redirect()->back()->with('err' , 'Thông tin đăng nhập không đúng');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
