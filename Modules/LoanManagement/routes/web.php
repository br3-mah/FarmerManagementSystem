<?php

use Illuminate\Support\Facades\Route;
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

Route::group([], function () {
    Route::resource('loanmanagement', LoanManagementController::class)->names('loanmanagement');
    Route::resource('borrowers', LoanManagementController::class)->names('borrowers');
});
