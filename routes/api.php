<?php

use App\Http\Controllers\AskAvailibilityController;
use App\Http\Controllers\ListPropertyController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('show-profile', [UserController::class, 'showProfile'])->middleware('userMiddleware');
});

Route::prefix('owner')->group(function () {
    Route::post('register', [OwnerController::class, 'register']);
    Route::post('login', [OwnerController::class, 'login']);
    Route::get('show-profile', [OwnerController::class, 'showProfile'])->middleware('ownerMiddleware');
});

Route::resource('property', PropertyController::class);
Route::get('list-property', ListPropertyController::class);
Route::post('ask-availibility', AskAvailibilityController::class)->middleware('userMiddleware');
