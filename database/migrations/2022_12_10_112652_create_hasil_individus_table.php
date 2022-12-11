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
        Schema::create('hasil_individus', function (Blueprint $table) {
            $table->increments('id_ai');
            $table->bigInteger('nisn');
            $table->string('sekolah');
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->integer('kelas');
            $table->char('kode_kategori', 3);
            $table->string('kode_pertanyaan');
            $table->integer('jumlah_ya');
            $table->integer('persentase_masalah');
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
        Schema::dropIfExists('hasil_individus');
    }
};
