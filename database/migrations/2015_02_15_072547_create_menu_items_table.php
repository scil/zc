<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->smallInteger('menu_id')->unsigned()->default(1);
            $table->string('name',15);
            $table->string('short_name',15)->nullable();
            $table->boolean('show')->default(true);
            $table->string('css')->nullable();
            // box: parent column
            // mix: quote & article
            $table->enum('type',['box','quote','article','mix'])->nullable();
            $table->tinyInteger('level')->unsigned();
            $table->tinyInteger('order')->unsigned();
            $table->smallInteger('pid')->nullable();
            $table->string('url',50)->unique();
            $table->string('title',50)->nullable();
            $table->string('ctitle',50)->nullable();
            $table->string('desc',200)->nullable();
            $table->string('pic',50)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_items');
	}

}
