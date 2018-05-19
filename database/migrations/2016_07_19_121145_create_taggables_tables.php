<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggablesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->enum('taggable_type',['App\\\\Article',
//                'App\\\\Column',
                'App\\\\Quote','App\\\\Book','App\\\\Video']);
            $table->integer('taggable_id')->unsigned();
//            $table->string('intro')->nullable();
            $table->tinyInteger('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('taggables');
    }
}
