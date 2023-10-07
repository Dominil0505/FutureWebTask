<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{

    // all comments page
    public function index()
    {
        if (Auth::check()) {

            $user = Auth::user();

            $comments = Comment::where('user_id', $user->id)->get();

            return view('comments', ['comments' => $comments]);
        }
        return redirect("/")->withErrors('error', 'Valami hiba');
    }



    // create comment page
    public function createCommentPage()
    {
        if (Auth::check()) {
            $posts = Post::all();

            return view('createComment', ['posts' => $posts]);
        }

        return redirect("/")->withErrors('error', 'Valami hiba');
    }

    public function createComment(Request $request)
    {

        $request->validate([
            'content' => 'required',
        ]);

        $user_id = auth()->user()->id;

        Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'user_id' => $user_id,
        ]);

        return redirect('createComment')->with('success', 'Komment sikeresen létrehozva!');
    }

    public function deleteComment($id){

        // HIBA VAN!!!!
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect('comments')->with('error', 'A rekord nem található.');
        }

        // Soft delete
        $comment->delete();

        return redirect('comments')->with('delete', 'A komment törölve lett.');

    }
}
