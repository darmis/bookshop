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

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::resource('user', UsersController::class);
        Route::get('/books/toapprove', [BooksController::class, 'toapprove'])->name('toapprove');
        Route::post('/book/{book}/approve', [BooksController::class, 'approve'])->name('approve');
    });
    Route::resource('book', BooksController::class);
    Route::get('/books/mybooks', [BooksController::class, 'mybooks'])->name('mybooks');
    Route::get('/book/{book}/report', [BooksController::class, 'report'])->name('report');
    Route::post('/rate', [RatesController::class, 'store'])->name('rate.store');
});

Route::get('/search', [BooksController::class, 'search'])->name('search');

require __DIR__.'/auth.php';
