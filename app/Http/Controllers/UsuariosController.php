<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{

    public function index()
    {
        // $correo = "vhamill@example.org";
        // $contra = "vpALX";
        $usuarios = Usuario::all(); //proximo a cambios
        return $usuarios;
    }

    public function show($idUsuario)
    {
        $usuario = Usuario::where('idUsuario', $idUsuario)->first();
        return $usuario;
    }

    public function store(Request $request){        
        $usuario = new Usuario();

        $usuario->curp = $request->curp;
        $usuario->nombre = $request->nombre;
        $usuario->apellido1 = $request->apellido1;
        $usuario->apellido2 = $request->apellido2;
        $usuario->correo = $request->correo;
        $usuario->contra = $request->contra;
        $usuario->status = $request->status;

        $usuario->save();

        $usuarios = Usuario::all();
        return $usuarios;
    }

    public function edit($idUsuarios){
        $usuario = Usuario::where('idUsuario', $idUsuarios)->first();
        return $usuario;
    }
}
