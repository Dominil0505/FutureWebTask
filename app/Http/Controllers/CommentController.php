<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){

        if(Auth::check()){
            $comments = Comment::all();

            return view('comments', ['allComments' => $comments]);
        }

        return redirect('accessdenied');
    }
}
