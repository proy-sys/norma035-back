<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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
   ];

   



}