<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminPanel;
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
    Route::get('/admin', [AdminPanel::class, 'showAdminPanel'])->middleware('auth')->name('admin');
    Route::post('/admin', [AdminPanel::class, 'addNewsUrl'])->name('handlerPanel');
    Route::post('/deleteNewsUrl', [AdminPanel::class, 'deleteNewsUrl'])->name('deleteNewsUrl');
    Route::patch('/activeNewsUrl', [AdminPanel::class, 'changeStatusOfSource'])->name('changeStatusOfSource');
    Route::post('/logout',[AdminPanel::class, 'logout'])->name('logout');

    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect(\route('admin.admin'));
        } else {
            return view('page/login');
        }
    })->name('login');
    Route::post('/login',[LoginController::class, 'login']);

    Route::get('/registration', function () {
        if (Auth::check()) {
            return redirect(\route('admin.admin'));
        } else {
            return view('page/registration');
        }
    })->name('registration');
    Route::post('registration', [LoginController::class, 'registration']);

});

