<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;

Route::get('/', function () {
    $userPosts = [];
    if (auth()->check()) {
        $userPosts = auth()->user()->userPosts()->latest()->get(); 
    }
    return view('home', ['posts' => Post::all()], ['userPosts' => $userPosts]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/createPost', [PostController::class, 'createPost']);
Route::get('/edit/{userPost}', [PostController::class, 'getPost']);
Route::put('/edit/{userPost}', [PostController::class, 'editPost']);
Route::delete('/delete/{userPost}', [PostController::class, 'deletePost']);