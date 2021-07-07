<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa',100);
            $table->string('nik',16);
            $table->string('jenis_kelamin',1);
            $table->text('alamat');
            $table->SmallInteger('umur');
            $table->SmallInteger('jarak_sekolah');
            $table->string('potensi_akademik',25);
            $table->integer('penghasilan_orang_tua');
            $table->text('foto_anak');
            $table->text('foto_kk');
            $table->text('akta_kelahiran');
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
}
