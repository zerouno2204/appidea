<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543568938SpeakersCongressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers_congresses', function (Blueprint $table) {
            if(Schema::hasColumn('speakers_congresses', 'id_congress')) {
                $table->dropColumn('id_congress');
            }
            if(Schema::hasColumn('speakers_congresses', 'id_speaker')) {
                $table->dropColumn('id_speaker');
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
        Schema::table('speakers_congresses', function (Blueprint $table) {
                        $table->integer('id_congress')->nullable();
                $table->integer('id_speaker')->nullable();
                
        });

    }
}
