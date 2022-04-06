<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $usuarios = Rol::all();

        return $usuarios;
    }

    public function show($id)
    {
        try {
            $usuario = Rol::where('id', $id)->get()->first();

            if ($usuario->count() > 0) {

                return response()->json([
                    'id' => $usuario->id,
                    'nombre' =>  $usuario->nombre,
                    'estatus' =>  $usuario->estatus,
                    'status' => true
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'rol no encontrado'
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $rol = new Rol();
            $rol->nombre = $request->nombre;
            $rol->estatus = $request->estatus;
            $rol->save();

            return response()->json([
                'id' => $rol->id,
                'nombre' =>  $rol->nombre,
                'estatus' =>  $rol->estatus,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al agregar'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rol = Rol::where('id', $id)->get()->first();
            if ($rol->count() > 0) {

                $rol->nombre = $request->nombre;
                $rol->estatus = $request->estatus;

                return response()->json([
                    'id' => $rol->id,
                    'nombre' =>  $rol->nombre,
                    'estatus' =>  $rol->estatus,
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
}
