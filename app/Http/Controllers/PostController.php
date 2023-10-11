<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // check Authentication
    protected function checkAuthenticationAndRedirect()
    {
        if (!Auth::check()) {
            return redirect("/")->withErrors('error', 'Valami hiba');
        }
    }

    // get posts
    protected function getPost($post_id)
    {
        $post = Post::find($post_id);

        if (!$post) {
            return redirect('posts')->with('error', 'A rekord nem található.');
        }

        return $post;
    }

    // index list all posts
    public function index()
    {
        $this->checkAuthenticationAndRedirect();


        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();

        return view('postsPage.posts', ['allOurPost' => $posts]);
    }

    // create page
    public function createPostPage()
    {
        $this->checkAuthenticationAndRedirect();
        return view('postsPage.createPost');
    }

    // post create
    public function createPost(Request $request)
    {
        $this->checkAuthenticationAndRedirect();


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
        $this->checkAuthenticationAndRedirect();
        $user = User::where('name', $user_name)->first();

        if ($user) {
            $posts = Post::where('user_id', $user->id)->get();

            return view('usersPost', ['user' => $user, 'ownPost' => $posts]);
        }
    }

    public function showPostWithComments($post_title)
    {
        $this->checkAuthenticationAndRedirect();

        $post = Post::where('title', $post_title)->first();

        if (!$post) {
            return redirect("/users/post")->with('empty', 'A poszt nem található.');
        }

        $comments = Comment::where('post_id', $post->post_id)->get();

        return view('postsPage.ownPostWithComment', ['posts' => $post, 'comments' => $comments]);
    }

    public function deletePost($post_id)
    {
        $this->checkAuthenticationAndRedirect();

        $post = $this->getPost($post_id);
        $post->delete();

        return redirect("/posts")->with('success', 'Sikeres törlés!');
    }

    // edit post page
    public function editPost($post_id)
    {
        $this->checkAuthenticationAndRedirect();
        $post = $this->getPost($post_id);

        return view('postsPage.editPost', ['post' => $post]);
    }

    //##################
    // Itt valami hiba van még!!!
    //##################
    // edit post request
    public function updatePost(Request $request, $post_id)
    {
        $user = auth()->user();
        $post = $this->getPost($post_id);

        if ($user->id !== $post->user_id) {
            return redirect('/')->withErrors('error', 'Nincs engedélyed a poszt frissítéséhez.');
        }

        $validatedData = $request->validate([
            'post_title' => 'string',
            'content' => 'string',
        ]);

        $post->update($validatedData);

        return redirect('posts/edit/' . $post_id)->with('posts', $post)->with('updated', 'Poszt sikeresen frissítve.');
    }
}
