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






}
