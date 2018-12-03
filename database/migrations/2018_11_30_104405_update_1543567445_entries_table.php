<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543567445EntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entries', function (Blueprint $table) {
            if(Schema::hasColumn('entries', 'descrizione')) {
                $table->dropColumn('descrizione');
            }
            
        });
Schema::table('entries', function (Blueprint $table) {
            
if (!Schema::hasColumn('entries', 'descrizione')) {
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
        Schema::table('entries', function (Blueprint $table) {
            $table->dropColumn('descrizione');
            
        });
Schema::table('entries', function (Blueprint $table) {
                        $table->string('descrizione')->nullable();
                
        });

    }
}
