<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509712RegistrationsTable extends Migration
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
                $table->integer('id_entry')->nullable();
                $table->integer('id_congress')->nullable();
                $table->integer('id_speaker')->nullable();
                $table->integer('id_hotel')->nullable();
                $table->integer('id_utente')->nullable();
                $table->integer('id_camera')->nullable();
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
