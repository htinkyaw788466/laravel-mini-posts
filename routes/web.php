<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//list all posts
Route::get('/',([PostController::class,'index']))->name('all.posts');

//create post form
Route::get('/posts/create',([PostController::class,'create']))
       ->name('posts.create');

//validate new post
Route::post('/posts/create',([PostController::class,'store']))
       ->name('posts.store');

//edit post form
Route::get('/posts/{id}/edit',([PostController::class,'edit']))
      ->name('posts.edit');

//validate edit post
Route::put('/posts/{id}/edit',([PostController::class,'update']))
       ->name('posts.update');

//post detail
Route::get('/posts/{id}/show',([PostController::class,'show']))
       ->name('posts.show');

//post delete
Route::get('/posts/{id}/delete',([PostController::class,'destroy']))
       ->name('posts.destroy');

//create post comment route
Route::post('/comments/store',([CommentController::class,'store']))
       ->name('comments.store');

//post comment route destroy
Route::get('/comments/{id}/delete',([CommentController::class,'destroy']))
       ->name('comments.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
