<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->unsignedInteger('relation_id');
            $table->foreign('relation_id')->references('id')->on('relations');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedInteger('resource_type_id');
            $table->foreign('resource_type_id')->references('id')->on('resource_types');

            $table->boolean('validated')->default(false)->change();
            $table->boolean('deleted')->default(false)->change();
            $table->integer('views')->default('0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign('relation_id');
            $table->dropColumn('relation_id');
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
            $table->dropForeign('resource_type_id');
            $table->dropColumn('resource_type_id');
        });
    }
}
