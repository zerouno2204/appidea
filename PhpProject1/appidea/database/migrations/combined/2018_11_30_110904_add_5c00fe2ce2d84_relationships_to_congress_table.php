<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2ce2d84RelationshipsToCongressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congresses', function(Blueprint $table) {
            if (!Schema::hasColumn('congresses', 'id_citta_sede_id')) {
                $table->integer('id_citta_sede_id')->unsigned()->nullable();
                $table->foreign('id_citta_sede_id', '234198_5c00f78aa65a1')->references('id')->on('cities')->onDelete('cascade');
                }
                if (!Schema::hasColumn('congresses', 'id_prov_sede_id')) {
                $table->integer('id_prov_sede_id')->unsigned()->nullable();
                $table->foreign('id_prov_sede_id', '234198_5c00f78ab8a77')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::table('congresses', function(Blueprint $table) {
            if(Schema::hasColumn('congresses', 'id_citta_sede_id')) {
                $table->dropForeign('234198_5c00f78aa65a1');
                $table->dropIndex('234198_5c00f78aa65a1');
                $table->dropColumn('id_citta_sede_id');
            }
            if(Schema::hasColumn('congresses', 'id_prov_sede_id')) {
                $table->dropForeign('234198_5c00f78ab8a77');
                $table->dropIndex('234198_5c00f78ab8a77');
                $table->dropColumn('id_prov_sede_id');
            }
            
        });
    }
}
