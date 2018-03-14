<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('references', function (Blueprint $table) {

            $table->increments('id');

            // 有些引用 是指向本站内的资源的 如文章 ; 每次更新、删除站内资源时，都需要更新这里
            // 这种情况，用postgres的继承是最好的，但laravel不支持
            $table->enum('model_type',['Article'])->nullable();
            $table->integer('model_id')->unsigned()->nullable();

            $table->string('title',150)->nullable();
            $table->string('intro',300)->nullable();

            $table->string('author')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            $table->integer('zc_id')->unsigned()->nullable(); // 如果作者是本站会员
            $table->string('origin')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            // mysql datatype to store month and year only http://stackoverflow.com/questions/9134497/mysql-datatype-to-store-month-and-year-only
            $table->date('date')->nullable(); //最初发表时间 一般是出版时间 若有更早的创作时间 则使用创作时间；若是时间段,使用起始时间
//            $table->boolean('show_date')->nullable(); // 是否除了 origin ，还显示单独的 date，用在 origin不包含时间信息的情况下
//            $table->string('tip')->nullable();
            $table->string('url')->nullable();

            $table->boolean('unuseful')->nullable();

            $table->enum('referenceable_type',['App\\\\Article','App\\\\Quote','App\\\\Person'])->nullable(); // 用在 Article 时，不是代表引用(文章的引用都是markdown内置)，而是代表推荐文章或链接
            $table->integer('referenceable_id')->unsigned()->nullable();
            // 目前order还包含“类型”信息
            // 规定：对于文章类型，小于100的，为“文章推荐”；大于100的，为相关链接
            $table->tinyInteger('order')->unsigned()->nullable();

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
        //
        Schema::drop('references');
    }
}
