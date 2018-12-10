<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567571ImagesHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images_hotels', function (Blueprint $table) {
            if(Schema::hasColumn('images_hotels', 'id_image')) {
                $table->dropColumn('id_image');
            }
            if(Schema::hasColumn('images_hotels', 'id_hotel')) {
                $table->dropColumn('id_hotel');
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
        Schema::table('images_hotels', function (Blueprint $table) {
                        $table->integer('id_image')->nullable();
                $table->integer('id_hotel')->nullable();
                
        });

    }
}
