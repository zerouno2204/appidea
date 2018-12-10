<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509713RoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->increments('id');
                $table->string('descrizione')->nullable();
                $table->string('prezzo')->nullable();
                $table->integer('id_hotel')->nullable();
                $table->integer('p_letto')->nullable();
                
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
        Schema::dropIfExists('rooms');
    }
}
