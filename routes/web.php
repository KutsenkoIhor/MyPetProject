<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
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

Route::get('/admin', [AuthController::class, 'pageAuth'])
    ->name('authorization.pageAuth');

Route::post('/admin/submit', [AuthController::class, 'login'])
    ->name('authorization.login');


