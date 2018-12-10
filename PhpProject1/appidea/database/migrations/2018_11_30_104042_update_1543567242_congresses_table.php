<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567242CongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congresses', function (Blueprint $table) {
            if(Schema::hasColumn('congresses', 'citta_sede_id')) {
                $table->dropColumn('citta_sede_id');
            }
            if(Schema::hasColumn('congresses', 'prov_sede_id')) {
                $table->dropColumn('prov_sede_id');
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
        Schema::table('congresses', function (Blueprint $table) {
                        $table->integer('citta_sede_id')->nullable();
                $table->integer('prov_sede_id')->nullable();
                
        });

    }
}
