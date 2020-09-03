<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\User;

class AuthController extends Controller
{
  
   public function store(Request $request)
   {
       try{
           $input = $request->all();
           $input['password'] = Hash::make($request->password);

           User::create($input);
           return response()->json([ "estado"=>Response::HTTP_OK,
                                     "msg"=>"user creado correctamente"]);  

      }catch(Excepcion $ex){

          return response()->json(['error'=> $ex.getMessage(),206]);
      }
   }

   public function login(Request $request){
    try{
        
        $user = User::where("username",$request->username)->first();

        if(!is_null($user) && Hash::check($request->password,$user->password)){

            $user->api_token = Str::random(150);
            $user->save();

            return response()->json(["estado"=>Response::HTTP_OK,
                                     "res" => true,
                                     "user" => $user,
                                     "msg"=>"Credenciales correctas"]);  
        }else{
            return response()->json(["estado"=>Response::HTTP_OK,
                                     "res" => false,
                                     "msg"=>"Credenciales no validas"]);  
        }
        
        return response()->json(Response::HTTP_OK);

   }catch(Excepcion $ex){

       return response()->json(['error'=> $ex.getMessage(),206]);
    }
   }
   
   public function userActive(){
       try{
            return auth()->user();
       }catch(Excepcion $ex){
              return response()->json(['error'=> $ex.getMessage(),206]);
       }    
   }

   
   public function logout()
   {
    try{
        
       $user = auth()->user();
       $user->api_token = null;    
       $user->save();
       return response()->json(Response::HTTP_OK);

      }catch(Excepcion $ex){
        return response()->json(['error'=> $ex.getMessage(),206]);
      }  
   }
}
