<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersPageController extends Controller
{
    // check Authentication
    protected function checkAuthenticationAndRedirect()
    {
        if (!Auth::check()) {
            return redirect("/")->withErrors('error', 'Valami hiba');
        }
    }

    public function index()
    {
        $this->checkAuthenticationAndRedirect();

        $users = User::all();
        return view('usersPage.users', ['allUsers' => $users]);
    }

    public function showUserPostWithComments($username)
    {
        $this->checkAuthenticationAndRedirect();

        $user = User::where('name', $username)->first();

        if ($user) {
            $posts = Post::where('user_id', $user->id)->get();

            return view('usersPage.postWithComments', ['user' => $user, 'ownPost' => $posts]);
        }
    }

    public function showAllCommentToUserPost($username, $post_title)
    {
        $this->checkAuthenticationAndRedirect();

        $post = Post::where('title', $post_title)->first();

        if (!$post) {
            return redirect("/users/post")->with('empty', 'A poszt nem található.');
        }

        $comments = Comment::where('post_id', $post->post_id)->get();

        return view('usersPage.allCommentToUserPost', ['post' => $post, 'comments' => $comments]);
    }
}
