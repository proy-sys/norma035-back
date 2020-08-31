<?php

namespace App\Http\Controllers;
use App\Http\Models\sugerencia_queja;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SugerenciaQuejaController extends Controller
{

    public function listadoSugerencia_Queja()
    {
        try{

          $lista = sugerencia_queja::
                    select('sugerencia_queja.id',
                           'sugerencia_queja.descripcion',
                           'sugerencia_queja.status',
                           'sugerencia_queja.trabajador_id',
                           'sugerencia_queja.tipo',
                           'sugerencia_queja.en_proceso',
                           'sugerencia_queja.conclusion',
                           'sugerencia_queja.estatus',
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


    public function show($id)
    {
        try{

            $sugerencia_queja = sugerencia_queja::find($id);
            return response()->json($sugerencia_queja,Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }

    public function update(Request $request, $id)
    {
        try{
             $sugerencia_queja = sugerencia_queja::find($id);
             $sugerencia_queja->fill($request->all());
             $sugerencia_queja->save();

            return response()->json($sugerencia_queja,Response::HTTP_OK);

          }catch (Exception $ex){
              return response()
              ->json([
                        'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
              ], 400);
          }
    }

    public function setStatus($id,$status){
        try{

            $sugerencia_queja = sugerencia_queja::find($id);
            $sugerencia_queja->status = $status;
            $sugerencia_queja->save();

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }

    public function store(Request $request)
    {
        try{

            sugerencia_queja::create($request->all());

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }
}
