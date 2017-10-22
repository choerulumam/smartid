<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblMahasiswaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_mahasiswa', function(Blueprint $table)
		{
			$table->foreign('kelas')->references('kode')->on('tbl_kelas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_mahasiswa', function(Blueprint $table)
		{
			$table->dropForeign('tbl_mahasiswa_kelas_foreign');
		});
	}

}
