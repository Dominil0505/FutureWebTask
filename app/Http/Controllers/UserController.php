<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //login
    function login(){
        return view('login');
    }

    // login post
    public function postLogin(Request $request){

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
    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('login');
    }


    // register post
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/')->with('succes', 'Sikeres regisztráció');

    }

    public function users(){

        if(Auth::check()){
            return view('users');
        }

        return redirect('Nincs hozzáférésed az odalhoz!');
    }
}
