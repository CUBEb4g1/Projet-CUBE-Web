<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReadableNameColumnToPermissionTables extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('roles', function (Blueprint $table) {
			$table->string('readable_name')->after('name');
		});
		Schema::table('permissions', function (Blueprint $table) {
			$table->string('readable_name')->after('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('roles', function (Blueprint $table) {
			$table->dropColumn('readable_name');
		});
		Schema::table('permissions', function (Blueprint $table) {
			$table->dropColumn('readable_name');
		});
	}
}
