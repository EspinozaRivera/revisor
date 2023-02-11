<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revision;
use Illuminate\Support\Facades\Storage;

class RevisionCotroller extends Controller
{
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
                    'documento' => $revisiones->documento,
                    'revisor1' => $revisiones->revisor1,
                    'revisor3' => $revisiones->revisor2,
                    'revisor2' => $revisiones->revisor3,
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
            $revision->documento = $request->documento;
            $revision->revisor1 = $request->revisor1;
            $revision->revisor2 = $request->revisor2;
            $revision->revisor3 = $request->revisor3;
            $revision->estatus =  $request->estatus;

            $asd = uploadFileFromBlobString($revision->documento, "file.pdf", 'c:/');

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

    public function uploadFileFromBlobString($base64string = '', $file_name = '', $folder = '')
    {
        $file_path = "";
        $result = 0;

        // Convert blob (base64 string) back to PDF
        if (!empty($base64string)) {

            // Detects if there is base64 encoding header in the string.
            // If so, it needs to be removed prior to saving the content to a phisical file.
            if (strpos($base64string, ',') !== false) {
                @list($encode, $base64string) = explode(',', $base64string);
            }

            $base64data = base64_decode($base64string, true);
            $file_path  = "{$folder}/{$file_name}";

            // Return the number of bytes saved, or false on failure
            $result = file_put_contents("{$this->_assets_path}/{$file_path}", $base64data);
        }

        return $result;
    }
}
