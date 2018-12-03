<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00f7ca07c83RelationshipsToCongressEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congress_entries', function(Blueprint $table) {
            if (!Schema::hasColumn('congress_entries', 'id_congress_id')) {
                $table->integer('id_congress_id')->unsigned()->nullable();
                $table->foreign('id_congress_id', '234199_5c00f7c89e356')->references('id')->on('congresses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('congress_entries', 'id_entry_id')) {
                $table->integer('id_entry_id')->unsigned()->nullable();
                $table->foreign('id_entry_id', '234199_5c00f7c8aeba9')->references('id')->on('entries')->onDelete('cascade');
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
        Schema::table('congress_entries', function(Blueprint $table) {
            
        });
    }
}
