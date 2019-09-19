<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFruitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fruits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->string('intro',500); // 用处：描述、作为相关信息时展示、文章列表时显示
            $table->string('tip',500); // 购买提示
            $table->mediumText('body');
            $table->mediumText('md');
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
        Schema::dropIfExists('fruits');
    }
}
