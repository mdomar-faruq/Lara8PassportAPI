<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/user', [App\Http\Controllers\ServicingController::class, 'UserData'])->name('UserData');
Route::post('/Register', [App\Http\Controllers\ServicingController::class, 'Register'])->name('Register');
Route::post('/login', [App\Http\Controllers\ServicingController::class, 'login'])->name('login');
// Route::get('test', [App\Http\Controllers\ServicingController::class, 'test']);

Route::middleware('auth:api')->group( function () {
    Route::get('test', [App\Http\Controllers\ServicingController::class, 'test']);
});