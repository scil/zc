<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('quotes', function (Blueprint $table) {

            $table->increments('id');

            $table->string('title',50)->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->string('desc',200)->nullable();
            $table->string('body',3000);
            $table->string('md',3000)->nullable();
            $table->text('body_long')->nullable();
            $table->text('md_long')->nullable();
            // 目前附属于文章的内容不解析md 如果未来要解析　记得用行内解析　不生成<p>

            $table->string('author')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            $table->integer('author_id')->unsigned()->nullable();
            $table->string('origin')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            $table->date('origin_date')->nullable(); //最初发表时间 一般是出版时间 若有更早的创作时间 则使用创作时间；若是时间段,使用起始时间
            $table->boolean('show_date')->nullable(); // 是否除了 origin ，还显示单独的 date，用在 origin不包含时间信息的情况下
            $table->string('origin_url')->nullable();
            $table->string('origin_tip')->nullable();

            $table->string('copyright', 500)->nullable(); // 版权信息，如作者、出处等，文章正文后面就是版权信息


            $table->enum('quoteable_type',['App\\\\Article','App\\\\Column','App\\\\Book','App\\\\Video']);
            $table->integer('quoteable_id')->unsigned();
            $table->string('slug',50)->nullable();
            $table->integer('order')->unsigned()->nullable();
            // top 指放到文章最上头显示；
            // Book/Video:
            //  comment 是评论
            // suggestion 参考
            //  origin ? 用 BookQuote
            $table->enum('type',['top','tail','comment','spoiler_comment','suggestion'])->nullable();
            $table->unique(['quoteable_type','quoteable_id','slug']);


            $table->integer('editor_id')->unsigned();


            $table->integer('status')->unsigned()->default(1); // 0 not ready; 1 ok; 2 achive ; >2 archive,point to another article id
            $table->enum('deep',['open','member-list','deep-list','friend','member','deep']);
            $table->string('comment',900)->nullable(); // mysql里, varchar(300) 300不是指字节 而是指字符

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('quotes');
    }
}
