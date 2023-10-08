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

    public function deleteComment($comment_id){

        $comment = Comment::where('comment_id',$comment_id)->first();

        if (!$comment) {
            return redirect('comments')->with('error', 'A rekord nem található.');
        }

        // Soft delete
        $comment->delete();

        return redirect('comments')->with('delete', 'A komment törölve lett.');

    }

    // edit comment page
    public function editCommentPage($comment_id){
        if (Auth::check()) {
            $comment = Comment::find($comment_id);

            return view('editComment', ['comment' => $comment]);
        }

        return redirect("/")->withErrors('error', 'Valami hiba');
    }

    // comment edit
    public function updateComment(Request $request, $comment_id){
        if(Auth::check()){
            $comment = Comment::find($comment_id);

            if(!$comment){
                return redirect()->back()->with('error', 'A komment nem található.');
            }

            if (auth()->user()->id !== $comment->user_id) {
                return redirect()->back()->with('error', 'Nincs engedélyed a komment frissítéséhez.');
            }

            $request->validate([
                'content' => 'required|string',
            ]);

            $comment->content = $request->input('content');
            $comment->save();

            return view('editComment')->with('comment', $comment)->with('updated', 'Komment sikeresen frissítve.');
        }
        return redirect("/")->withErrors('error', 'Valami hiba');
    }
}
