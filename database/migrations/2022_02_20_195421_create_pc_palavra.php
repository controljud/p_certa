<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcPalavra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_palavra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTipoPalavra');
            $table->string('palavra');
            $table->timestamps();

            $table->foreign('idTipoPalavra')->references('id')->on('pc_tipo_palavra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_palavra');
    }
}
