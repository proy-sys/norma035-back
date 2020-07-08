<?php

namespace App\Http\Controllers;

use App\Http\Models\politica;
use App\Http\Models\empresa;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PoliticaController extends Controller
{
    
   

   public function index(){
    try{

        $_politicas =  empresa::find(1)->politicas;   /* Prueba para empresa 1 */ 
        
        return response()->json($_politicas,Response::HTTP_OK);

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
