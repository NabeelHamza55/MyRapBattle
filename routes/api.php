<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signup', [AuthController::class, 'signUp'])->name('signup');
Route::post('signin', [AuthController::class, 'signIn'])->name('signin');
Route::post('socialLogin', [AuthController::class, 'socialLogin'])->name('socialLogin');
Route::post('forgetPassword', [AuthController::class, 'forgetPass'])->name('forgetPassword');
Route::put('updatePassword', [AuthController::class, 'updatePassword'])->name('updatePassword');

// Route::middleware(['auth:sanctum'])->group(function () {
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home/category', [HomeController::class, 'categoryIndex'])->name('categoryHome');
Route::get('videos', [VideoController::class, 'show'])->name('video');
Route::post('like', [VideoController::class, 'likeVideo'])->name('likeVideo');
Route::get('search', [VideoController::class, 'searchVideos'])->name('searchVideos');
Route::get('trendings', [VideoController::class, 'trendingVideos'])->name('trendingVideos');
Route::get('category/videos', [VideoController::class, 'videosByCategory'])->name('videosByCategory');
Route::put('changePassword', [UserController::class, 'changePassword'])->name('changePassword');
Route::put('changeUsername', [UserController::class, 'changeUsername'])->name('changeUsername');
Route::put('changeUserImage', [UserController::class, 'changeUserImage'])->name('changeUserImage');
// });
