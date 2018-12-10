<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2e3cc51RelationshipsToImagesHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images_hotels', function(Blueprint $table) {
            if (!Schema::hasColumn('images_hotels', 'img_id')) {
                $table->integer('img_id')->unsigned()->nullable();
                $table->foreign('img_id', '234205_5c00f8d36d185')->references('id')->on('images')->onDelete('cascade');
                }
                if (!Schema::hasColumn('images_hotels', 'hotel_id')) {
                $table->integer('hotel_id')->unsigned()->nullable();
                $table->foreign('hotel_id', '234205_5c00f8d37d7ec')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::table('images_hotels', function(Blueprint $table) {
            if(Schema::hasColumn('images_hotels', 'img_id')) {
                $table->dropForeign('234205_5c00f8d36d185');
                $table->dropIndex('234205_5c00f8d36d185');
                $table->dropColumn('img_id');
            }
            if(Schema::hasColumn('images_hotels', 'hotel_id')) {
                $table->dropForeign('234205_5c00f8d37d7ec');
                $table->dropIndex('234205_5c00f8d37d7ec');
                $table->dropColumn('hotel_id');
            }
            
        });
    }
}
