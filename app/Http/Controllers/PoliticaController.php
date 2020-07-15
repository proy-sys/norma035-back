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

       $this->im_g= new imagen();
   }

   public function listadoPoliticas(){   
     
      try{
          
           $empresa = empresa::find(1);   /* prueba para empresa 1 */ 

           if(is_null($empresa->politica_id)){

               $politicas = politica::all();
         
               foreach ($politicas as $politica){
                     $politica->img =  $this->im_g->ValidarImagen($politica->img);
              }   
              
              return response()->json(["politicas"=> $politicas,"status"=>true,"estado"=>Response::HTTP_OK]);      /*true todas las politicas*/
           }
          
          $politica = $empresa->politica;
          $politica->img= $this->im_g->ValidarImagen($politica->img);

          return response()->json(["politica"=> $politica,"status"=>false,"estado"=>Response::HTTP_OK]); /*  false una politica */

      }catch(Excepcion $ex){
          return response()->json(['error'=> $ex.getMessage(),206]);
      }  

   }
   
   public function asignarPolitica($id){
      
    try{

         $empresa = empresa::find(1);  /*prueba para la empresa 1*/   
         $empresa->politica_id = $id;
         $empresa->save();  
         return response()->json(Response::HTTP_OK); 

       }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
      }  
   }

   public function show($id)
    {
       try{
           
            $empresa = empresa::find(1);  /*Prueba para la empresa 1*/
            $politica = $empresa->politica;  
            $politica->img= $this->im_g->ValidarImagen($politica->img);
            return response()->json(["politica"=> $politica,"status"=>false,"estado"=>Response::HTTP_OK]);  /*  false una politica */

         }catch(Excepcion $ex){
           return response()->json([
                             'error' => 'Hubo un error al encontrar el cargo con id => '. $id ." : ". $ex->getMessage()
                         ], 404);
         }
    }
  
   public function store(Request $request)
   {
       try{
            
           politica::create($request->all());

           return response()->json(Response::HTTP_OK);

      }catch(Excepcion $ex){

          return response()->json(['error'=> $ex.getMessage(),206]);
      }
   }
    public function updateDescripcion(Request $request, $id, $descripcion)
    {
      try{
    
         $politica = politica::find($id);
         $politica->fill($request->all());
         $politica->save();

         return response()->json(["politica"=> $politica,"status"=>true,"estado"=>Response::HTTP_OK]);

      }catch (Exception $ex){
          return response()
          ->json([
                    'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
          ], 400);
      }
    }
}
