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
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('nisn')->primary()->unique();
            $table->string('sekolah');
            $table->string('nama');
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->string('kelas');
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('url_photo');
            $table->rememberToken();
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
        Schema::dropIfExists('siswas');
    }
};
