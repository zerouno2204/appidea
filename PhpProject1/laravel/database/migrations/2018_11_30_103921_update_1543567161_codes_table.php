<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567161CodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codes', function (Blueprint $table) {
            if(Schema::hasColumn('codes', 'id_congress')) {
                $table->dropColumn('id_congress');
            }
            if(Schema::hasColumn('codes', 'id_user')) {
                $table->dropColumn('id_user');
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
        Schema::table('codes', function (Blueprint $table) {
                        $table->integer('id_congress')->nullable();
                $table->integer('id_user')->nullable();
                
        });

    }
}
