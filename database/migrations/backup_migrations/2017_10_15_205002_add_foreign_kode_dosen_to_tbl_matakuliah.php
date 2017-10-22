<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKodeDosenToTblMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_matakuliah', function(Blueprint $table){
            $table->string('kode_dosen')->after('name');
            $table->foreign('kode_dosen')->references('kode_dosen')->on('tbl_dosen')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_matakuliah', function (Blueprint $table) {
            $table->dropForeign('kode_dosen');
            $table->dropColumn('kode_dosen');
        });
    }
}
