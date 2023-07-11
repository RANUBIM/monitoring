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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("uuid")->unique();
            $table->integer("niknis")->unique();
            $table->string('password');
            $table->string('role');
            $table->string('nama');
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('mapel')->nullable();
            $table->string('kontak')->nullable();
            $table->rememberToken();
            $table->integer("created_by");
            $table->integer("updated_by")->nullable();
            $table->integer("deleted_by")->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
