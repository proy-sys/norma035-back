<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\trabajador;
use Symfony\Component\HttpFoundation\Response;

class TrabajadorController extends Controller
{
   
    public function index()
    {
        try{
            //$trabajadores = trabajador::all();

             $trabajadores = trabajador::where('empresa_id',1)          /*prueba para empresa 1 */
                                        ->where('status',true)  
                                        ->get();
			
            return response()->json($trabajadores,Response::HTTP_OK);
 
         }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }

    public function store(Request $request)
    {
        try{
             
            trabajador::create($request->all());

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }



    public function getNumeroTrabajadores(){
        try{
             $num_trabajadores = trabajador::where('empresa_id',1)  
                                           ->where('status',true)  
                                           ->count();
             return response()->json($num_trabajadores,Response::HTTP_OK);

        }catch(Excepcion $ex){

            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


    public function show($id)
    {
           try{
               
            $trabajador = trabajador::find($id);
            return response()->json($trabajador,Response::HTTP_OK);
           
       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


    public function update(Request $request, $id)
    {
        try{
    
             $trabajador = trabajador::find($id);
             $trabajador->fill($request->all());
             $trabajador->save();

            return response()->json($trabajador,Response::HTTP_OK);
  
          }catch (Exception $ex){
              return response()
              ->json([
                        'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
              ], 400);
          }
    }

    public function destroy($id){

        try{
    
            $trabajador = trabajador::find($id);
            $trabajador->status  = false;
            $trabajador->save();

           return response()->json(Response::HTTP_OK);
 
         }catch (Exception $ex){
             return response()
             ->json([
                       'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
             ], 400);
         }
    }

  
   /* public function destroy($id)
    {
        try{

            $trabajador = trabajador::find($id);
            $trabajador->delete();  
            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }*/

}
