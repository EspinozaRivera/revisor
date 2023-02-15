<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use Illuminate\Http\Request;

class validadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Validador.index')->only('index');
        $this->middleware('can:Validador.update')->only('update');
    }

    public function update($id, Request $request)
    {
        $me = auth()->user();
        //echo $me->{'email'};
        try {
            $aprovacion = Revision::where('id', $id)->get()->first();
            if ($aprovacion->revisor1 == $me->{'email'}) {
                echo 'r1';
                $aprovacion->r1 = $request->aprobacion;
                $aprovacion->save();
                if ($request->aprobacion) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento aprovado'
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento rechazado'
                    ]);
                }
            } elseif ($aprovacion->revisor2 == $me->{'email'}) {
                echo 'r2';
                $aprovacion->r2 = $request->aprobacion;
                $aprovacion->save();
                if ($request->aprobacion) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento aprovado'
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento rechazado'
                    ]);
                }
            } elseif ($aprovacion->revisor3 == $me->{'email'}) {
                echo 'r3';
                $aprovacion->r3 = $request->aprobacion;
                $aprovacion->save();
                if ($request->aprobacion) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento aprovado'
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'Documento rechazado'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No eres Validador en este documento'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error al actualizar el status del documento'
            ]);
        }
    }

    public function index()
    {
        $me = auth()->user();
        $correo = $me->{'email'};
        $revisiones = Revision::select('*')
            ->orWhere('revisor1', '=', $correo)
            ->orWhere('revisor2', '=', $correo)
            ->orWhere('revisor3', '=',  $correo)->get();

        return $revisiones;
    }
}
