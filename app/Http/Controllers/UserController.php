<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{

    //login page
    function login(){
        return view('user.login');
    }

    // register page
    function register(){
        return view('user.register');
    }

    // login post
    function postLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // check email verification
        $user = User::where('email', $request->email)->first();
        if ($user && $user->email_verified_at === null) {
            return redirect("/")->with('error', 'Nem sikerült bejelentkezni. Az email cím nincs visszaigazolva.');
        }

        // handle login
        if (Auth::attempt($credentials)) {
            return redirect()->intended('users')->with('success', 'Sikeres bejelentkezés!');
        }

        return redirect("/")->with('error', 'Sikertelen bejelentkezés! Hibás bejelentkezési adatokat adtál meg vagy nincs ilyen felhasználó.');
    }


    // handle user logout
    function logout(){
        Session::flush();
        Auth::logout();

        return redirect('/');
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
        $token = Str::random(64);


        // add user to database
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => $token
        ]);

        Mail::send('email.emailVerification', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        return redirect('register')->with('success', 'Sikeres regisztráció. Ellenőrizze az emailjét az aktivációs linkért');

    }

    function verifyAccount($token){
        $verifyUser = User::where('remember_token', $token)->first();

        $message = 'Az email cím nincs visszaigazolva!';

        if(!is_null($verifyUser)){
            $verifyUser->email_verified_at = now();
            $verifyUser->save();
            $message = "Email cím visszaigazolva. Most már bejelentkezhetsz.";
        } else {
            $message = "Az ön email címe már ellenőrzive van. Bejelentkezhet";
        }

        return redirect('/')->with('email', $message);
    }
}
