<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblMatakuliahMahasiswaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_matakuliah_mahasiswa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nim')->index('tbl_matakuliah_mahasiswa_nim_foreign');
			$table->string('matakuliah')->index('tbl_matakuliah_mahasiswa_matakuliah_foreign');
			$table->integer('jadwal')->unsigned()->index('tbl_matakuliah_mahasiswa_jadwal_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_matakuliah_mahasiswa');
	}

}
