<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->longText('address');
            $table->longText('contact_number',11);
            $table->time('time_in',0);
            $table->time('time_out',0);
            $table->unsignedInteger('break_mins');
            $table->string('password');
            $table->timestamps();
        });

        DB::update('ALTER TABLE employees AUTO_INCREMENT=1000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
