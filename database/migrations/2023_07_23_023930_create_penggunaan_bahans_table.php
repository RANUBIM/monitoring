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
        Schema::create('penggunaan_bahans', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->unsignedBigInteger('penggunaan_id');
            $table->foreign('penggunaan_id')->references('id')->on('penggunaans')->onDelete('restrict');
            $table->unsignedBigInteger('bahan_id');
            $table->foreign('bahan_id')->references('id')->on('bahans')->onDelete('restrict');
            $table->integer('jumlah')->required();
            $table->integer('status')->default("0");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggunaan_bahans');
    }
};
