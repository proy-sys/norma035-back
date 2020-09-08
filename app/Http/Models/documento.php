<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
       'id',
       'nombre',
       'tipo',
       'fecha',
       'responsable_id',
       'trabajadores',
       'status',
       'empresa_id'
  ];

  public static function listaDocumentos($idEmpresa){

    return DB::table('documentos')
             ->select('documentos.id',
                      'documentos.nombre',
                      'documentos.tipo',
                      'documentos.fecha',
                      'documentos.responsable_id',
                      'documentos.trabajadores',
                      'documentos.status',
                      'documentos.empresa_id',
                      'trabajador.nombre as trabajador')
              ->leftJoin('trabajador', 'trabajador.id', '=', 'documentos.responsable_id')
              ->where('documentos.empresa_id',$idEmpresa)
              ->where('documentos.status',true)
              ->orderBy('documentos.id','desc')
              ->get();
   }

}
