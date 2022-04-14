<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Role.index')->only('index');
        $this->middleware('can:Role.show')->only('show');
        $this->middleware('can:Role.store')->only('store');
        $this->middleware('can:Role.update')->only('update');
        $this->middleware('can:Role.destroy')->only('destroy');
    }

    public function index()
    {
        $usuarios = Rol::all();

        return $usuarios;
    }

    public function show($id)
    {
        try {
            $roles = Rol::where('id', $id)->get()->first();

            if ($roles->count() > 0) {

                return response()->json([
                    'id' => $roles->id,
                    'nombre' =>  $roles->name,
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
            // $rol = new Rol();
            // $rol->nombre = $request->nombre;
            // $rol->estatus = $request->estatus;
            // $rol->save();

            $role = Role::create(['name' => $request->name]);

            return response()->json([
                'id' => $role->id,
                'nombre' =>  $role->name,
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

                $rol->name = $request->name;
                $rol->save();

                return response()->json([
                    'id' => $rol->id,
                    'nombre' =>  $rol->name,
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

    public function destroy(Rol $rol)
    {
        try {
            $rol->delete();
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
