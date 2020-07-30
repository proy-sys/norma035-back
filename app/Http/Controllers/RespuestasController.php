<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\respuesta;
use Symfony\Component\HttpFoundation\Response;

class RespuestasController extends Controller
{
   
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
