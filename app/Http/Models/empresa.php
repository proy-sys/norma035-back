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
          'politica_id'   
     ];

   public function politica() {
          return $this->belongsTo('App\Http\Models\politica');  
   }



}
