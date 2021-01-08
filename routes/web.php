<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/me', [ProfileController::class, 'index'])->name('profile');
Route::post('/me', [ProfileController::class, 'update']);

# Journal routes
Route::get('/journals', [JournalController::class, 'index'])->name('journals');
Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
Route::post('/journals/create', [JournalController::class, 'store']);
Route::get('/journals/{id}', [JournalController::class, 'detail'])->name('journals.detail');

# User routes
Route::get('/users/{id}', [UserController::class, 'index'])->name('users');

Auth::routes();

