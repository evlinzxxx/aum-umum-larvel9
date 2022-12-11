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
        Schema::table('lembar_jawabans', function (Blueprint $table) {
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sekolah')->references('sekolah')->on('sekolahs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tingkatan')->references('tingkatan')->on('tingkatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jurusan')->references('jurusan')->on('jurusans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kelas')->references('kelas')->on('kelases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_kategori')->references('kode_kategori')->on('kategori_masalahs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kode_pertanyaan')->references('kode_pertanyaan')->on('pertanyaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lembar_jawabans', function (Blueprint $table) {
            $table->dropColumn('nisn');
            $table->dropColumn('sekolah');
            $table->dropColumn('tinngkatan');
            $table->dropColumn('jurusan');
            $table->dropColumn('kelas');
            $table->dropColumn('kode_kategori');
            $table->dropColumn('kode_pertanyaan');
        });
    }
};
