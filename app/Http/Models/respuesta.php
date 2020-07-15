<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class respuesta extends Model
{
    protected $table = 'respuestas';
    protected $primaryKey = 'pregunta_id'; 
    public $timestamps = false; 
}
