<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        return redirect("/")->with('error', 'Valami hiba');
    }

    // create page
    public function createPostPage()
    {
        if (Auth::check()) {
            return view('createPost');
        }
        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    // post create
    public function createPost(Request $request)
    {

        if (Auth::check()) {
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

        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    public function getUserPost($user_name)
    {
        if (Auth::check()) {
            // get username
            $user = User::where('name', $user_name)->first();

            if ($user) {
                $posts = Post::where('user_id', $user->id)->get();

                return view('usersPost', ['user' => $user, 'ownPost' => $posts]);
            }
        }

        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    public function showPostWithComments($post_title)
    {
        if (Auth::check()) {
            $post = Post::where('post_title', $post_title);

            if (!$post) {
                return redirect("/users/post")->with('empty', 'A poszt nem található.');
            }

            $post_id = $post->post_id;
            $comments = Comment::where('post_id', $post_id)->get();

            return view('ownPostWithComment', ['posts' => $post, 'comments' => $comments]);
        }

        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    public function deletePost($post_id)
    {
        if (Auth::check()) {
            $post = Post::where('post_id', $post_id);

            if (!$post) {
                return redirect("/users/post")->with('empty', 'A poszt nem található.');
            }

            $post->delete();

            return redirect("/posts")->with('success', 'Sikeres törlés!');
        }

        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    // edit post page
    public function editPost($post_id){
        if(Auth::check()){
            $post = Post::where('post_id', $post_id)->first();

            if (!$post) {
                return redirect("/users/post")->with('empty', 'A poszt nem található.');
            }

            return view('editPost', ['post' => $post]);
        }
        return redirect("/")->with('error', 'Nincs hozzáférésed az oldalhoz');
    }

    // edit post request
    public function updatePost(Request $request, $post_id){
        if(Auth::check()){
            $post = Post::find($post_id);

            if(!$post){
                return redirect()->back()->with('error', 'A komment nem található.');
            }

            if (auth()->user()->id !== $post->user_id) {
                return redirect()->back()->with('error', 'Nincs engedélyed a komment frissítéséhez.');
            }

            $request->validate([
                'post_title' => 'required|string',
                'content' => 'required|string',
            ]);

            $post->title = $request->input('post_title');
            $post->content = $request->input('content');
            $post->save();

            return redirect('posts/edit/'.$post_id)->with('post', $post)->with('updated', 'Poszt frissitve sikeresen frissítve.');
        }
        return redirect("/")->withErrors('error', 'Valami hiba');
    }
}
