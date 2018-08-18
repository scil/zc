<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('volume_id')->unsigned()->nullable(); // 允许非vol的视频
            $table->enum('type',[
                'first',
                'normal',
            ])->default('first')->nullable();

            $table->boolean('version');
//            $table->integer('volumn_id')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable(); // for version
            $table->integer('book_id')->unsigned()->nullable(); // for version

            $table->integer('image_id')->unsigned()->nullable();
            $table->string('slug',100)->unique()->nullable();
            $table->string('name',50);
            $table->string('other_names',300)->nullable(); // 其它汉语名字,格式为: 钢锯岭\钢铁英雄(台)
            $table->string('native_name',100)->nullable();
            $table->string('english_name',60)->nullable(); // 如果原名即en 则空白
            $table->string('names',300)->nullable(); // 其它语言的名字,格式为: ja\\日语1\日语2;fr\\法语1

            $table->string('author',150)->nullable();
            $table->integer('author_id')->unsigned()->nullable();

            $table->string('time')->nullable();
            $table->date('date')->nullable();

            $table->string('intro',3000)->nullable(); // markdown
            $table->string('desc',200)->nullable();
            $table->integer('tip_id')->unsigned()->nullable(); // for version
            $table->integer('errata_id')->unsigned()->nullable(); // for version

            $table->enum('integrity',['-','?','✔','✖'])->nullable();

            $table->boolean('ebook')->nullable();

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
        Schema::drop('books');
    }
}
