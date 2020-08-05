<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class respuesta extends Model
{
    protected $table = 'respuestas';
    protected $primaryKey = 'pregunta_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'trabajador_id',
        'pregunta_id',
        'respuesta',
        'guia_id',  
   ];

   public static function calculoTrabajador($id){
      return DB::table('respuestas')
               ->where('trabajador_id',$id)
               ->sum('respuesta');          
   }

   public static function trabjadorGuia($guia){
       return DB::table('repuestas')
               ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas')
               ->where('guia_id',$guia);
   }
          
}
