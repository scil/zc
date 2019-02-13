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
            $table->tinyIncrements('id');
            $table->smallInteger('menu_id')->unsigned()->default(1);
            $table->boolean('show')->default(true);
            $table->string('css')->nullable();
            // box: parent column
            $table->enum('type',['box','quote','article',])->nullable();
            $table->tinyInteger('level')->unsigned();
            $table->tinyInteger('order')->unsigned();
            $table->smallInteger('pid')->nullable();
            $table->string('url',50)->unique()->nullable();
            $table->string('pic',50)->nullable();
        });

		Schema::create('menu_item_translations', function(Blueprint $table)
		{
			$table->tinyIncrements('id');
            $table->string('locale')->index();

            $table->string('name',16);
            $table->string('short_name',15)->nullable();

            $table->string('title',50)->nullable();
            // used for simple title of items, e.g. a book in /books
            $table->string('ctitle',50)->nullable();
            $table->string('desc',200)->nullable();

            $table->integer('column_id')->unsigned();
            $table->unique(['column_id','locale']);
            //todo
//            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
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
        Schema::drop('menu_item_translations');

	}

}
