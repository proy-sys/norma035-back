<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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
       'status'
  ];

}
