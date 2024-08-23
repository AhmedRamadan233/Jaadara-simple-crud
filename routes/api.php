<?php

use App\Http\Controllers\__Api\Posts\PostController;
use App\Http\Controllers\__Auth\Login\LoginController;
use App\Http\Controllers\__Auth\Register\RegisterController;
use App\Http\Controllers\__Auth\Verification\EmailVerificationNotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('send-email-verification', [EmailVerificationNotificationController::class, 'sendEmailVerification']);
Route::post('verify-email', [EmailVerificationNotificationController::class, 'verify']);
Route::post('login', [LoginController::class, 'login']);

// Route::prefix('posts')->group(function () {
//     Route::get('/', [PostController::class, 'index']);
//     Route::get('/get-by-id/{id}', [PostController::class, 'getByID']);
// });
Route::prefix('/')->middleware('auth:sanctum')->group(function () {
    Route::get('/destroy',function(){
        dd("ssss");
    });
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/get-by-id/{id}', [PostController::class, 'getByID']);
        Route::get('/get-my-posts', [PostController::class, 'viewMyPosts']);
        Route::post('/store', [PostController::class, 'store']);
        Route::put('/update/{id}', [PostController::class, 'update']);
        Route::delete('/{id}/delete', [PostController::class, 'delete']);
    });
});
