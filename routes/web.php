<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\TaskController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ProposalController;
use App\Http\Controllers\Client\ProposalExpenseController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('client')->middleware(['auth:web'])->group(function () {
    Route::get('proposals/{id}/photo/remove', [ProposalController::class, 'photoRemove']);
    Route::resource('proposals', ProposalController::class);
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('expenses', ProposalExpenseController::class);
});