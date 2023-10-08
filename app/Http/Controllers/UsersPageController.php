<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
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

        return redirect("/")->with('error' , 'Valami hiba');
    }

    public function showUserPostWithComments($username){
        if (Auth::check()) {

            $user = User::where('name', $username)->first();

            if ($user) {
                $posts = Post::where('user_id', $user->id)->get();

                return view('postWithComments', ['user' => $user,'ownPost' => $posts]);
            }
        }

        return redirect("/")->with('error' , 'Valami hiba');
    }

    public function showAllCommentToUserPost($username, $post_title){
        if (Auth::check()) {
            $post = Post::where('title', $post_title)->first();

            if (!$post) {
                return redirect("/users/post")->with('empty', 'A poszt nem található.');
            }

            $post_id = $post->post_id;
            $comments = Comment::where('post_id', $post_id)->get();

            return view('allCommentToUserPost', ['post' => $post, 'comments' => $comments]);
        }

        return redirect("/")->with('error' , 'Valami hiba');
    }

}
