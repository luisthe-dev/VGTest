<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('blogs')->group(function () {

    Route::get('', [BlogController::class, 'getBlogs']);
    Route::post('', [BlogController::class, 'createBlog']);

    Route::prefix('{blog}')->group(function () {
        Route::get('', [BlogController::class, 'getSingleBlog']);
        Route::patch('', [BlogController::class, 'updateSingleBlog']);
        Route::delete('', [BlogController::class, 'deleteSingleBlog']);

        Route::get('posts', [PostController::class, 'getBlogPosts']);
        Route::post('posts', [PostController::class, 'createBlogPost']);
    });
});


Route::prefix('posts/{post}')->group(function () {

    Route::get('', [PostController::class, 'getSinglePost']);
    Route::patch('', [PostController::class, 'updateSinglePost']);
    Route::delete('', [PostController::class, 'deleteSinglePost']);

    Route::prefix('interact')->group(function () {
        Route::post('like', [InteractionController::class, 'updateLikeInteraction']);
        Route::post('comment', [InteractionController::class, 'updateCommentInteraction']);
    });
});
