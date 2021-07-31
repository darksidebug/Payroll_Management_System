<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimeinTimeoutColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('time_logs', 'time_in_am')) {
            Schema::table('time_logs',function(Blueprint $table){
                $table->dropColumn('time_in_am');
                $table->dropColumn('time_out_am');
                $table->dropColumn('time_in_pm');
                $table->dropColumn('time_out_pm');
            });
        }else{
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_in_am')->nullable()->after('id');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_out_am')->nullable()->after('time_in_am');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_in_pm')->nullable()->after('time_out_am');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_out_pm')->nullable()->after('time_in_pm');
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
        if (!Schema::hasColumn('time_logs', 'time_in_am')) {
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_in_am')->nullable()->after('id');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_out_am')->nullable()->after('time_in_am');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_in_pm')->nullable()->after('time_out_am');
            });
    
            Schema::table('time_logs',function(Blueprint $table){
                $table->time('time_out_pm')->nullable()->after('time_in_pm');
            });
        }else{
            Schema::table('time_logs',function(Blueprint $table){
                $table->dropColumn('time_in_am');
                $table->dropColumn('time_out_am');
                $table->dropColumn('time_in_pm');
                $table->dropColumn('time_out_pm');
            });
        }
    

       
    }
}
