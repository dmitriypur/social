<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/{user}/posts', [\App\Http\Controllers\UserController::class, 'show']);
    Route::post('/users/{user}/toggle_following', [\App\Http\Controllers\UserController::class, 'toggleFollowing']);
    Route::get('/users/following_posts', [\App\Http\Controllers\UserController::class, 'followingPosts']);

    Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store']);
    Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index']);
    Route::post('/post_image', [\App\Http\Controllers\PostImageController::class, 'store']);
    Route::post('/posts/{post}/toggle_like', [\App\Http\Controllers\PostController::class, 'toggleLike']);
});
