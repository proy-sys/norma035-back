<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class politica extends Model
{

    protected $table = 'politica';
    protected $primaryKey = 'id'; 
    public $timestamps = false;  

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
   ];

  public function empresa(){

           return $this->belongsToMany('App\Http\Models\empresa'); 
  }

}
