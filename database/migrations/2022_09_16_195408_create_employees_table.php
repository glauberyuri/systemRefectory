<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->increments('id_employee');
            $table->string('employee_name', 200);
            $table->string('employee_sector', 200);
            $table->integer('employee_status')->default('0');
            $table->string('employee_email', 200);
            $table->string('employee_code', 200);
            $table->integer('is_doctor')->default('0');

            $table->timestamps();
            $table->softDeletes();

        });
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
};
