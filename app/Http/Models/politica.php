<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Independientes\Imagen;

class politica extends Model
{

    protected $table = 'politica';
    protected $primaryKey = 'id'; 
    public $timestamps = false;  

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'imagen'
   ];

 /* public function empresa(){

           return $this->belongsToMany('App\Http\Models\empresa'); 
  }*/

  
  public function empresa() {

       return $this->hasOne('App\Http\Models\empresa');

  }

}
