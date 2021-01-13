<?php

namespace Database\Seeders;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FunctionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws FileNotFoundException
     */
	public function run()
	{
		DB::unprepared(File::get('database/functions/levenshtein.sql'));
		DB::unprepared(File::get('database/functions/levenshtein_ratio.sql'));
	}
}
