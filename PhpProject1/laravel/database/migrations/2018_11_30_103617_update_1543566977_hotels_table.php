<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543566977HotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if(Schema::hasColumn('hotels', 'descrizione')) {
                $table->dropColumn('descrizione');
            }
            
        });
Schema::table('hotels', function (Blueprint $table) {
            
if (!Schema::hasColumn('hotels', 'descrizione')) {
                $table->text('descrizione')->nullable();
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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('descrizione');
            
        });
Schema::table('hotels', function (Blueprint $table) {
                        $table->string('descrizione')->nullable();
                
        });

    }
}
