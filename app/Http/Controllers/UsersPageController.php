<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersPageController extends Controller
{
    public function index(){

        if(Auth::check()){
            $users = User::all();
            return view('users', ['allUsers' => $users]);
        }

        return redirect('Nincs hozzáférésed az odalhoz!');
    }
}
