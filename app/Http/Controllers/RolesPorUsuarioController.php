<?php

namespace App\Http\Controllers;

use App\Models\RolPorUsuario;
use Illuminate\Http\Request;

class RolesPorUsuarioController extends Controller
{
    public function show($id)
    {
        try {
            $RolPUsr = RolPorUsuario::select('rolesPorUsuario.id', 'roles.id as idRol', 'roles.nombre')
                ->join('roles', 'rolesPorUsuario.idRol', '=', 'roles.id')
                ->where('rolesPorUsuario.idUsuario', $id)
                ->get();

            if ($RolPUsr->count() <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'rol no encontrado'
                ]);
            }
            return $RolPUsr;
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
            $rolPUsr = new RolPorUsuario();
            $rolPUsr->idUsuario = $request->idUsuario;
            $rolPUsr->idRol = $request->idRol;
            $rolPUsr->save();

            return response()->json([
                'status' => true,
                'message' => 'Rol asignado',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al agregar'
            ]);
        }
    }

    public function destroy(RolPorUsuario $rolPUsr)
    {
        try {
            $rolPUsr->delete();
            return response()->json([
                'status' => true,
                'message' => 'rol del usuario borrado'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al borrar rol del usuario'
            ]);
        }
    }
}
