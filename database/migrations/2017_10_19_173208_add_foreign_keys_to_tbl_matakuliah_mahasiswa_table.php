<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblMatakuliahMahasiswaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_matakuliah_mahasiswa', function(Blueprint $table)
		{
			$table->foreign('jadwal')->references('id')->on('tbl_jadwal')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('matakuliah')->references('kode')->on('tbl_matakuliah')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('nim')->references('nim')->on('tbl_mahasiswa')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_matakuliah_mahasiswa', function(Blueprint $table)
		{
			$table->dropForeign('tbl_matakuliah_mahasiswa_jadwal_foreign');
			$table->dropForeign('tbl_matakuliah_mahasiswa_matakuliah_foreign');
			$table->dropForeign('tbl_matakuliah_mahasiswa_nim_foreign');
		});
	}

}
