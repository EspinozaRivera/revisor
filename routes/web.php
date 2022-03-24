<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\UsuariosController;
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

Route::middleware(['cors'])->group(function () {
    Route::get('login', [loginController::class, 'show']); //proximo a cambios

    Route::get('usuarios', [UsuariosController::class, 'index']);

    Route::post('usuarios/agregar', [UsuariosController::class, 'store']);

    Route::get('usuarios/{idUsuario}', [UsuariosController::class, 'show']);

    Route::get('usuarios/{idUsuario}/edit', [UsuariosController::class, 'edit']);
});

