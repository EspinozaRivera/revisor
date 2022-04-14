<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuloPorRolController;
use App\Http\Controllers\modulosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\PermisosPorRolController;
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

    //Necesita token
    Route::group(['prefix' => 'admin', 'middleware' => ['jwt.verify']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

        //usuarios
        Route::get('/usuarios', [userController::class, 'index']);
        Route::get('/usuarios/{id}', [userController::class, 'show']);
        Route::put('/usuarios/editar/{usuario}', [userController::class, 'update']);//los usuarios se pueden "eliminar"(cambiar estatus a false) desde update

        //roles
        Route::get('/roles', [RolController::class, 'index']);
        Route::get('/roles/{id}', [RolController::class, 'show']);
        Route::post('/roles/agregar', [RolController::class, 'store']);
        Route::put('/roles/editar/{id}', [RolController::class, 'update']);
        Route::delete('/roles/eliminar/{rol}', [RolController::class, 'destroy']);

        //permisos
        Route::get('/permisos', [PermisosController::class, 'index']);
        Route::get('/permisos/{id}', [PermisosController::class, 'show']);

        // //roles por usuario
        Route::get('/rolesPorUsuario/{id}', [RolesPorUsuarioController::class, 'show']);
        //Route::post('/rolesPorUsuario/agregar', [RolesPorUsuarioController::class, 'store']);//Para agregar roles a un usuario se hace desde el Editar usuario
        //Route::delete('/rolesPorUsuario/{rolPUsr}', [RolesPorUsuarioController::class, 'destroy']);

        //permisos por rol
        Route::get('/permisosPorRol/{id}', [PermisosPorRolController::class, 'show']);
    });
});
