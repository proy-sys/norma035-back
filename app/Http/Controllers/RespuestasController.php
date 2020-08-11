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

             return response()->json($respuesta,Response::HTTP_OK);

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
        try{
            $respuestaTrabajador = respuesta::trabajadorResultado($guia)->get();
            $cnulo = 0;
            $cbajo = 0;
            $cmedio = 0;
            $calto = 0;
            $cmuyalto = 0;
            foreach($respuestaTrabajador as $resp) {
                if ($resp->resultado < 20) $cnulo += 1;
                if ($resp->resultado >= 20 and $resp->resultado < 45) $cbajo += 1;
                if ($resp->resultado >= 45 and $resp->resultado < 70) $cmedio += 1;
                if ($resp->resultado >= 70 and $resp->resultado < 90) $calto += 1;
                if ($resp->resultado >= 90) $cmuyalto += 1;
            }
            $contadorRespustas = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [5, $cbajo, $cmedio, $calto, $cmuyalto]];
            // dd($contadorRespustas);
            return response()->json($contadorRespustas,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


}
