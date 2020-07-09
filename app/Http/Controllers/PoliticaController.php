<?php

namespace App\Http\Controllers;

use App\Http\Models\politica;
use App\Http\Models\empresa;
use App\Http\Independientes\Imagen;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PoliticaController extends Controller
{
    
   
   function __construct(){

       $this->img = new imagen();
   }

   public function listadoPoliticas(){   
     
      try{
          
           $empresa = empresa::find(1);   /* prueba para empresa 1 */ 

           if(is_null($empresa->politica_id)){

               $politicas = politica::all();
         
               foreach ($politicas as $politica){
                     $politica->imagen =  $this->imagen->ValidarImagen($politica->imagen);
              }   
              
              return response()->json(["politicas"=> $politicas,"status"=>true,"estado"=>Response::HTTP_OK]);      /*true todas las politicas*/
           }
          
          $politica = $empresa->politica;
          $politica->imagen = $this->img->ValidarImagen($politica->imagen);

          return response()->json(["politica"=> $politica,"status"=>false,"estado"=>Response::HTTP_OK]); /*  false una politica */

      }catch(Excepcion $ex){
          return response()->json(['error'=> $ex.getMessage(),206]);
      }  

   }

    public function show($id)
    {
        try{
               
            $politica = politica::find($id);
             return response()->json($politica,Response::HTTP_OK);
        
        }catch(Excepcion $ex){

            return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


    public function update(Request $request, $id)
    {
      try{
    
         $politica = politica::find($id);
         $politica->fill($request->all());
         $politica->save();

        return response()->json($politica,Response::HTTP_OK);

      }catch (Exception $ex){
          return response()
          ->json([
                    'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
          ], 400);
      }
    }
}
