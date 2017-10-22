<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToTblJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_jadwal', function(Blueprint $table){
            $table->foreign('matakuliah')->references('kode')->on('tbl_matakuliah')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ruangan')->references('kode')->on('tbl_ruangan')->onDelete('cascade')->onUpdate('cascade');
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_jadwal', function(Blueprint $table){
            $table->dropForeign('tbl_jadwal_matakuliah_foreign');
            $table->dropForeign('tbl_jadwal_ruangan_foreign');
        });   
    }
}
