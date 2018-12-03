<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543566738DaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('days', function (Blueprint $table) {
            if(Schema::hasColumn('days', 'capienza')) {
                $table->dropColumn('capienza');
            }
            if(Schema::hasColumn('days', 'planimetria')) {
                $table->dropColumn('planimetria');
            }
            
        });
Schema::table('days', function (Blueprint $table) {
            
if (!Schema::hasColumn('days', 'data')) {
                $table->string('data')->nullable();
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
        Schema::table('days', function (Blueprint $table) {
            $table->dropColumn('data');
            
        });
Schema::table('days', function (Blueprint $table) {
                        $table->string('capienza')->nullable();
                
        });

    }
}
