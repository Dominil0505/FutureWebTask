<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    // index list all posts
    public function index()
    {

        if (Auth::check()) {
            $user = Auth::user();
            $posts = Post::where('user_id', $user->id)->get();

            return view('posts', ['allOurPost' => $posts]);
        }

        return redirect("/")->with('error' , 'Valami hiba');

    }

    // create page
    public function createPostPage()
    {
        return view('createPost');
    }

    // post create
    public function createPost(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $user_id = auth()->user()->id;

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $user_id
        ]);

        return redirect('createPost')->with('success', 'Sikeres posztolás!');
    }

    public function getUserPost($user_name)
    {
        if (Auth::check()) {
            // get username
            $user = User::where('name', $user_name)->first();

            if ($user) {
                $posts = Post::where('user_id', $user->id)->get();

                return view('usersPost', ['user' => $user,'ourPost' => $posts]);
            }
        }

        return redirect("/")->with('error' , 'Valami hiba');
    }

    public function showPostWithComments(){

    }
}
