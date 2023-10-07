<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersPageController;
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

Route::get('register', [UserController::class, 'register']); // login page

Route::post('postLogin', [UserController::class, 'postLogin']); // post login request
Route::post('postRegister', [UserController::class, 'postRegister']); //post register request

Route::get('logout', [UserController::class, 'logout']); // logout request

Route::get('users', [UsersPageController::class, 'index']); // users page

Route::get('posts', [PostController::class, 'index']); // posts page
Route::get('createPost', [ PostController::class, 'createPage']); //post create page
Route::post('createPost', [PostController::class, 'create']); // create post
Route::get('users/post/{username}', [PostController::class, 'getUserPost']);
//Route::get('{post_title}', [PostController::class, '']);


Route::get('comments', [CommentController::class, 'index']); // comments page

// Route::get('accessdenied', function(){
//     return view('accesssdenied');
// });
