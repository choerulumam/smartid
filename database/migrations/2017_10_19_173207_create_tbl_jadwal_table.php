<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblJadwalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_jadwal', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('hari');
			$table->string('matakuliah')->index('tbl_jadwal_matakuliah_foreign');
			$table->string('ruangan')->index('tbl_jadwal_ruangan_foreign');
			$table->time('jam_masuk');
			$table->time('jam_keluar');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_jadwal');
	}

}
