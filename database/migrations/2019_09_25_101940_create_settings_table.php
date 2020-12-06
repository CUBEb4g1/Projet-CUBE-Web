<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
			$table->string('name', 64)->unique()->primary();
			$table->string('value', 255);
			$table->string('type', 16);
			$table->string('module')->nullable();
			$table->timestamp('updated_at')->useCurrent()->nullable();
		});

		DB::table('settings')->insert([
			'name'   => 'users_register',
			'value'  => '1',
			'type'   => 'boolean',
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('settings');
	}
}
