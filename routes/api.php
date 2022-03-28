<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\userController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//No nececit tokesn
Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
});

//Necesita token
Route::group(['prefix' => 'admin', 'middleware' => ['jwt.verify']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);        
    Route::get('/usuarios', [userController::class, 'index']);
    Route::get('/usuarios/{id}', [userController::class, 'show']);
});
