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
        Schema::create('bibliotecas_llibres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('llibre_id');
            $table->unsignedBigInteger('biblioteca_id');
            $table->timestamps();

            $table->foreign('llibre_id')
                  ->references('id')->on('llibres')
                  ->onDelete('cascade');

            $table->foreign('biblioteca_id')
                  ->references('id')->on('bibliotecas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibliotecas_llibres');
    }
};
