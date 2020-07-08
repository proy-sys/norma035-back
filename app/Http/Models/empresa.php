<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

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
     ];


     public function politicas(){
          
          return $this->belongsToMany('App\Http\Models\politica');

     }

}
