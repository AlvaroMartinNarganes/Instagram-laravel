<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

//Home
Route::get('/', HomeController::class)->name('home');


//Sign-up
Route::get('/sign-up', [RegisterController::class,'index'])->name('sign-up');
Route::post('/sign-up', [RegisterController::class,'store']);

//Login
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

//Profile
Route::get('/edit-profile',[ProfileController::class,'index'])->name('profile.index');
Route::post('/edit-profile',[ProfileController::class,'store'])->name('profile.store');

//Logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//Dashboard and posts
Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index'); //Get dashboard view
Route::get('/posts/create',[PostController::class,'create'])->name('posts.create'); //Get post form view
Route::post('/posts',[PostController::class,'store'])->name('posts.store'); //Post
Route::get('{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show'); //Get one post
Route::delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');//Delete a post
//new post
Route::post('{user:username}/posts/{post}',[CommentController::class,'store'])->name('comments.store');
//Save Image
Route::post('/images',[ImageController::class,'store'])->name('images.store');

//Like controll
Route::post('/posts/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Follow controll
Route::post('/{user:username}/follow',[FollowerController::class,'store'])->name('users.follow');
Route::delete('/{user:username}/follow',[FollowerController::class,'destroy'])->name('users.unfollow');




