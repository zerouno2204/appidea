<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fd8ae68ebRelationshipsToRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function(Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'id_hotel_id')) {
                $table->integer('id_hotel_id')->unsigned()->nullable();
                $table->foreign('id_hotel_id', '234208_5c00fd897c5c1')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::table('rooms', function(Blueprint $table) {
            
        });
    }
}
