<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\ArticleCategoryController;

// sleep(1);
//Home
Route::get('/', [UserHomeController::class, 'index'])->name('home');


//Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login/user', 'login')->name('auth.login');
    Route::post('/logout', 'logout')->name('logout');
});


//User Middleware
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function() {
    Route::controller(UserDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
});


//Admin Middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    //Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });
    
    //Users
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    //Article
    Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    //Article Category
    Route::controller(ArticleCategoryController::class)->prefix('articles/categories')->name('article_categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store','store')->name('store');
        Route::put('/update/{id}','update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

   


});