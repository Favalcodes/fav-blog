<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/post/create', [PostController::class, 'create']);
Route::patch('/post/update/{id}', [PostController::class, 'update']);
Route::delete('/post/delete/{id}', [PostController::class, 'delete']);

Route::post('/comment/create', [CommentController::class, 'create']);
Route::patch('/comment/update/{id}', [CommentController::class, 'update']);
Route::delete('/comment/delete/{id}', [CommentController::class, 'delete']);
Route::get('/comments/{postId}', [CommentController::class, 'getCommentsByPost']);
