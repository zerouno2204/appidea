<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509705HotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('hotels')) {
            Schema::create('hotels', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome')->nullable();
                $table->string('descrizione')->nullable();
                $table->string('lat')->nullable();
                $table->string('lng')->nullable();
                $table->string('indirizzo')->nullable();
                $table->integer('citta_id')->nullable();
                $table->integer('provincia_id')->nullable();
                $table->string('cap')->nullable();
                
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
        Schema::dropIfExists('hotels');
    }
}
