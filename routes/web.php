<?php

use App\Http\Controllers\__Blade\HomeController;
use App\Http\Controllers\__Blade\Posts\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('/')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('website/postsx')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/get-by-id/{id}', [PostController::class, 'getByID']);
        Route::get('/get-my-posts', [PostController::class, 'viewMyPosts']);
        Route::put('/update/{id}', [PostController::class, 'update']);
        Route::delete('/{id}/delete', [PostController::class, 'delete']);
    });
});
