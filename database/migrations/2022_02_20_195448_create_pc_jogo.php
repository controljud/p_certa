<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcJogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_jogo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPalavra');
            $table->datetime('data');
            $table->timestamps();

            $table->foreign('idPalavra')->references('id')->on('pc_palavra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_jogo');
    }
}
