<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblMatakuliahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_matakuliah', function(Blueprint $table)
		{
			$table->foreign('kode_dosen')->references('kode_dosen')->on('tbl_dosen')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_matakuliah', function(Blueprint $table)
		{
			$table->dropForeign('tbl_matakuliah_kode_dosen_foreign');
		});
	}

}
