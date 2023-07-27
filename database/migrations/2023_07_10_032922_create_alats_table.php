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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->unsignedBigInteger('labor_id')->required();
            $table->foreign('labor_id')->references('id')->on('labors')->onDelete('restrict');
            $table->string('nama')->required();
            $table->string('spesifikasi')->nullable();
            $table->integer('stok')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('dipinjam')->default('0');
            $table->string('keterangan')->nullable();
            $table->integer("created_by");
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alats');
    }
};
