<?php

use Illuminate\Support\Facades\Route;
use Modules\LoanManagement\App\Http\Controllers\DashboardController;
use Modules\LoanManagement\App\Http\Controllers\LoanManagementController;

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
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('borrowers', LoanManagementController::class)->names('borrowers');

Route::group([], function () {
    // Route::resource('loanmanagement', LoanManagementController::class)->names('loanmanagement');
    Route::prefix('loanmanagement')->group(function () {
        Route::get('/', [LoanManagementController::class, 'index'])->name('loanmanagement.index');
        Route::get('/list', [LoanManagementController::class, 'list'])->name('loanmanagement.list');
        Route::get('/details', [LoanManagementController::class, 'show'])->name('loanmanagement.show');
        Route::get('/edit', [LoanManagementController::class, 'edit'])->name('loanmanagement.edit');
        Route::get('/create', [LoanManagementController::class, 'create'])->name('loanmanagement.create');
        Route::post('/store', [LoanManagementController::class, 'store'])->name('loanmanagement.store');
        Route::get('/history/{farmerId}', [LoanManagementController::class, 'history'])->name('loanmanagement.history');
        Route::post('/{id}/status', [LoanManagementController::class, 'updateStatus'])->name('loanmanagement.updateStatus');
        Route::post('/{id}/repaid', [LoanManagementController::class, 'markRepaid'])->name('loanmanagement.markRepaid');
    });
});
