<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class codigo_postal extends Model
{
    protected $table = 'codigos_postales';
    protected $primaryKey = 'cp'; 
    public $timestamps = false;  

     
     protected $fillable = [
         'cp',
         'colonia',
         'municipio',
         'estado',
         'municipio_id',
         'estado_id',
     ];


     public static function estadoMunicipio($codigoPostal){
            
        return DB::table('codigos_postales')
                ->select('codigos_postales.municipio',
                         'codigos_postales.estado')
                ->where('cp',$codigoPostal)
                ->first();
     }
 
}
