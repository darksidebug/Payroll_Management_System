<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTimeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_time_logs', function (Blueprint $table) {
            $table->id();
            $table->time('time_in_am',0)->nullable();
            $table->time('time_out_am',0)->nullable();
            $table->time('time_in_pm',0)->nullable();
            $table->time('time_out_pm',0)->nullable();
            $table->integer('mins_late')->nullable();
            $table->float('num_of_hours')->nullable();
            $table->float('num_of_ot')->nullable();
            $table->float('total_hours')->nullable();
            $table->bigInteger('employees_id')->unsigned();
            $table->foreign('employees_id','employees')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_time_logs');
    }
}
