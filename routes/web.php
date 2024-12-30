<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Livewire\Core\FarmerComponent;
use App\Livewire\Core\FarmerEditComponent;
use App\Livewire\Core\FarmerViewComponent;
use App\Livewire\Core\ProspectComponent;
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

// Redirect any root URL access to the login page if not logged in
Route::get('/', function () {
    return redirect()->route('login');
});

// Login route
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Middleware to protect authenticated routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Controllers
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Livewire Components
    Route::get('prospects', ProspectComponent::class)->name('prospects');
    Route::get('farmers', FarmerComponent::class)->name('farmers');
    Route::get('view-farmer', FarmerViewComponent::class)->name('vfarmers');
    Route::get('edit-farmer', FarmerEditComponent::class)->name('efarmers');
    Route::get('settings', PackageComponent::class)->name('settings');
    Route::get('packages', PackageComponent::class)->name('packages');
    Route::post('packages', [PackageController::class, 'uploadModulePackage'])->name('upload-module');
});
