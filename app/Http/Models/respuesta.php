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

   public static function trabajadorGui($guia, $trab){
    return DB::table('respuestas')
            ->where('guia_id', $guia)
            ->where('trabajador_id', $trab);
}

   public static function trabajadorResultado($guia,$idEmpresa){
      return  DB::table('respuestas')
                ->select('trabajador.id',
                         'trabajador.nombre',
                         'trabajador.email',
                         'trabajador.ocupacion',
                          DB::raw('sum(respuestas.respuesta) as resultado'))
              ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
              ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
              ->where('respuestas.guia_id',$guia)
              ->where('trabajador.empresa_id',$idEmpresa);
      }

    //  ************************************************** CATEGORÍAS *********************************************
    public static function trabajadorCategoriaAmb($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    public static function trabajadorCategoriaFac($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    public static function trabajadorCategoriaOrg($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    public static function trabajadorCategoriaLid($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    public static function trabajadorCategoriaEnt($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    //  ************************************************** DOMINIOS *********************************************

    // ==================================================== 1 ========================================
    public static function trabajadorDominio1($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    // ==================================================== 2 ========================================
    public static function trabajadorDominio2($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 3 ========================================
    public static function trabajadorDominio3($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 4 ========================================
    public static function trabajadorDominio4($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 5 ========================================
    public static function trabajadorDominio5($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 6 ========================================
    public static function trabajadorDominio6($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 7 ========================================
    public static function trabajadorDominio7($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 8 ========================================
    public static function trabajadorDominio8($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    // ==================================================== 7 ========================================
    public static function trabajadorDominio9($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }
    // ==================================================== 8 ========================================
    public static function trabajadorDominio10($guia, $pregun){
        return  DB::table('respuestas')
                  ->select('trabajador.id',
                            DB::raw('sum(respuestas.respuesta) as resultado'))
                ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
                ->groupBy('trabajador.id','trabajador.ocupacion','respuestas.guia_id')
                ->where('respuestas.guia_id',$guia)
                ->whereIn('pregunta_id', $pregun);
    }

    public static function listadoContestaronTrabajadores($idGuia,$idEmpresa){
      return DB::table('respuestas')
        ->select('trabajador.id',
                 'trabajador.nombre',
                 'trabajador.ocupacion', 
                 'trabajador.telefono',
                 'trabajador.email',
                 'trabajador.tipo_puesto')
         ->leftJoin('trabajador', 'trabajador.id', '=', 'respuestas.trabajador_id')
         ->where('trabajador.empresa_id',$idEmpresa)
         ->where('respuestas.guia_id',$idGuia)
         ->groupBy('trabajador.id')
         ->get();
    }

}
