<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){

        if(Auth::check()){
            $posts = Post::all();

            return view('posts', ['allOurPost' => $posts]);
        }

        return redirect('Nincs hozzáférésed az odalhoz!');
    }
}
