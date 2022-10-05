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
        Schema::create('requests', function (Blueprint $table) {
           
            $table->increments('id_request');
            $table->float('request_value');
            $table->datetime('request_date');
            $table->integer('request_status');
            $table->integer('is_dinner');


            //adicionar o relacionamento com a tabela funcionarios
            $table->integer('id_employee')->unsigned()->nullable();
            $table->foreign('id_employee')->references('id_employee')->on('employees');


            //adicionar o relacionamento com a tabela tipos
            $table->integer('id_type')->unsigned()->nullable();
            $table->foreign('id_type')->references('id_type')->on('types');

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
        Schema::dropIfExists('requests');
    }
};
