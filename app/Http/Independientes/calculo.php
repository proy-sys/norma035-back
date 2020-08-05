<?php
  
namespace App\Http\Independientes;

class Calculo 
{
   public function calculoGeneral($resultado){

     if($resultado<20){
            return "Nulo/Despreciable";
     }else if($resultado>= 20 && $resultado<45){
            return "Bajo";
     }else if($resultado>= 45 && $resultado<70){
             return "Medio";
     }else if($resultado>=70 && $resultado<90){
              return "Alto";
     }else if($resultado>=90){
              return "Muy Alto";
     }
   }

}