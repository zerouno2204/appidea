<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509699CongressHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('congress_hotels')) {
            Schema::create('congress_hotels', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_hotel')->nullable();
                $table->integer('id_congress')->nullable();
                
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
        Schema::dropIfExists('congress_hotels');
    }
}
