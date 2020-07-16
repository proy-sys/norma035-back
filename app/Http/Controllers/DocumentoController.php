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
        try {
           $documentos = documento::
           select('documentos.id',
                  'documentos.nombre',
                  'documentos.tipo',
                  'documentos.fecha',
                  'documentos.responsable_id',
                  'documentos.trabajadores',
                  'documentos.status',
                  'trabajador.nombre as trabajador')
          ->leftJoin('trabajador', 'trabajador.id', '=', 'documentos.responsable_id')
          ->where('trabajador.empresa_id',1)
          ->where('documentos.status',true)
          ->orderBy('documentos.id','desc')
          ->get();

          return response()->json($documentos,Response::HTTP_OK);

         }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }

    public function listadoSugerencia_Queja()
    {
        try{

          $lista = sugerencia_queja::
                    select('sugerencia_queja.id',
                           'sugerencia_queja.descripcion',
                           'sugerencia_queja.status',
                           'sugerencia_queja.trabajador_id',
                           'sugerencia_queja.tipo',
                           'trabajador.nombre')
                   ->leftJoin('trabajador', 'trabajador.id', '=', 'sugerencia_queja.trabajador_id')
                   ->where('trabajador.empresa_id',1)   /*prueba para empresa 1*/
                   ->orderBy('sugerencia_queja.id','ASC')
                   ->get();    /*reducir consulta en modelo*/

          return response()->json($lista,Response::HTTP_OK);

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


    public function destroy($id){

        try{

            $documento = documento::find($id);
            $documento->status = false;
            $documento->save();

           return response()->json(Response::HTTP_OK);

         }catch (Exception $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }
  /*  public function destroy($id)
    {
        try{

            $documento = documento::find($id);
            $documento->delete();
            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }*/
}
