<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresaPolitica extends Migration
{
   
    public function up()
    {
            Schema::create('empresa_politica', function (Blueprint $table) {
            $table->integer('empresa_id')->unsigned();
            $table->integer('politica_id')->unsigned();
        
            $table->foreign('empresa_id')->references('id')->on('empresa');
            $table->foreign('politica_id')->references('id')->on('politica');
        });
    }

    public function down()
    {
        Schema::drop('empresa_politica');
    }
}
