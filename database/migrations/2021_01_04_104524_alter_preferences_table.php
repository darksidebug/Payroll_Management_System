<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(Schema::hasColumn('preferences','rate_per_hour'))
      {
        Schema::table('preferences', function (Blueprint $table) {
            
            $table->dropColumn('rate_per_hour');
            $table->double('rate_per_day')->unsigned()->after('max_ot');
        });
      }else{
        Schema::table('preferences', function (Blueprint $table) {
        
            $table->double('rate_per_day')->unsigned()->after('max_ot');
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
       
        if(Schema::hasColumn('preferences','rate_per_day'))
        {
            Schema::table('preferences', function (Blueprint $table) {
                $table->dropColumn('rate_per_day');
                
            });
        }else{
            Schema::table('preferences', function (Blueprint $table) {
                $table->double('rate_per_hour')->unsigned()->after('max_ot');
            });
        }
    }
}
