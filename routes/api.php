<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Models\User;
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

Route::get('users', function () {
    return User::with('roles')->get();
})->name('postman.get.users');

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
    Route::post('me', [AuthController::class, 'me'])->name('auth.me');
});

Route::middleware('auth:api')->prefix('role')->group(function () {
    Route::post('attach/{user}', [RoleController::class, 'attachRole'])->name('role.attach');
    Route::post('detach/{user}', [RoleController::class, 'detachRole'])->name('role.detach');
});
