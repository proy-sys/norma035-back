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

    public function trabajadorGui2($id, $trab){
        try{
            $respuesta = respuesta::trabajadorGui($id, $trab)->get();
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

    // ************************************************ GRAFICA GENERAL GUIA II *******************************************
    public function resultadoTotal($guia){

        try{
            $respuestaTrabajador = respuesta::trabajadorResultado($guia)->get();
            $cnulo = 0;
            $cbajo = 0;
            $cmedio = 0;
            $calto = 0;
            $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuestaTrabajador as $resp) {
                    if ($resp->resultado < 20) $cnulo += 1;
                    if ($resp->resultado >= 20 and $resp->resultado < 75) $cbajo += 1;
                    if ($resp->resultado >= 45 and $resp->resultado < 70) $cmedio += 1;
                    if ($resp->resultado >= 70 and $resp->resultado < 90) $calto += 1;
                    if ($resp->resultado >= 90) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuestaTrabajador as $resp) {
                    if ($resp->resultado < 50) $cnulo += 1;
                    if ($resp->resultado >= 50 and $resp->resultado < 75) $cbajo += 1;
                    if ($resp->resultado >= 75 and $resp->resultado < 99) $cmedio += 1;
                    if ($resp->resultado >= 99 and $resp->resultado < 140) $calto += 1;
                    if ($resp->resultado >= 140) $cmuyalto += 1;
                }
            }
            $contadorRespustas = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustas,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),506]);
        }
    }

    // ************************************************ CATEGORIAS GUIA II *******************************************

    // ****************************************** Ambiente de trabajo  ******************************************
    public function resultadoCategoriaAmb($guia){
        if ($guia == 2) $pregun = [1, 2, 3];
        if ($guia == 3) $pregun = [1, 2, 3, 4, 5];

        try{
            $respuesta = respuesta::trabajadorCategoriaAmb($guia, $pregun)->get();
            $cnulo = 0;
            $cbajo = 0;
            $cmedio = 0;
            $calto = 0;
            $cmuyalto = 0;
            if ($guia == 2) {
            foreach($respuesta as $resp) {
                if ($resp->resultado < 3) $cnulo += 1;
                if ($resp->resultado >= 3 and $resp->resultado < 5) $cbajo += 1;
                if ($resp->resultado >= 5 and $resp->resultado < 7) $cbajo += 1;
                if ($resp->resultado >= 7 and $resp->resultado < 9) $cbajo += 1;
                if ($resp->resultado >= 9) $cmuyalto += 1;
            }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 5) $cnulo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 9) $cbajo += 1;
                    if ($resp->resultado >= 9 and $resp->resultado < 11) $cbajo += 1;
                    if ($resp->resultado >= 11 and $resp->resultado < 14) $cbajo += 1;
                    if ($resp->resultado >= 14) $cmuyalto += 1;
            }
            }
            $contadorRespustaAmb = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustaAmb,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // ******************************************* Factores propios  ******************************************
    public function resultadoCategoriaFac($guia){
        if ($guia == 2) $pregun = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 18, 19, 20, 21, 22, 26, 27, 41, 42, 43];
        if ($guia == 3) $pregun = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 65, 66, 67, 68];

        try{
            $respuesta = respuesta::trabajadorCategoriaFac($guia, $pregun)->get();
            $cnulo = 0;
            $cbajo = 0;
            $cmedio = 0;
            $calto = 0;
            $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 10) $cnulo += 1;
                    if ($resp->resultado >= 10 and $resp->resultado < 20) $cbajo += 1;
                    if ($resp->resultado >= 20 and $resp->resultado < 30) $cbajo += 1;
                    if ($resp->resultado >= 30 and $resp->resultado < 40) $cbajo += 1;
                    if ($resp->resultado >= 40) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 15) $cnulo += 1;
                    if ($resp->resultado >= 15 and $resp->resultado < 30) $cbajo += 1;
                    if ($resp->resultado >= 30 and $resp->resultado < 45) $cbajo += 1;
                    if ($resp->resultado >= 45 and $resp->resultado < 60) $cbajo += 1;
                    if ($resp->resultado >= 60) $cmuyalto += 1;
                }
            }

            $contadorRespustaFac = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustaFac,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // **************************************** Organización del tiempo ***************************************
    public function resultadoCategoriaOrg($guia){
        if ($guia == 2) $pregun = [14, 15, 16, 17];
        if ($guia == 3) $pregun = [17, 18, 19, 20, 21, 22];
        try{
            $respuesta = respuesta::trabajadorCategoriaOrg($guia, $pregun)->get();
            $cnulo = 0;
            $cbajo = 0;
            $cmedio = 0;
            $calto = 0;
            $cmuyalto = 0;
            if ($guia == 2) {
            foreach($respuesta as $resp) {
                if ($resp->resultado < 4) $cnulo += 1;
                if ($resp->resultado >= 4 and $resp->resultado < 6) $cbajo += 1;
                if ($resp->resultado >= 6 and $resp->resultado < 9) $cbajo += 1;
                if ($resp->resultado >= 9 and $resp->resultado < 12) $cbajo += 1;
                if ($resp->resultado >= 12) $cmuyalto += 1;
            }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 5) $cnulo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 7) $cbajo += 1;
                    if ($resp->resultado >= 7 and $resp->resultado < 10) $cbajo += 1;
                    if ($resp->resultado >= 10 and $resp->resultado < 13) $cbajo += 1;
                    if ($resp->resultado >= 13) $cmuyalto += 1;
                }
                }
            $contadorRespustaOrg = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustaOrg,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // ********************************************* Liderazgo ***************************************************
    public function resultadoCategoriaLid($guia){
        if ($guia == 2) $pregun = [23, 24, 25, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 44, 45, 46];
        if ($guia == 3) $pregun = [32, 33, 34, 38, 39, 40, 41, 43, 44, 45, 46, 58, 59, 60, 61, 62, 63, 64, 70, 71, 72];
        try{
            $respuesta = respuesta::trabajadorCategoriaLid($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;

            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 10) $cnulo += 1;
                    if ($resp->resultado >= 10 and $resp->resultado < 18) $cbajo += 1;
                    if ($resp->resultado >= 18 and $resp->resultado < 28) $cbajo += 1;
                    if ($resp->resultado >= 28 and $resp->resultado < 38) $cbajo += 1;
                    if ($resp->resultado >= 38) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespustaLid = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustaLid,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // ***************************************** Entorno organizacional ******************************************
    public function resultadoCategoriaEnt($guia){
        if ($guia == 3) $pregun = [47, 48, 49, 50, 51, 52, 53, 54, 55, 56];
        try{
            $respuesta = respuesta::trabajadorCategoriaEnt($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            foreach($respuesta as $resp) {
                if ($resp->resultado < 10) $cnulo += 1;
                if ($resp->resultado >= 10 and $resp->resultado < 14) $cbajo += 1;
                if ($resp->resultado >= 14 and $resp->resultado < 18) $cbajo += 1;
                if ($resp->resultado >= 18 and $resp->resultado < 23) $cbajo += 1;
                if ($resp->resultado >= 23) $cmuyalto += 1;
            }
            $contadorRespustaEnt = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespustaEnt,Response::HTTP_OK);
        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // ****************************************************** DOMINIOS ************************************************

    // ============================================= 1 ============================================
    public function resultadoDominio1($guia){
        if ($guia == 2) $pregun = [1, 2, 3];
        if ($guia == 3) $pregun = [1, 2, 3, 4, 5];
        try{
            $respuesta = respuesta::trabajadorDominio1($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 3) $cnulo += 1;
                    if ($resp->resultado >= 3 and $resp->resultado < 5) $cbajo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 7) $cbajo += 1;
                    if ($resp->resultado >= 7 and $resp->resultado < 9) $cbajo += 1;
                    if ($resp->resultado >= 9) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta1 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta1,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 2 ============================================
    public function resultadoDominio2($guia){
        if ($guia == 2) $pregun = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 41, 42, 43];
        if ($guia == 3) $pregun = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 65, 66, 67, 68];
        try{
            $respuesta = respuesta::trabajadorDominio2($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 12) $cnulo += 1;
                    if ($resp->resultado >= 12 and $resp->resultado < 16) $cbajo += 1;
                    if ($resp->resultado >= 16 and $resp->resultado < 20) $cbajo += 1;
                    if ($resp->resultado >= 20 and $resp->resultado < 24) $cbajo += 1;
                    if ($resp->resultado >= 24) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta2 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta2,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 3 ============================================
    public function resultadoDominio3($guia){
        if ($guia == 2) $pregun = [18, 19, 20, 21, 22, 26, 27];
        if ($guia == 3) $pregun = [25, 26, 27, 28, 29, 30, 35, 36];
        try{
            $respuesta = respuesta::trabajadorDominio3($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 5) $cnulo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 8) $cbajo += 1;
                    if ($resp->resultado >= 8 and $resp->resultado < 11) $cbajo += 1;
                    if ($resp->resultado >= 11 and $resp->resultado < 14) $cbajo += 1;
                    if ($resp->resultado >= 14) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta3 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta3,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 4 ============================================
    public function resultadoDominio4($guia){
        if ($guia == 2) $pregun = [14, 15];
        if ($guia == 3) $pregun = [17, 18];
        try{
            $respuesta = respuesta::trabajadorDominio4($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 1) $cnulo += 1;
                    if ($resp->resultado >= 1 and $resp->resultado < 2) $cbajo += 1;
                    if ($resp->resultado >= 2 and $resp->resultado < 4) $cbajo += 1;
                    if ($resp->resultado >= 4 and $resp->resultado < 6) $cbajo += 1;
                    if ($resp->resultado >= 6) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta4 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta4,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 5 ============================================
    public function resultadoDominio5($guia){
        if ($guia == 2) $pregun = [16, 17];
        if ($guia == 3) $pregun = [19, 20, 21, 22];
        try{
            $respuesta = respuesta::trabajadorDominio5($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 1) $cnulo += 1;
                    if ($resp->resultado >= 1 and $resp->resultado < 2) $cbajo += 1;
                    if ($resp->resultado >= 2 and $resp->resultado < 4) $cbajo += 1;
                    if ($resp->resultado >= 4 and $resp->resultado < 6) $cbajo += 1;
                    if ($resp->resultado >= 6) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta5 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta5,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 6 ============================================
    public function resultadoDominio6($guia){
        if ($guia == 2) $pregun = [23, 24, 25, 28, 29];
        if ($guia == 3) $pregun = [31, 32, 33, 34, 37, 38, 39, 40, 41];
        try{
            $respuesta = respuesta::trabajadorDominio6($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 3) $cnulo += 1;
                    if ($resp->resultado >= 3 and $resp->resultado < 5) $cbajo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 8) $cbajo += 1;
                    if ($resp->resultado >= 8 and $resp->resultado < 11) $cbajo += 1;
                    if ($resp->resultado >= 11) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta6 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta6,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 7 ============================================
    public function resultadoDominio7($guia){
        if ($guia == 2) $pregun = [30, 31, 32, 44, 45, 46];
        if ($guia == 3) $pregun = [42, 43, 44, 45, 46, 69, 70, 71, 72];
        try{
            $respuesta = respuesta::trabajadorDominio7($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 5) $cnulo += 1;
                    if ($resp->resultado >= 5 and $resp->resultado < 8) $cbajo += 1;
                    if ($resp->resultado >= 8 and $resp->resultado < 11) $cbajo += 1;
                    if ($resp->resultado >= 11 and $resp->resultado < 14) $cbajo += 1;
                    if ($resp->resultado >= 14) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta7 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta7,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 8 ============================================
    public function resultadoDominio8($guia){
        if ($guia == 2) $pregun = [33, 34, 35, 36, 37, 38, 39, 40];
        if ($guia == 3) $pregun = [57, 58, 59, 60, 61, 62, 63, 64];
        try{
            $respuesta = respuesta::trabajadorDominio8($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            if ($guia == 2) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 7) $cnulo += 1;
                    if ($resp->resultado >= 7 and $resp->resultado < 10) $cbajo += 1;
                    if ($resp->resultado >= 10 and $resp->resultado < 13) $cbajo += 1;
                    if ($resp->resultado >= 13 and $resp->resultado < 16) $cbajo += 1;
                    if ($resp->resultado >= 16) $cmuyalto += 1;
                }
            }
            if ($guia == 3) {
                foreach($respuesta as $resp) {
                    if ($resp->resultado < 14) $cnulo += 1;
                    if ($resp->resultado >= 14 and $resp->resultado < 29) $cbajo += 1;
                    if ($resp->resultado >= 29 and $resp->resultado < 42) $cbajo += 1;
                    if ($resp->resultado >= 42 and $resp->resultado < 58) $cbajo += 1;
                    if ($resp->resultado >= 58) $cmuyalto += 1;
                }
            }
            $contadorRespusta8 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta8,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

    // ============================================= 7 ============================================
    public function resultadoDominio9($guia){
        if ($guia == 3) $pregun = [47, 48, 49, 50, 51, 52];
        try{
            $respuesta = respuesta::trabajadorDominio9($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            foreach($respuesta as $resp) {
                if ($resp->resultado < 6) $cnulo += 1;
                if ($resp->resultado >= 6 and $resp->resultado < 10) $cbajo += 1;
                if ($resp->resultado >= 10 and $resp->resultado < 14) $cbajo += 1;
                if ($resp->resultado >= 14 and $resp->resultado < 18) $cbajo += 1;
                if ($resp->resultado >= 18) $cmuyalto += 1;
            }
            $contadorRespusta9 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta9,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }
    // ============================================= 8 ============================================
    public function resultadoDominio10($guia){
        if ($guia == 3) $pregun = [53, 54, 55, 56];
        try{
            $respuesta = respuesta::trabajadorDominio10($guia, $pregun)->get();
            $cnulo = 0; $cbajo = 0; $cmedio = 0; $calto = 0; $cmuyalto = 0;
            foreach($respuesta as $resp) {
                if ($resp->resultado < 4) $cnulo += 1;
                if ($resp->resultado >= 4 and $resp->resultado < 6) $cbajo += 1;
                if ($resp->resultado >= 6 and $resp->resultado < 8) $cbajo += 1;
                if ($resp->resultado >= 8 and $resp->resultado < 10) $cbajo += 1;
                if ($resp->resultado >= 10) $cmuyalto += 1;
            }
            $contadorRespusta10 = ['name' => ['Nulo', 'Bajo', 'Medio', 'Alto', 'Muy alto',] , 'value' => [$cnulo, $cbajo, $cmedio, $calto, $cmuyalto]];
            return response()->json($contadorRespusta10,Response::HTTP_OK);

        }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }

}
