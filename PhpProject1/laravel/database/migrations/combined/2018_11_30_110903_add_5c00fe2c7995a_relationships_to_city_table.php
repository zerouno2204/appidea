<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c00fe2c7995aRelationshipsToCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function(Blueprint $table) {
            if (!Schema::hasColumn('cities', 'province_id')) {
                $table->integer('province_id')->unsigned()->nullable();
                $table->foreign('province_id', '234196_5c0016ba3eae8')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::table('cities', function(Blueprint $table) {
            if(Schema::hasColumn('cities', 'province_id')) {
                $table->dropForeign('234196_5c0016ba3eae8');
                $table->dropIndex('234196_5c0016ba3eae8');
                $table->dropColumn('province_id');
            }
            
        });
    }
}
