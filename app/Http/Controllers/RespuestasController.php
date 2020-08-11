<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\respuesta;
use App\Http\Models\trabajador;
use App\Http\Independientes\calculo;
use Symfony\Component\HttpFoundation\Response;
use DB;
class RespuestasController extends Controller
{
   
    function __construct(){
        $this->calculo = new calculo();
    }


    public function index()
    {
        
    }

    public function create()
    {
        try{

            respuesta::create($request->all());

            return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }
    
    public function addRespuestasGuia1(Request $request)
    {
        try{
          
       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }
    

    public function addRespuestasGuia(Request $request,$id)
    {
        try{
            $input = $request->all();
            foreach ($input['respuestas'] as $respuestas){

               $respuesta = new respuesta([
                    'pregunta_id' => $respuestas['pregunta_id'],
                    'trabajador_id' => $input['trabajador_id'] ,
                    'respuesta' => $respuestas['respuesta'],
                    'guia_id' => $id
                ]);
                $respuesta->save();
            }
        
       $resultado =  respuesta::calculoTrabajador($input['trabajador_id']);
       $cFinal =$this->calculo->calculoGeneral($resultado);
        
       return response()->json([
                                  "estado" => Response::HTTP_OK,
                                  "resultado" => $resultado,
                                  "cFinal" => $cFinal,
                              ]);

       }catch(Excepcion $ex){
           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


   public function trabajadorGuia($id){
        try{

            $respuesta = respuesta::trabajadorG($id)->get();
               
             return response()->json(["estado"     => $estado,
                                      "respuestas" => $respuestas ]);
             
        }catch(Excepcion $ex){
 
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


    public function trabajadorResultado($guia){
        try{
            $respuestaTrabajador = respuesta::trabajadorResultado($guia)->get(); 

            return response()->json($respuestaTrabajador,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    

    public function resultadoTotal($guia){
        $data = [];

        try{
            $respuestaTrabajador = respuesta::trabajadorResultado($guia)->get();
            foreach($respuestaTrabajador as $res){
             
             
            }
        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

}
