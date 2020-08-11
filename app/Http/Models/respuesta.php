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

   public static function trabajadorG($guia){
       return DB::table('respuestas')
               ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
               ->where('guia_id', $guia);
   }

   public static function trabajadorResultado($guia){
      return  DB::table('respuestas')
                ->select('trabajador.id',
                         'trabajador.nombre',
                         'trabajador.email',
                         'trabajador.ocupacion',
                          DB::raw('sum(respuestas.respuesta) as resultado'))
              ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
              ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
              ->where('respuestas.guia_id',$guia);
      }
   }

//    public static function resultadosTotales($guia){
//     return  DB::table('respuestas')
//               ->select('trabajador.id',
//                        'trabajador.nombre',
//                        'trabajador.email',
//                        'trabajador.ocupacion',
//                         DB::raw('sum(respuestas.respuesta) as resultado'))
//             ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
//             ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
//             ->where('respuestas.guia_id',$guia);
//     }


