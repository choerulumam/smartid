<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblJadwalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_jadwal', function(Blueprint $table)
		{
			$table->foreign('matakuliah')->references('kode')->on('tbl_matakuliah')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ruangan')->references('kode')->on('tbl_ruangan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_jadwal', function(Blueprint $table)
		{
			$table->dropForeign('tbl_jadwal_matakuliah_foreign');
			$table->dropForeign('tbl_jadwal_ruangan_foreign');
		});
	}

}
