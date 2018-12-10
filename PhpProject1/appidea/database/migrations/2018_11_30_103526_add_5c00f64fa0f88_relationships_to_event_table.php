<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00f64fa0f88RelationshipsToEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function(Blueprint $table) {
            if (!Schema::hasColumn('events', 'id_sala_id')) {
                $table->integer('id_sala_id')->unsigned()->nullable();
                $table->foreign('id_sala_id', '234382_5c00f64e4607e')->references('id')->on('halls')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function(Blueprint $table) {
            
        });
    }
}
