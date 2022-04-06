<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuloPorRolController;
use App\Http\Controllers\modulosController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolesPorUsuarioController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

//No nececit tokesn
Route::middleware(['cors'])->group(function () {
    Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/usuarios/agregar', [AuthController::class, 'register']);
    });
});


//Necesita token
Route::group(['prefix' => 'admin', 'middleware' => ['jwt.verify']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    //usuarios
    Route::get('/usuarios', [userController::class, 'index']);
    Route::get('/usuarios/{id}', [userController::class, 'show']);
    Route::put('/usuarios/{id}/editar', [userController::class, 'update']);

    //roles
    Route::get('/roles', [RolController::class, 'index']);
    Route::get('/roles/{id}', [RolController::class, 'show']);
    Route::post('/roles/agregar', [RolController::class, 'store']);
    Route::put('/roles/{id}/editar', [RolController::class, 'update']);

    //roles por usuario
    Route::get('/rolesPorUsuario/{id}', [RolesPorUsuarioController::class, 'show']);
    Route::post('/rolesPorUsuario/agregar', [RolesPorUsuarioController::class, 'store']);
    Route::delete('/rolesPorUsuario/{rolPUsr}', [RolesPorUsuarioController::class, 'destroy']);

    //modulos
    Route::get('/modulos', [modulosController::class, 'index']);

    //modulos por rol
    Route::get('/modulosPorRol/{id}', [ModuloPorRolController::class, 'show']);    
    Route::post('/modulosPorRol/agregar', [ModuloPorRolController::class, 'store']);
    Route::delete('/modulosPorRol/{modPorRol}', [ModuloPorRolController::class, 'destroy']);
});
