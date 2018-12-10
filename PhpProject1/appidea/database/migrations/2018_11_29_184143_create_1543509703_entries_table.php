<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1543509703EntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('entries')) {
            Schema::create('entries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome')->nullable();
                $table->date('data_inizio')->nullable();
                $table->date('data_fine')->nullable();
                $table->string('prezzo')->nullable();
                $table->string('descrizione')->nullable();
                $table->string('ab_codice')->nullable();
                
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
        Schema::dropIfExists('entries');
    }
}
