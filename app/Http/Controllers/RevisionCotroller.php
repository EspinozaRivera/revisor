<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revision;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Element;

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

            $revision->titulo = $request->titulo;
            $revision->nombreDoc = $request->nombreDoc;
            $revision->documento = $request->documento;
            $revision->revisor1 = $request->revisor1;
            $revision->revisor2 = $request->revisor2;
            $revision->revisor3 = $request->revisor3;
            $revision->estatus =  $request->estatus;

            //$filename = ($revision->nombreDoc);
            //file_put_contents($filename, base64_decode($revision->documento));

            $revision->save();
            return response()->json([
                'message' => '¡Revision en espera de aprobacion!',
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
