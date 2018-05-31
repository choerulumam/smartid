<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnImagesToMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_mahasiswa', function(Blueprint $table) {
            $table->string('images')->after('kelas');
        });
        Schema::table('tbl_dosen', function(Blueprint $table) {
            $table->string('images')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_mahasiswa', function(Blueprint $table) {
            $table->dropColumn('images');
        });

        Schema::table('tbl_dosen', function(Blueprint $table) {
            $table->dropColumn('images');
        });
    }
}
