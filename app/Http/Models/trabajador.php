<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{
    protected $table = 'trabajador';
    protected $primaryKey = 'id';
    public $timestamps = false;


     protected $fillable = [
          'id',
          'documento',
          'nombre',
          'telefono',
          'email',
          'curp',
          'direccion',
          'sexo',
          'edad',
          'estado_civil',
          'nivel_estudios',
          'ocupacion',
          'departamento',
          'tipo_puesto',
          'tipo_contrato',
          'tipo_personal',
          'jornada_trabajo',
          'rotacion_turnos',
          'experiencia',
          'tiempo_puesto_actual',
          'tiempo_experiencia',
          'empresa_id',
          'status',
          'nivel_estudios_status',
          'users_id',
          'accept_politica'
     ];

     public function sugerencia_queja(){

          return $this->hasMany('App\Http\Models\sugerencia_queja');

     }

    /* public static function asignarPolitica($id){
          DB::table(trabajador)
     }*/

  
}
