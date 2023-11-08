<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\CalendarController;
use App\Http\Controllers\Client\CommitmentController;
use App\Http\Controllers\Client\EventController;
use App\Http\Controllers\Client\EventImageController;
use App\Http\Controllers\Client\ImageController;
use App\Http\Controllers\Client\MyProposalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\TaskController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ProposalController;
use App\Http\Controllers\Client\ProposalExpenseController;
use App\Http\Controllers\Client\Reports\ReportExpenseController;
use App\Http\Controllers\Client\Reports\ReportProposalController;
use App\Http\Controllers\Client\Reports\ReportTaskController;

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
// Route::get('/reminder', [App\Http\Controllers\HomeController::class, 'template'])->name('template');

Route::prefix('client')->middleware(['auth:web'])->group(function () {
    Route::get('proposals/{id}/photo/remove', [ProposalController::class, 'photoRemove']);
    Route::resource('proposals', ProposalController::class);
    Route::resource('users', UserController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('expenses', ProposalExpenseController::class);
    Route::resource('account', AccountController::class);
    Route::resource('image', ImageController::class);
    Route::resource('events', EventController::class);
    Route::resource('event-image', EventImageController::class);
    Route::resource('events-calendar', CalendarController::class);
    Route::resource('myproposals', MyProposalController::class);
    Route::resource('commitment', CommitmentController::class);

    Route::prefix('reports')->group(function () {
        Route::resource('proposal', ReportProposalController::class);
        Route::resource('tasks', ReportTaskController::class);
        Route::resource('finance', ReportExpenseController::class);
    });
});