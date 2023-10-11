<?php

namespace App\Http\Controllers;

use App\Jobs\SendCommentNotification;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{

    // get Comments
    protected function getComment($comment_id)
    {
        $comment = Comment::find($comment_id);

        if (!$comment) {
            return redirect('comments')->with('error', 'A rekord nem található.');
        }

        if (auth()->user()->id !== $comment->user_id) {
            return redirect('comments')->with('error', 'Nincs engedélyed a komment frissítéséhez.');
        }

        return $comment;
    }

    // check Authentication
    protected function checkAuthenticationAndRedirect()
    {
        if (!Auth::check()) {
            return redirect("/")->withErrors('error', 'Valami hiba');
        }
    }

    // all comments page
    public function index()
    {

        $this->checkAuthenticationAndRedirect();
        $user = Auth::user();
        $comments = Comment::where('user_id', $user->id)->get();

        return view('commentsPage.comments', ['comments' => $comments]);
    }

    // create comment page
    public function createCommentPage()
    {
        $this->checkAuthenticationAndRedirect();
        $posts = Post::all();
        return view('commentsPage.createComment', ['posts' => $posts]);
    }

    public function createComment(Request $request)
    {
        $this->checkAuthenticationAndRedirect();

        $request->validate([
            'content' => 'required',
        ]);

        $user_id = auth()->user()->id;

        $comment = Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post_id'),
            'user_id' => $user_id,
        ]);

        SendCommentNotification::dispatch($comment, $request->input('post_id'))->delay(now()->addMinutes(10));
        return redirect('createComment')->with('success', 'Komment sikeresen létrehozva!');
    }

    public function deleteComment($comment_id)
    {

        $this->checkAuthenticationAndRedirect();

        $comment = Comment::where('comment_id', $comment_id)->first();
        $comment->delete();

        return redirect('comments')->with('delete', 'A komment törölve lett.');
    }

    // edit comment page
    public function editCommentPage($comment_id)
    {

        $this->checkAuthenticationAndRedirect();

        $comment = $this->getComment($comment_id);

        return view('commentsPage.editComment', ['comment' => $comment]);
    }

    // comment edit post request
    public function updateComment(Request $request, $comment_id)
    {
        $this->checkAuthenticationAndRedirect();

        $comment = $this->getComment($comment_id);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect('comments/edit/' . $comment_id)->with('comment', $comment)->with('updated', 'Komment sikeresen frissítve.');
    }


    public function mailcomment(){
        return view('commentsPage.commentNotification');
    }
}
