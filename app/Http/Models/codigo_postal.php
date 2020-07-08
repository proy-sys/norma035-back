<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class codigo_postal extends Model
{
    protected $table = 'codigo_postal';
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
}
