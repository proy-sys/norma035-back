<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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
		  'status'
     ];
}
