<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1543509712RegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('registrations')) {
            Schema::create('registrations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome_documento')->nullable();
                $table->string('luogo_rilascio')->nullable();
                $table->date('data_emissione')->nullable();
                $table->date('data_scadenza')->nullable();
                $table->integer('id_tipo_doc')->nullable();
                $table->string('path_img_doc')->nullable();
                $table->string('note')->nullable();
                $table->string('registrationscol')->nullable();
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
