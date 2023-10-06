<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //login page
    function login(){
        return view('login');
    }

    // register page
    function register(){
        return view('register');
    }

    // login post
    function postLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // handle login
        if(Auth::attempt($credentials)){
            return redirect()->intended('users')->withSucces('Sikeres bejelentkezés!');
        }

        return redirect("login")->with('succes' , 'Sikertelen bejelenkezés! Hibás bejelentkezési adatokat adtál meg.');
    }

    // handle user logout
    function logout(){
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    // register post
    function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();

        // add user to database
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/')->with('succes', 'Sikeres regisztráció');

    }
}
