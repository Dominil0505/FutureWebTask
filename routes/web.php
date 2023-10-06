<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('register');
});

Route::get('login', [UserController::class, 'login']);

Route::post('postLogin', [UserController::class, 'postLogin']);
Route::post('postRegister', [UserController::class, 'postRegister']);

Route::get('logout', [UserController::class, 'logout']);

Route::get('users', [UserController::class, 'users']);

//Route::get();
