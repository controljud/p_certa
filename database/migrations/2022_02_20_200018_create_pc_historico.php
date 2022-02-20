<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_historico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipoPalavra');
            $table->unsignedBigInteger('idJogo');
            $table->unsignedBigInteger('idUser');
            $table->integer('colocacao');
            $table->timestamps();

            $table->foreign('idTipoPalavra')->references('id')->on('pc_tipo_palavra');
            $table->foreign('idJogo')->references('id')->on('pc_jogo');
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_historico');
    }
}
