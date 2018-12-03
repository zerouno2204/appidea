<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1543568871SpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers', function (Blueprint $table) {
            if(Schema::hasColumn('speakers', 'descrizione')) {
                $table->dropColumn('descrizione');
            }
            if(Schema::hasColumn('speakers', 'cv_name')) {
                $table->dropColumn('cv_name');
            }
            
        });
Schema::table('speakers', function (Blueprint $table) {
            
if (!Schema::hasColumn('speakers', 'descrizione')) {
                $table->text('descrizione')->nullable();
                }
if (!Schema::hasColumn('speakers', 'curriculuum')) {
                $table->string('curriculuum')->nullable();
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
        Schema::table('speakers', function (Blueprint $table) {
            $table->dropColumn('descrizione');
            $table->dropColumn('curriculuum');
            
        });
Schema::table('speakers', function (Blueprint $table) {
                        $table->string('descrizione')->nullable();
                $table->string('cv_name')->nullable();
                
        });

    }
}
