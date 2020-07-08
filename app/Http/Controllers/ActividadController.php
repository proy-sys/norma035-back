<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\actividad;
use Symfony\Component\HttpFoundation\Response;

class ActividadController extends Controller
{
    /* Comentario prueba */
    public function index()
    {
        try{

            $actividades = actividad::all();

            return response()->json($actividades,Response::HTTP_OK);

         }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }

    public function store(Request $request)
    {
        try{

            actividad::create($request->all());

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }

    public function getNumeroActividades(){
        try{
             $num_actividades = actividad::count();
             return response()->json($num_actividades,Response::HTTP_OK);

        }catch(Excepcion $ex){

            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


    public function show($id)
    {
           try{

            $actividad = actividad::find($id);
            return response()->json($actividad,Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


    public function update(Request $request, $id)
    {
        try{

             $actividad = actividad::find($id);
             $actividad->fill($request->all());
             $actividad->save();

            return response()->json($actividad,Response::HTTP_OK);

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

            $actividad = actividad::find($id);
            $actividad->delete();
            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }
}
