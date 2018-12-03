<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567304CongressEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('congress_entries', function (Blueprint $table) {
            if(Schema::hasColumn('congress_entries', 'id_congress')) {
                $table->dropColumn('id_congress');
            }
            if(Schema::hasColumn('congress_entries', 'id_entry')) {
                $table->dropColumn('id_entry');
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
        Schema::table('congress_entries', function (Blueprint $table) {
                        $table->integer('id_congress')->nullable();
                $table->integer('id_entry')->nullable();
                
        });

    }
}
