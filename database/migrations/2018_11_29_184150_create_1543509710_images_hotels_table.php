<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509710ImagesHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('images_hotels')) {
            Schema::create('images_hotels', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_image')->nullable();
                $table->integer('id_hotel')->nullable();
                
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
        Schema::dropIfExists('images_hotels');
    }
}
