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
        Schema::create('lembar_jawabans', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->string('nisn');
            $table->string('sekolah');
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->string('kelas');
            $table->char('kode_kategori', 3);
            $table->char('kode_pertanyaan', 3);
            $table->enum('jawaban', ['Ya', 'Tidak']);
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
        Schema::dropIfExists('lembar_jawabans');
    }
};
