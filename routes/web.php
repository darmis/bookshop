<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\RatesController;

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

Route::get('/', [BooksController::class, 'index']);

Route::get('/home', [BooksController::class, 'index'])->name('home');

Route::resource('user', UsersController::class)->middleware(['auth', 'admin']);

Route::resource('book', BooksController::class)->middleware(['auth']);

Route::post('/rate', [RatesController::class, 'store'])->middleware(['auth'])->name('rate.store');

require __DIR__.'/auth.php';
