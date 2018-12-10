<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe307e534RelationshipsToHallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('halls', function(Blueprint $table) {
            if (!Schema::hasColumn('halls', 'id_giorno_id')) {
                $table->integer('id_giorno_id')->unsigned()->nullable();
                $table->foreign('id_giorno_id', '234381_5c00f5665343f')->references('id')->on('days')->onDelete('cascade');
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
        Schema::table('halls', function(Blueprint $table) {
            if(Schema::hasColumn('halls', 'id_giorno_id')) {
                $table->dropForeign('234381_5c00f5665343f');
                $table->dropIndex('234381_5c00f5665343f');
                $table->dropColumn('id_giorno_id');
            }
            
        });
    }
}
