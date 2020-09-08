<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id'; 
    public $timestamps = false;  

     
     protected $fillable = [
          'id',
          'razon_social',
          'direccion',
          'telefono',
          'email',
          'logo',
          'imagen',  
          'politica_id',
          'codigos_postales_cp'  
     ];

   /* public function politica() {
          return $this->belongsTo('App\Http\Models\politica');  
   } */

   public static function infoEmpresa($idTrabajador){

      return DB::table('trabajador')
              ->select('empresa.id',
                       'empresa.razon_social',
                       'empresa.direccion',
                       'empresa.telefono',
                       'empresa.email',
                       'empresa.logo',
                       'empresa.imagen',
                       'empresa.politica_id',
                       'empresa.codigos_postales_cp')
              ->leftJoin('empresa', 'empresa.id', '=', 'trabajador.empresa_id') 
              ->where('trabajador.id',$idTrabajador)
              ->first();
   }

   public static function estadoMunicipio($codigoPostal){
            
             return DB::table('empresa')
                    ->select('codigos_postales.cp',
                             'codigos_postales.colonia',
                             'codigos_postales.municipio',
                             'codigos_postales.estado')
                    ->leftJoin('codigos_postales', 'codigos_postales.cp', '=', 'empresa.codigos_postales_cp')
                    ->where('cp',$codigoPostal)
                    ->first(); 
   }

   public static function updatePolitica($idEmpresa,$idPolitica){
          DB::table('empresa')->where('id', $idEmpresa)
            ->update(['politica_id' => $idPolitica]);
   }


}
