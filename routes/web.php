<?php

use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\PropertyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('dashboardOwnerAuth')->group(function () {
    Route::prefix('property')->group(function () {
        Route::get('/', [PropertyController::class, 'index'])->name('property-dashboard.index');
        Route::post('store', [PropertyController::class, 'store'])->name('property-dashboard.store');
        Route::get('destroy/{propertyId}', [PropertyController::class, 'destroy'])->name('property-dashboard.destroy');
        Route::post('update', [PropertyController::class, 'update'])->name('property-dashboard.update');
    });
});
