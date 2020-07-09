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

            $sugerencias_quejas= sugerencia_queja::all();        /*sugerencia para una determinada empresa*/
			
            return response()->json($sugerencias_quejas,Response::HTTP_OK);
 
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
}
