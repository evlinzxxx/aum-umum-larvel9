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
        Schema::create('gurus', function (Blueprint $table) {
            $table->string('sekolah');
            $table->bigInteger('nip')->primary()->unique();
            $table->string('nama');
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
        Schema::dropIfExists('gurus');
    }
};
