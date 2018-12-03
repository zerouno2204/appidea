<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2fae6feRelationshipsToSpeakersCongressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers_congresses', function(Blueprint $table) {
            if (!Schema::hasColumn('speakers_congresses', 'id_congress_id')) {
                $table->integer('id_congress_id')->unsigned()->nullable();
                $table->foreign('id_congress_id', '234210_5c00fe2a979f6')->references('id')->on('congresses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('speakers_congresses', 'id_speaker_id')) {
                $table->integer('id_speaker_id')->unsigned()->nullable();
                $table->foreign('id_speaker_id', '234210_5c00fe2aab142')->references('id')->on('speakers')->onDelete('cascade');
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
        Schema::table('speakers_congresses', function(Blueprint $table) {
            if(Schema::hasColumn('speakers_congresses', 'id_congress_id')) {
                $table->dropForeign('234210_5c00fe2a979f6');
                $table->dropIndex('234210_5c00fe2a979f6');
                $table->dropColumn('id_congress_id');
            }
            if(Schema::hasColumn('speakers_congresses', 'id_speaker_id')) {
                $table->dropForeign('234210_5c00fe2aab142');
                $table->dropIndex('234210_5c00fe2aab142');
                $table->dropColumn('id_speaker_id');
            }
            
        });
    }
}
