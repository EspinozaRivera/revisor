<?php

namespace App\Http\Controllers;

use App\Models\RolPorUsuario;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:User.index')->only('index');
        $this->middleware('can:User.show')->only('show');
        $this->middleware('can:User.update')->only('update');
    }

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

            $RolPUsr = RolPorUsuario::select('model_has_roles.role_id', 'roles.name')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $id)
            ->get();

            if ($usuario->count() > 0) {

                return response()->json([
                    'id' => $usuario->id,
                    'nombre' =>  $usuario->nombre,
                    'apellido1' =>  $usuario->apellido1,
                    'apellido2' =>  $usuario->apellido2,
                    'email' =>  $usuario->email,
                    'roles' => $RolPUsr,
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

    //se cambia el statsu del usuario en vez de eliminarlo
    public function update(Request $request, User $usuario)
    {
        $usuario = User::where('id', $usuario->id)->get()->first();

        try {
            if ($usuario->count() > 0) {
                $usuario->nombre = $request->nombre;
                $usuario->apellido1 = $request->apellido1;
                $usuario->apellido2 = $request->apellido2;
                $usuario->email = $request->email;
                //$usuario->password = $request->password;
                $usuario->estatus = $request->estatus;
                $usuario->save();

                try {
                    $usuario->roles()->sync($request->roles);
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Error al asignar rol(es)'
                    ]);
                }

                return response()->json([
                    // 'id' => $usuario->id,
                    // 'nombre' => $usuario->nombre,
                    // 'apellido1' => $usuario->apellido1,
                    // 'apellido2' => $usuario->apellido2,
                    // 'email' => $usuario->email,
                    // 'estatus' => $usuario->estatus,
                    'status' => true,
                    'message' => 'Usuario editado con exito'
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
