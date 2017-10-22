<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblMatakuliahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_matakuliah', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('kode')->unique();
			$table->string('name');
			$table->string('kode_dosen')->index('tbl_matakuliah_kode_dosen_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_matakuliah');
	}

}
