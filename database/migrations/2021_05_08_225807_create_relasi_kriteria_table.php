<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelasiKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relasi_kriteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->string('umur',6);
            $table->string('jarak_sekolah',6);
            $table->string('potensi_akademik',6);
            $table->string('penghasilan_orang_tua',6);
        });

        Schema::table('relasi_kriteria', function (Blueprint $table) {
            $table->foreign('id_siswa')->references('id')->on('siswas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relasi_kriteria');
    }
}
