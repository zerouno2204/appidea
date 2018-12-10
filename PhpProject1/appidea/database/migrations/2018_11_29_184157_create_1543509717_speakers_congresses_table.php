<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509717SpeakersCongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('speakers_congresses')) {
            Schema::create('speakers_congresses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_congress')->nullable();
                $table->integer('id_speaker')->nullable();
                
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
        Schema::dropIfExists('speakers_congresses');
    }
}
