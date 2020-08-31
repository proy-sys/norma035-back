<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\empresa;
use App\Http\Models\codigo_postal;
use App\Http\Independientes\Imagen;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Controller
{

    function __construct(){
            $this->imagen = new imagen();
    }

    public function index(){
        try{
            
            //$empresa=  empresa::find(1);  
            $empresa = empresa::find($user);                  
            $empresa->logo    =  $this->imagen->ValidarImagen($empresa->logo);
            $empresa->imagen  =  $this->imagen->ValidarImagen($empresa->imagen);
            
             return response()->json($empresa ,Response::HTTP_OK);
    
          }catch(Excepcion $ex){
             return response()->json(['error'=> $ex.getMessage(),206]);
          }


    }


    public function listaEmpresas()
    {

       try{
            $empresas = empresa::all();

            foreach ($empresas as $empresa){
                $empresa->logo   =  $this->imagen->ValidarImagen($empresa->logo);
                $empresa->imagen =  $this->imagen->ValidarImagen($empresa->imagen);
            }

            return response()->json($empresas,Response::HTTP_OK);

         }catch(Excepcion $ex){
             return response()->json(['error'=> $ex.getMessage(),206]);
         }  

    }



    public function show(Request $request,$id)
    {
       try{

            $empresa = empresa::find($id);
            $empresa->logo    =  $this->imagen->ValidarImagen($empresa->logo);
            $empresa->imagen  =  $this->imagen->ValidarImagen($empresa->imagen);

            return response()->json($empresa,Response::HTTP_OK);

         }catch(Excepcion $ex){
           return response()->json([
                             'error' => 'Hubo un error al encontrar el cargo con id => '. $id ." : ". $ex->getMessage()
                         ], 404);
         }
    }

    public function update(Request $request, $id){
        try{

         $empresa = empresa::find($id);
         $empresa->fill($request->all());
         $empresa->save();

        return response()->json($empresa,Response::HTTP_OK);

      }catch (Exception $ex){
          return response()
          ->json([
                    'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
          ], 400);
      }
   }
   
   public function obtenerMunicipioEstado($codigoPostal){
    try{

        $estadoMunicipio  = codigo_postal::estadoMunicipio($codigoPostal); 
        
        if($estadoMunicipio == null){
             $estadoMunicipio = 1;
        }

        return response()->json($estadoMunicipio,Response::HTTP_OK);

      }catch(Excepcion $ex){
         return response()->json(['error'=> $ex.getMessage(),206]);
      }
   }
}
