<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // index list all posts
    public function index(){

        if(Auth::check()){
            $posts = Post::all();

            return view('posts', ['allOurPost' => $posts]);
        }

        return redirect('accessdenied');
    }


    // create page
    public function createPage(){
        return view('createPost');
    }

    // post create
    public function create(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $user_id = auth()->user()->id;

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $user_id
        ]);

        return redirect('createPost')->with('success', 'Sikeres posztolás!');
    }

}
