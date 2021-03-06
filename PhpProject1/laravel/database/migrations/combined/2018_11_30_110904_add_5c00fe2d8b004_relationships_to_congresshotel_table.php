<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2d8b004RelationshipsToCongressHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congress_hotels', function(Blueprint $table) {
            if (!Schema::hasColumn('congress_hotels', 'id_congress_id')) {
                $table->integer('id_congress_id')->unsigned()->nullable();
                $table->foreign('id_congress_id', '234200_5c00f80df3633')->references('id')->on('congresses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('congress_hotels', 'id_hotel_id')) {
                $table->integer('id_hotel_id')->unsigned()->nullable();
                $table->foreign('id_hotel_id', '234200_5c00f80e15f8e')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::table('congress_hotels', function(Blueprint $table) {
            if(Schema::hasColumn('congress_hotels', 'id_congress_id')) {
                $table->dropForeign('234200_5c00f80df3633');
                $table->dropIndex('234200_5c00f80df3633');
                $table->dropColumn('id_congress_id');
            }
            if(Schema::hasColumn('congress_hotels', 'id_hotel_id')) {
                $table->dropForeign('234200_5c00f80e15f8e');
                $table->dropIndex('234200_5c00f80e15f8e');
                $table->dropColumn('id_hotel_id');
            }
            
        });
    }
}
