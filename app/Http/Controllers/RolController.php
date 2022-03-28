<?php

namespace App\Http\Controllers;

use App\Models\Rol;

class RolController extends Controller
{
    public function index(){
        
        $usuarios = Rol::all();

        return $usuarios;
    }

    public function show($id){
        $usuario = Rol::where('id',$id)->get()->first();

        return $usuario;
    }
}
