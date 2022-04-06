<?php

namespace App\Http\Controllers;

use App\Models\ModuloPorRol;
use Illuminate\Http\Request;

class ModuloPorRolController extends Controller
{
    public function show($id)
    {
        try {
            $modPorRol = ModuloPorRol::select('modulosPorRol.id', 'modulos.id as idModulo', 'modulos.nombre')
                ->join('modulos', 'modulosPorRol.idModulo', '=', 'modulos.id')
                ->where('modulosPorRol.idRol', $id)
                ->get();

            if ($modPorRol->count() <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'rol no encontrado'
                ]);
            }
            return $modPorRol;
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
            $modPorRol = new ModuloPorRol();
            $modPorRol->idRol = $request->idRol;
            $modPorRol->idModulo = $request->idModulo;
            $modPorRol->save();

            return response()->json([
                'status' => true,
                'message' => 'modulo asignado al rol',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al asignar el modulo al rol'
            ]);
        }
    }

    public function destroy(ModuloPorRol $modPorRol)
    {
        try {
            $modPorRol->delete();
            return response()->json([
                'status' => true,
                'message' => 'modulo del rol borrado'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'error al borrar modulo del rol'
            ]);
        }
    }
}
