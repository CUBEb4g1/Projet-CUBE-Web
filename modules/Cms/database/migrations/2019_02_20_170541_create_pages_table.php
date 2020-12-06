<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_tag')->nullable();
            $table->text('title');
            $table->text('slug');
			$table->text('meta_description')->nullable();
            $table->longText('html')->nullable();
            $table->longText('css')->nullable();
            $table->longText('gjs_components')->nullable();
            $table->longText('gjs_styles')->nullable();
            $table->boolean('online')->default(false);
			$table->text('data');
			$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
