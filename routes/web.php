<?php

use App\Http\Controllers\FriendsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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

# Journal entry routes
Route::get('/journals/{id}/entry', [JournalEntryController::class, 'index'])->name('journal.entry');
Route::post('/journals/{id}/entry', [JournalEntryController::class, 'store']);
Route::get('/journals/{journal_id}/{entry_id}/edit', [JournalEntryController::class, 'edit'])->name('journal.entry.edit');
Route::post('/journals/{journal_id}/{entry_id}/edit', [JournalEntryController::class, 'update']);
Route::get('/journals/entry/{entry_id}/delete', [JournalEntryController::class, 'delete'])->name('journal.entry.delete');
# User routes
Route::get('/users/{id}', [UserController::class, 'index'])->name('users');

# Search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');

# Friends routes
Route::get('/friends', [FriendsController::class, 'index'])->name('friends');

Auth::routes();

