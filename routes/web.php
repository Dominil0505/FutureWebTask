<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'login']); // register page

/**
 * User Function routes
 */
Route::get('register', [UserController::class, 'register']); // register page
Route::post('postLogin', [UserController::class, 'postLogin']); // post login request
Route::post('postRegister', [UserController::class, 'postRegister']); //post register request
Route::get('logout', [UserController::class, 'logout']); // logout request
Route::get('account/verify/{token}', [UserController::class, 'verifyAccount']); // email verification request

/**
 * User Page function routes
 */
Route::get('users', [UsersPageController::class, 'index'])->middleware(['auth', 'verify_email']); // users page
Route::get('users/post/{post_title}', [UsersPageController::class, 'showUserPostWithComments']);
Route::get('users/post/{username}/{post_title}', [UsersPageController::class, 'showAllCommentToUserPost']);
Route::get('users/post/{username}', [PostController::class, 'getUserPost']); // show user Posts

/**
 * Posts function routes
 */
Route::get('posts', [PostController::class, 'index']); // posts page
Route::get('createPost', [ PostController::class, 'createPostPage']); //post create page
Route::post('createPost', [PostController::class, 'createPost']); // create post
Route::get('posts/{post_title}', [PostController::class, 'showPostWithComments']);
Route::get('posts/delete/{post_id}', [PostController::class, 'deletePost']); // delete post in posts page
Route::get('posts/edit/{post_id}', [PostController::class, 'editPost']); // edit post in posts page
Route::post('posts/edit/{post_id}', [PostController::class, 'updatePost']); // update post in posts page

/**
 * Comments function routes
*/
Route::get('comments', [CommentController::class, 'index']); // comments page
Route::get('createComment', [CommentController::class, 'createCommentPage']); // create comment page
Route::post('createCommentPost',[CommentController::class, 'createComment']); // create comment
Route::get('comments/delete/{comment_id}', [CommentController::class, 'deleteComment']); // delete comment in comment page
Route::get('comments/edit/{comment_id}', [CommentController::class, 'editCommentPage']); // edit comment page
Route::post('comments/edit/{comment_id}', [CommentController::class, 'updateComment']); // update comment post request


// Route::get('accessdenied', function(){
//     return view('accesssdenied');
// });
