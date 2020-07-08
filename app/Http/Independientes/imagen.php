<?php
  
namespace App\Http\Independientes;

class Imagen 
{
   
   public function validarImagen($imagen){

    if($imagen!=null){

          $my_byte  = stream_get_contents($imagen);   
          return pg_unescape_bytea($my_byte);
        
     }

     return null;

   }
    
}
