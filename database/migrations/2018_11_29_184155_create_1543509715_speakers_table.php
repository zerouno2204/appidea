<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509715SpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('speakers')) {
            Schema::create('speakers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome')->nullable();
                $table->string('cognome')->nullable();
                $table->string('descrizione')->nullable();
                $table->string('img_path')->nullable();
                $table->string('cv_name')->nullable();
                $table->string('contatti')->nullable();
                $table->string('ruolo')->nullable();
                
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
        Schema::dropIfExists('speakers');
    }
}
