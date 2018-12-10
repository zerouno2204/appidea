<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567373CongressHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congress_hotels', function (Blueprint $table) {
            if(Schema::hasColumn('congress_hotels', 'id_hotel')) {
                $table->dropColumn('id_hotel');
            }
            if(Schema::hasColumn('congress_hotels', 'id_congress')) {
                $table->dropColumn('id_congress');
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
        Schema::table('congress_hotels', function (Blueprint $table) {
                        $table->integer('id_hotel')->nullable();
                $table->integer('id_congress')->nullable();
                
        });

    }
}
