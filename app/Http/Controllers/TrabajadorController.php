<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\trabajador;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Models\empresa;
use App\Http\Models\respuesta;
use App\User;

class TrabajadorController extends Controller
{
   
    public function index()
    {
        try{
             $user = auth()->user();
             $empresa =  empresa::infoEmpresa($user->id); 

             $trabajadores = trabajador::where('empresa_id',$empresa->id)     
                                        ->where('status',true)  
                                        ->get();
			
            return response()->json($trabajadores,Response::HTTP_OK);
 
         }catch(Excepcion $ex){
            return response()->json(['error'=> $ex.getMessage(),206]);
         }
    }

    public function store(Request $request)
    {
        try{
        
            // $input = $request->all();
            // $input['password'] = Hash::make($request->password);
            trabajador::create($request->all());
            
            // $user =  new User([
            //      'id' => $id,
            //      'username' => 'hola',
            //      'password' => Hash::make(12345),
            //      'role' => 0,
            // ]);
            // $user->save();

           return response()->json(Response::HTTP_OK);

       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }

    public function acceptPolitica(){

        try{
            
            $user = auth()->user();
            $trabajador = trabajador::find($user->id);
            $trabajador->accept_politica = true;
            $trabajador->save();

            return response()->json(Response::HTTP_OK);
           
       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
       
    }

    public function getNumeroTrabajadores(){
        try{
             $user = auth()->user();
             $empresa =  empresa::infoEmpresa($user->id); 

             $num_trabajadores = trabajador::where('empresa_id',$empresa->id)  
                                           ->where('status',true)  
                                           ->count();
             
             return response()->json($num_trabajadores,Response::HTTP_OK);

        }catch(Excepcion $ex){

            return response()->json(['error'=> $ex.getMessage(),206]);
        }
    }


    public function show($id)
    {
           try{
               
            $trabajador = trabajador::find($id);
            return response()->json($trabajador,Response::HTTP_OK);
           
       }catch(Excepcion $ex){

           return response()->json(['error'=> $ex.getMessage(),206]);
       }
    }


    public function update(Request $request, $id)
    {
        try{
    
             $trabajador = trabajador::find($id);
             $trabajador->fill($request->all());
             $trabajador->save();

            return response()->json($trabajador,Response::HTTP_OK);
  
          }catch (Exception $ex){
              return response()
              ->json([
                        'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
              ], 400);
          }
    }

    public function destroy($id){

        try{
    
            $trabajador = trabajador::find($id);
            $trabajador->status  = false;
            $trabajador->save();

           return response()->json(Response::HTTP_OK);
 
         }catch (Exception $ex){
             return response()
             ->json([
                       'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
             ], 400);
         }
    }
    
    public function getContestaronTrabajadores($idGuia){
        try{
    
            $user = auth()->user();
            $empresa =  empresa::infoEmpresa($user->id); 
            $trabajadores = respuesta::listadoContestaronTrabajadores($idGuia,$empresa->id);

            return response()->json($trabajadores,Response::HTTP_OK);
 
         }catch (Exception $ex){
             return response()
             ->json([
                       'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
             ]);
         }

    }
  

}
