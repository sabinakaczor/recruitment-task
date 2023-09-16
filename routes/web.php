<?php

use App\Http\Controllers\Web\CreateFormEntryController;
use App\Http\Controllers\Web\ListFormEntriesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/form-entries')
->name('formEntries.')
->group(function () {
    Route::get('/create', CreateFormEntryController::class)->name('create');
    Route::get('/list', ListFormEntriesController::class)->name('list')->middleware('auth');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
