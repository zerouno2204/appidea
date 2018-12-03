<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00f89c56db4RelationshipsToHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function(Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'citta_id')) {
                $table->integer('citta_id')->unsigned()->nullable();
                $table->foreign('citta_id', '234203_5c00f89ad6966')->references('id')->on('cities')->onDelete('cascade');
                }
                if (!Schema::hasColumn('hotels', 'provincia_id')) {
                $table->integer('provincia_id')->unsigned()->nullable();
                $table->foreign('provincia_id', '234203_5c00f89aecb5d')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::table('hotels', function(Blueprint $table) {
            
        });
    }
}
