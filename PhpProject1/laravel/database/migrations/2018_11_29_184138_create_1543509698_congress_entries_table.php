<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509698CongressEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('congress_entries')) {
            Schema::create('congress_entries', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_congress')->nullable();
                $table->integer('id_entry')->nullable();
                
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('congress_entries');
    }
}
