<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAbsensiMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_absensi_mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim');
            $table->date('tanggal');
            $table->string('hari');
            $table->timestamp('jam_masuk');
            $table->string('status');
            $table->timestamps();
            $table->foreign('nim')
                  ->references('nim')->on('tbl_mahasiswa')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_absensi_mahasiswa');
    }
}
