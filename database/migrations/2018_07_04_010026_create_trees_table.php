<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug', 100)->unique()->nullable();
            $table->string('name', 50);
            $table->boolean('profit')->default(false);
            $table->string('master', 150)->nullable();
            $table->integer('master_id')->unsigned()->nullable();
            $table->string('desc', 200)->nullable();
            $table->string('body', 3000)->nullable(); // markdown
            $table->mediumText('md');
            $table->string('contact', 1000)->nullable(); // markdown
            $table->string('buy', 1000)->nullable(); // markdown

            $table->integer('editor_id')->unsigned()->default(1); // 编辑是谁
            $table->integer('menu_item_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();

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
        Schema::dropIfExists('trees');
    }
}
