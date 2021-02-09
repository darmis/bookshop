<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BooksController;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [BooksController::class, 'index'])->name('home');

Route::resource('user', UsersController::class)->middleware(['auth']);
Route::resource('book', BooksController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
