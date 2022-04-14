<?php

namespace App\Http\Controllers;

use App\Models\PermisoPorRol;
use Illuminate\Http\Request;

class PermisosPorRolController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:PermisoPorRol.show')->only('show');
    }

    public function show($id)
    {
        try {
            $RolPUsr = PermisoPorRol::select('permissions.id', 'permissions.name')
                ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('role_has_permissions.role_id', $id)
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
}
