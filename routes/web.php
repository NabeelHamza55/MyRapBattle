<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;

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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    // Categories Routes
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/add', [CategoryController::class, 'create'])->name('categoryAdd');
        Route::post('/add', [CategoryController::class, 'store'])->name('categoryCreate');
        Route::get('/update/{id}', [CategoryController::class, 'edit'])->name('categoryEdit');
        Route::put('/update/{id}', [CategoryController::class, 'Update'])->name('categoryUpdate');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('categoryDelete');
    });

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/add', [AdminController::class, 'create'])->name('adminAdd');
        Route::post('/add', [AdminController::class, 'store'])->name('adminCreate');
        Route::get('/update/{id}', [AdminController::class, 'edit'])->name('adminEdit');
        Route::put('/update/{id}', [AdminController::class, 'Update'])->name('adminUpdate');
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('adminDelete');
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [AdminController::class, 'profile'])->name('profile');
        Route::put('/update', [AdminController::class, 'profileUpdate'])->name('profileUpdate');
    });

    // Users Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/update/{id}', [UserController::class, 'edit'])->name('userEdit');
        Route::put('/update/{id}', [UserController::class, 'Update'])->name('userUpdate');
    });

    // Videos Routes
    Route::prefix('videos')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('videos');
        Route::get('/add', [VideoController::class, 'create'])->name('videoAdd');
        Route::post('/add', [VideoController::class, 'store'])->name('videoCreate');
        Route::get('/update/{id}', [VideoController::class, 'edit'])->name('videoEdit');
        Route::put('/update/{id}', [VideoController::class, 'Update'])->name('videoUpdate');
        Route::get('/delete/{id}', [VideoController::class, 'destroy'])->name('videoDelete');
    });

    // Chart Routes
    Route::prefix('charts')->group(function () {
        Route::get('/videos', [ChartController::class, 'videoChart'])->name('videoChart');
        Route::get('/users', [ChartController::class, 'userChart'])->name('userChart');
        Route::get('/likes', [ChartController::class, 'likesChart'])->name('likesChart');
        Route::get('/categories', [ChartController::class, 'categoriesChart'])->name('categoriesChart');
    });
});
