<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    //revisar si solo los usuarios con status true se muestran
    public function index()
    {
        $usuarios = User::all();

        return $usuarios;
    }

    public function show($id)
    {
        try {
            $usuario = User::where('id', $id)->get()->first();

            if ($usuario->count() > 0) {

                return response()->json([
                    'id' => $usuario->id,
                    'curp' =>  $usuario->curp,
                    'nombre' =>  $usuario->nombre,
                    'apellido1' =>  $usuario->apellido1,
                    'apellido2' =>  $usuario->apellido2,
                    'email' =>  $usuario->email,
                    'estatus' =>  $usuario->estatus,
                    'status' => true
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $usuario = User::where('id', $id)->get()->first();

        try {
            if ($usuario->count() > 0) {
                $usuario->curp = $request->curp;
                $usuario->nombre = $request->nombre;
                $usuario->apellido1 = $request->apellido1;
                $usuario->apellido2 = $request->apellido2;
                $usuario->email = $request->email;
                $usuario->password = $request->password;
                $usuario->estatus = $request->estatus;
                $usuario->save();

                return response()->json([
                    'id' => $usuario->id,
                    'curp' => $usuario->curp,
                    'nombre' => $usuario->nombre,
                    'apellido1' => $usuario->apellido1,
                    'apellido2' => $usuario->apellido2,
                    'email' => $usuario->email,
                    'password' => $usuario->password,
                    'estatus' => $usuario->estatus,
                    'status' => true
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Rol no encontrado'
            ]);
        }
    }
}
