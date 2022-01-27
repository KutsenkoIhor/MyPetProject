<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArticleController::class, 'showArticles'])
    ->name('articles.showArticles');

Route::name('admin.')->group(function () {
//    Route::view('/admin', 'page/settings')->middleware('auth')->name('admin');
    Route::get('/admin', [AdminController::class, 'settings'])->middleware('auth')->name('admin');


    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(\route('admin.admin'));
        } else {
            return view('page/login');
        }
    })->name('login');

    Route::post('/login',[AdminController::class, 'login']);


    Route::post('/logout',[AdminController::class, 'logout'])->name('logout');


    Route::get('/registration', function () {
        if (Auth::check()) {
            return redirect(\route('admin.admin'));
        } else {
            return view('page/registration');
        }
    })->name('registration');

    Route::post('registration', [AdminController::class, 'registration']);

});

