<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToTableMatakuliahMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('tbl_matakuliah_mahasiswa', function(Blueprint $table){
            $table->foreign('matakuliah')->references('kode')->on('tbl_matakuliah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('nim')->references('nim')->on('tbl_mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jadwal')->references('id')->on('tbl_jadwal')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('tbl_matakuliah_mahasiswa', function (Blueprint $table) {
            $table->dropForeign('tbl_matakuliah_mahasiswa_matakuliah_foreign');
            $table->dropForeign('tbl_matakuliah_mahasiswa_nim_foreign');
            $table->dropForeign('tbl_matakuliah_mahasiswa_jadwal_foreign');
        }); 
    }
}
