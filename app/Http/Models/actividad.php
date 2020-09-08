<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class actividad extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'id';
    public $timestamps = false;


     protected $fillable = [
     	  'id',
		  'nombre',
		  'tipo',
		  'fecha',
		  'responsable_id',
		  'imagen1',
		  'imagen2',
		  'status',
		  'empresa_id'
	 ];
	 
     public static function listaActividades($idEmpresa){
		 return DB::table('actividades')
				   ->where('status',true)
				   ->where('empresa_id',$idEmpresa)
                   ->orderBy('id', 'desc')
                   ->get();
		 
	 }
}
