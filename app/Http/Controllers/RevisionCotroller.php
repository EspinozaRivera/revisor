<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revision;
use App\Mail\CorreoValidadorMailable;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;

class RevisionCotroller extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Revision.index')->only('index');
        $this->middleware('can:Revision.show')->only('show');
        $this->middleware('can:Revision.store')->only('store');
    }

    public function index()
    {
        try {
            $revisiones = Revision::all();

            return $revisiones;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Listado de revisiones vacio'
            ]);
        }
    }


    public function show($id)
    {
        try {
            $revisiones = Revision::where('id', $id)->get()->first();

            if ($revisiones->count() > 0) {

                return response()->json([
                    'id' => $revisiones->id,
                    'nombre' =>  $revisiones->titulo,
                    'nombreDoc' => $revisiones->nombreDoc,
                    'documento' => $revisiones->documento,
                    'revisor1' => $revisiones->revisor1,
                    'r1' => $revisiones->r1,
                    'revisor2' => $revisiones->revisor2,
                    'r2' => $revisiones->r2,
                    'revisor3' => $revisiones->revisor3,
                    'r3' => $revisiones->r3,
                    'estatus' => $revisiones->estatus,
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Listado Vacio'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'id de solicitud no encontrado'
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $revision = new Revision();

            if ($request->revisor1 == null || $request->revisor2 == null || $request->revisor3 == null) {
                return response()->json([
                    'message' => 'Error. Es necesario agregar a todos los revisores',
                    'status' => false
                ], 201);
            }

            if ($request->titulo == null || $request->titulo == "") {
                return response()->json([
                    'message' => 'Error. Es necesario agregar un titulo',
                    'status' => false
                ], 201);
            }

            if ($request->nombreDoc == null || $request->nombreDoc == "") {
                return response()->json([
                    'message' => 'Error. Es necesario agregar el nombre del documento',
                    'status' => false
                ], 201);
            }

            if ($request->documento == null || $request->documento == "") {
                return response()->json([
                    'message' => 'Error. Es necesario agregar el nombre del documento',
                    'status' => false
                ], 201);
            }

            if ($request->revisor1 == $request->revisor2 || $request->revisor1 == $request->revisor3 || $request->revisor2 == $request->revisor3) {
                return response()->json([
                    'message' => 'Error. No se pueden asignar mas el mismo revisor',
                    'status' => false
                ], 201);
            }
            $revision->titulo = $request->titulo;
            $revision->nombreDoc = $request->nombreDoc;
            $revision->documento = $request->documento;
            $revision->revisor1 = $request->revisor1;
            $revision->revisor2 = $request->revisor2;
            $revision->revisor3 = $request->revisor3;
            $revision->estatus = true;
            $revision->save();
            //$filename = ($revision->nombreDoc);
            //file_put_contents($filename, base64_decode($revision->documento));

            $correo = new CorreoValidadorMailable($revision);

            try {
                Mail::to($revision->revisor1)->send($correo);
                $respR1 = "Se envio el correo a $revision->revisor1";
            } catch (\Throwable $th) {
                $respR1 = "error al enviar el correo a $revision->revisor1";
                error_log($respR1);
            }

            try {
                Mail::to($revision->revisor2)->send($correo);
                $respR2 = "Se envio el correo a $revision->revisor2";
            } catch (\Throwable $th) {
                $respR2 = "error al enviar el correo a $revision->revisor2";
                error_log($respR2);
            }

            try {
                Mail::to($revision->revisor3)->send($correo);
                $respR3 = "Se envio el correo a $revision->revisor3";
            } catch (\Throwable $th) {
                $respR3 = "error al enviar el correo a $revision->revisor3";
                error_log($respR3);
            }

            return response()->json([
                'message' => '¡Revision en espera de aprobacion!',
                'revisor1' => $respR1,
                'revisor2' => $respR2,
                'revisor3' => $respR3,
                'status' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error al guardar crear la revision'
            ]);
        }
    }
}
