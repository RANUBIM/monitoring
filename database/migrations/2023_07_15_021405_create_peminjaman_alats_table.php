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
        Schema::create('peminjaman_alats', function (Blueprint $table) {
            $table->unsignedBigInteger('peminjaman_id');
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onDelete('restrict');
            $table->unsignedBigInteger('alat_id');
            $table->foreign('alat_id')->references('id')->on('alats')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_alat');
    }
};
