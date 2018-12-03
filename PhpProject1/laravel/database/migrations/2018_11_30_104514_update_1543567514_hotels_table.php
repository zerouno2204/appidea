<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567514HotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if(Schema::hasColumn('hotels', 'citta_id')) {
                $table->dropColumn('citta_id');
            }
            if(Schema::hasColumn('hotels', 'provincia_id')) {
                $table->dropColumn('provincia_id');
            }
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
                        $table->integer('citta_id')->nullable();
                $table->integer('provincia_id')->nullable();
                $table->text('descrizione')->nullable();
                
        });

    }
}
