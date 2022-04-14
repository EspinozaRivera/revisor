<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisosController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Permission.index')->only('index');
        $this->middleware('can:Permission.show')->only('show');
    }

    public function index()
    {
        $permisos = Permiso::all();

        return $permisos;
    }

    public function show($id)
    {
        try {
            $permiso = Permiso::where('id', $id)->get()->first();

            if ($permiso->count() > 0) {

                return response()->json([
                    'id' => $permiso->id,
                    'nombre' =>  $permiso->name,
                    'status' => true
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Permiso no encontrado'
            ]);
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $permiso = Role::create(['name' => $request->name]);

    //         return response()->json([
    //             'id' => $permiso->id,
    //             'nombre' =>  $permiso->name,
    //             'status' => true
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'error al agregar el permiso'
    //         ]);
    //     }
    // }
}
