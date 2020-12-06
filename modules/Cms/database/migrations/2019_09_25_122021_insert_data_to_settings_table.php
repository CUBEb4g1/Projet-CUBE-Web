<?php

use App\Repositories\Facades\Settings;
use Illuminate\Database\Migrations\Migration;

class InsertDataToSettingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('settings')->insert([
			'name'   => 'cms_layout_editable',
			'value'  => '1',
			'type'   => 'boolean',
			'module' => 'cms',
		]);

		Settings::clearCache();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
