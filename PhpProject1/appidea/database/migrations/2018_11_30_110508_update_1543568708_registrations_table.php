<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543568708RegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            if(Schema::hasColumn('registrations', 'id_entry')) {
                $table->dropColumn('id_entry');
            }
            if(Schema::hasColumn('registrations', 'id_congress')) {
                $table->dropColumn('id_congress');
            }
            if(Schema::hasColumn('registrations', 'id_speaker')) {
                $table->dropColumn('id_speaker');
            }
            if(Schema::hasColumn('registrations', 'id_hotel')) {
                $table->dropColumn('id_hotel');
            }
            if(Schema::hasColumn('registrations', 'id_utente')) {
                $table->dropColumn('id_utente');
            }
            if(Schema::hasColumn('registrations', 'id_camera')) {
                $table->dropColumn('id_camera');
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
        Schema::table('registrations', function (Blueprint $table) {
                        $table->integer('id_entry')->nullable();
                $table->integer('id_congress')->nullable();
                $table->integer('id_speaker')->nullable();
                $table->integer('id_hotel')->nullable();
                $table->integer('id_utente')->nullable();
                $table->integer('id_camera')->nullable();
                
        });

    }
}
