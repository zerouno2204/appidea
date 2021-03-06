<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00f73a9d5b6RelationshipsToCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codes', function(Blueprint $table) {
            if (!Schema::hasColumn('codes', 'id_congress_id')) {
                $table->integer('id_congress_id')->unsigned()->nullable();
                $table->foreign('id_congress_id', '234197_5c00f7392b2ac')->references('id')->on('congresses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('codes', 'id_user_id')) {
                $table->integer('id_user_id')->unsigned()->nullable();
                $table->foreign('id_user_id', '234197_5c00f7393f0f8')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('codes', function(Blueprint $table) {
            
        });
    }
}
