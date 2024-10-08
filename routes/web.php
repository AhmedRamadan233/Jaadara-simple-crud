<?php

use App\Http\Controllers\__Auth\Blade\Login\LoginController;
use App\Http\Controllers\__Auth\Blade\Register\RegisterController;
use App\Http\Controllers\__Auth\Blade\Verification\EmailVerificationNotificationController;
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

Route::get('register', [RegisterController::class, 'index'])->name('register.index');
Route::post('register/store', [RegisterController::class, 'register'])->name('register.store');

Route::post('verify-email/store', [EmailVerificationNotificationController::class, 'verify'])->name('verify');
Route::get('verify-email', [EmailVerificationNotificationController::class, 'index'])->name('verify.index');

Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login/store', [LoginController::class, 'login'])->name('login.store');




Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('website/postsx')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('posts.edit');
        Route::post('/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/delete/{id}', [PostController::class, 'delete']);
    });
});
