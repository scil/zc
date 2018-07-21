<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceablesTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placeables', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('place_id')->unsigned();

            $table->enum('placeable_type',['App\\\\Experience','App\\\\Article','App\\\\Quote','App\\\\Book','App\\\\Video','App\\\\Tree'])->nullable(); // 用在 Article 时，不是代表引用(文章的引用都是markdown内置)，而是代表推荐文章或链接
            $table->integer('placeable_id')->unsigned();

            $table->string('place_name')->nullable();  // 自定义地点的显示名字
            $table->string('title',100)->nullable(); // markdown
            $table->string('intro',800)->nullable(); // markdown
            $table->boolean('relation')->default(true); // 是否和内容严格相关
            // 'open': 打开道路
            $table->enum('fromto',['from','to','open'])->nullable();


            $table->enum('deep',['open','friend','member','deep'])->nullable();

            // list 出现在列表上
            $table->enum('type',['list','normal'])->nullable();
            $table->tinyInteger('order')->unsigned()->nullable();

//            $table->string('point_to')->nullable(); // 如果地点只是个指针，譬如一个河流，用来代表所在城市,那么就显示城市的名字 // 约定：如果一个经历有多个地点，且其中一个为pointer，则这个地点为虚拟地点，大图中显示这个地点而不显示其它的；小图中不显示这个虚拟的而是显示其它地点

            $table->string('comment')->nullable(); // 备注， 如昆明二十二中的历史
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('placeables');
    }
}
