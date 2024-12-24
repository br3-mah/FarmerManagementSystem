<?php

use App\Http\Controllers\PackageController;
use App\Livewire\Core\FarmerComponent;
use App\Livewire\Settings\PackageComponent;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    // Controllers
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Livewire Components

    Route::get('farmers', FarmerComponent::class)->name('farmers');
    Route::get('packages', PackageComponent::class)->name('packages');
    Route::post('packages', [PackageController::class, 'uplodadModulePackage'])->name('upload-module');

});
