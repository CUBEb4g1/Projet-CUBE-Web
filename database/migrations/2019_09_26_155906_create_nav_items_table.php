<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_menu_id')->unsigned()->nullable();
            $table->integer('nav_item_id')->unsigned()->nullable();
            $table->integer('page_id')->unsigned()->nullable();
            $table->text('text')->nullable();
            $table->text('url')->nullable();
            $table->boolean('blank')->default(false);
			$table->text('data');
            $table->smallInteger('position')->unsigned();
            $table->timestamps();

			$table->foreign('nav_menu_id')->references('id')->on('nav_menus')->onDelete('cascade');
			$table->foreign('nav_item_id')->references('id')->on('nav_items')->onDelete('cascade');
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nav_items');
    }
}
