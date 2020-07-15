<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\documento;
use App\Http\Independientes\Imagen;
use Symfony\Component\HttpFoundation\Response;

class DocumentoController extends Controller
{
    function __construct(){

        $this->imagen = new imagen();
    }

    public function index()
    {
        try{

            $documentos = documento::orderBy('id', 'desc')->get();

            return response()->json($documentos,Response::HTTP_OK);

         }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }

    public function store(Request $request)
    {
        try{

            documento::create($request->all());

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }

    public function getNumeroDocumentos(){
        try{
             $num_documentos = documento::count();
             return response()->json($num_documentos,Response::HTTP_OK);

        }catch(Excepcion $ex){

            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


    public function show($id)
    {
           try{

            $documento = documento::find($id);
            $documento->imagen1 = $this->imagen->ValidarImagen($documento->imagen1);
            $documento->imagen2 = $this->imagen->ValidarImagen($documento->imagen2);

            return response()->json($documento,Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


    public function update(Request $request, $id)
    {
        try{

             $documento = documento::find($id);
             $documento->fill($request->all());
             $documento->save();

            return response()->json($documento,Response::HTTP_OK);

          }catch (Exception $ex){
              return response()
              ->json([
                        'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
              ], 400);
          }
    }


    public function destroy($id)
    {
        try{

            $documento = documento::find($id);
            $documento->delete();
            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }
}
