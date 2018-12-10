<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2e89520RelationshipsToRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function(Blueprint $table) {
            if (!Schema::hasColumn('registrations', 'id_entry_id')) {
                $table->integer('id_entry_id')->unsigned()->nullable();
                $table->foreign('id_entry_id', '234207_5c00fd44ef243')->references('id')->on('entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('registrations', 'id_congress_id')) {
                $table->integer('id_congress_id')->unsigned()->nullable();
                $table->foreign('id_congress_id', '234207_5c00fd450de1f')->references('id')->on('congresses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('registrations', 'id_speaker_id')) {
                $table->integer('id_speaker_id')->unsigned()->nullable();
                $table->foreign('id_speaker_id', '234207_5c00fd4523540')->references('id')->on('speakers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('registrations', 'id_hotel_id')) {
                $table->integer('id_hotel_id')->unsigned()->nullable();
                $table->foreign('id_hotel_id', '234207_5c00fd45385cc')->references('id')->on('hotels')->onDelete('cascade');
                }
                if (!Schema::hasColumn('registrations', 'id_user_id')) {
                $table->integer('id_user_id')->unsigned()->nullable();
                $table->foreign('id_user_id', '234207_5c00fd454b3cc')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('registrations', 'id_camera_id')) {
                $table->integer('id_camera_id')->unsigned()->nullable();
                $table->foreign('id_camera_id', '234207_5c00fd45628bf')->references('id')->on('rooms')->onDelete('cascade');
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
        Schema::table('registrations', function(Blueprint $table) {
            if(Schema::hasColumn('registrations', 'id_entry_id')) {
                $table->dropForeign('234207_5c00fd44ef243');
                $table->dropIndex('234207_5c00fd44ef243');
                $table->dropColumn('id_entry_id');
            }
            if(Schema::hasColumn('registrations', 'id_congress_id')) {
                $table->dropForeign('234207_5c00fd450de1f');
                $table->dropIndex('234207_5c00fd450de1f');
                $table->dropColumn('id_congress_id');
            }
            if(Schema::hasColumn('registrations', 'id_speaker_id')) {
                $table->dropForeign('234207_5c00fd4523540');
                $table->dropIndex('234207_5c00fd4523540');
                $table->dropColumn('id_speaker_id');
            }
            if(Schema::hasColumn('registrations', 'id_hotel_id')) {
                $table->dropForeign('234207_5c00fd45385cc');
                $table->dropIndex('234207_5c00fd45385cc');
                $table->dropColumn('id_hotel_id');
            }
            if(Schema::hasColumn('registrations', 'id_user_id')) {
                $table->dropForeign('234207_5c00fd454b3cc');
                $table->dropIndex('234207_5c00fd454b3cc');
                $table->dropColumn('id_user_id');
            }
            if(Schema::hasColumn('registrations', 'id_camera_id')) {
                $table->dropForeign('234207_5c00fd45628bf');
                $table->dropIndex('234207_5c00fd45628bf');
                $table->dropColumn('id_camera_id');
            }
            
        });
    }
}
