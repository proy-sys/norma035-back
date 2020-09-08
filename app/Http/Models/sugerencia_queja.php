<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class sugerencia_queja extends Model
{

    protected $table = 'sugerencia_queja';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'descripcion',
        'status',
        'tipo',
        'trabajador_id',
        'en_proceso',
        'conclusion',
        'estatus'
   ];

   public function trabajador(){
         return $this->belongsTo('App\Http\Models\trabajador');
   }

  /* public static function listado(){
       return leftJoin('trabajador', 'id', '=', 'id');
  }*/

  public static function listaQuejaSugerencia($idEmpresa){

     return DB::table('sugerencia_queja')
             ->select('sugerencia_queja.id',
                     'sugerencia_queja.descripcion',
                     'sugerencia_queja.status',
                     'sugerencia_queja.trabajador_id',
                     'sugerencia_queja.tipo',
                     'sugerencia_queja.en_proceso',
                     'sugerencia_queja.conclusion',
                     'sugerencia_queja.estatus',
                     'trabajador.nombre')
             ->leftJoin('trabajador', 'trabajador.id', '=', 'sugerencia_queja.trabajador_id')
             ->where('trabajador.empresa_id',$idEmpresa)   
             ->orderBy('sugerencia_queja.id','ASC')
             ->get();    
       }

}
