<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1543509696CongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('congresses')) {
            Schema::create('congresses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome')->nullable();
                $table->string('descrizione')->nullable();
                $table->date('data_inizio')->nullable();
                $table->date('data_fine')->nullable();
                $table->string('img')->nullable();
                $table->string('descr_sede')->nullable();
                $table->string('ind_sede')->nullable();
                $table->string('lat')->nullable();
                $table->string('lng')->nullable();
                $table->string('cap_sede')->nullable();
                
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
        Schema::dropIfExists('congresses');
    }
}
