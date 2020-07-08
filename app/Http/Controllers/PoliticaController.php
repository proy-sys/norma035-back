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

      $this->imagen = new imagen();
   }

   public function listadoPoliticas(){   
     
      try{
          
           $empresa = empresa::find(1);   /*prueba para empresa 1*/ 

           if(is_null($empresa->politica_id)){

               $politicas = politica::all();
         
               foreach ($politicas as $politica){
                     $politica->imagen =  $this->imagen->ValidarImagen($politica->imagen);
              }   
              
              return response()->json(["polticas"=> $politicas,"status"=>1,"estado"=>Response::HTTP_OK]);      
           }
          
          $empresa = empresa::find(1)->politica;

          
          return response()->json([$empresa,0,Response::HTTP_OK]);   


      }catch(Excepcion $ex){
          return response()->json(['error'=> $ex.getMessage(),206]);
      }  

   }
 
    public function store(Request $request)
    {

    }


    public function show($id)
    {
        
    }


    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
    
    }
}
