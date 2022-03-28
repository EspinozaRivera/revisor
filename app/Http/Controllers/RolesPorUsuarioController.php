<?php

namespace App\Http\Controllers;

use App\Models\RolPorUsuario;

class RolesPorUsuarioController extends Controller
{
    public function index(){
        
        $usuarios = RolPorUsuario::all();

        return $usuarios;
    }

    public function show($id){
        $usuario = RolPorUsuario::where('id',$id)->get()->first();

        return $usuario;
    }
}
