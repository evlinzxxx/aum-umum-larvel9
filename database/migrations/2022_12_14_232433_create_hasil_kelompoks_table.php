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
        Schema::create('hasil_kelompoks', function (Blueprint $table) {
            $table->increments('id_ak');
            $table->string('sekolah');
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->string('kelas');
            $table->char('kode_kategori',3);
            $table->integer('jumlah_tertinggi');
            $table->integer('jumlah_terendah');
            $table->integer('jumlah_masalah');
            $table->double('rata_jumlah');
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
        Schema::dropIfExists('hasil_kelompoks');
    }
};
