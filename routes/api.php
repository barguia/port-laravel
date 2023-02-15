<?php

use App\Http\Controllers\Access\AclProfileController;
use App\Http\Controllers\Access\AuthController;
use App\Http\Controllers\Access\UserController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [UserController::class, 'store'])->name('api.register');

Route::name('manager.')->prefix('adm/')->middleware(['auth:api'])->group(function () {
    Route::resource('/profiles', AclProfileController::class);
});


Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::resource('/users', UserController::class);
});

