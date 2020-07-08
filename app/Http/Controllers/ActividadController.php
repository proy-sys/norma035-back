<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadController extends Controller
{
    

    public function listaActividades()
    {
        try{

            $trabajadores = trabajador::all();
			
            return response()->json($trabajadores,Response::HTTP_OK);
 
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

   
    public function edit($id)
    {
        
    }

 
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        
    }
}
