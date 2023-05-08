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
        // criando a coluna em requests que vai receber a fk de setores
        Schema::table('requests', function(Blueprint $table){
            
            //inserir um registro de setor para estabelecer o relacionamento
            $sector = DB::table('sectors')->insertGetId([
                'sector_description' => 'TI'
            ]);

            $table->integer('id_sector')->default($sector)->unsigned()->nullable();
            $table->foreign('id_sector')->references('id_sector')->on('sectors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
