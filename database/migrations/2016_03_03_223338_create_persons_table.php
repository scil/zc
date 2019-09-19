<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('persons',function(Blueprint $table){

            $table->bigIncrements('id');

           $table->string('name'); // "标准"名字，中国人用汉语，其它用英语
            $table->date('birthday');
            $table->enum('birthday_level',['y','m','d','yy','mm','dd'])->default('dd');
            $table->date('deathday')->nullable();
            $table->enum('deathday_level',['y','m','d','yy','mm','dd'])->nullable();

            $table->string('family',1000);
            $table->bigInteger('place_id')->unsigned();
            $table->string('place_intro')->nullable();

            $table->string('missing',1000)->nullable();
            $table->string('comment',1000)->nullable();
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
        Schema::drop('persons');
    }
}
