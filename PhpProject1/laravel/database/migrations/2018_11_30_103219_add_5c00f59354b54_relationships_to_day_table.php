<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00f59354b54RelationshipsToDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('days', function(Blueprint $table) {
            if (!Schema::hasColumn('days', 'id_congresso_id')) {
                $table->integer('id_congresso_id')->unsigned()->nullable();
                $table->foreign('id_congresso_id', '234380_5c00f4585ce0c')->references('id')->on('congresses')->onDelete('cascade');
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
        Schema::table('days', function(Blueprint $table) {
            
        });
    }
}
