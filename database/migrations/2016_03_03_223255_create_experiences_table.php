<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('intro'); // 
            $table->string('title')->nullable(); // 和'intro'类似，但title更有“画龙点睛”的标题作用，而'intro'则简朴，只是客观描述
            $table->string('body',3000);

            $table->string('date')->nullable(); //时间字符串
            // 两个时间只作依时间排序之用 其精确性不一定真实
            $table->date('start_date');
            $table->enum('start_date_level',['y','m','d','yy','mm','dd'])->nullable();
            $table->date('end_date');
            $table->enum('end_date_level',['y','m','d','yy','mm','dd'])->nullable();

            $table->smallInteger('pid')->nullable()->default(null);
            $table->boolean('virtual_group')->default(false); // 虚拟，没有其它实质信息，只是个地理位置，下狭其它子地点; 方便在地图上显示；在显示子地点时，则隐藏虚拟地点;  其实不是只能用在地理分组，还可用做其它分组，如某个大事件涉及的经历都可归在一个组里。这意味着，一个经历，可属于多个虚拟组。
            // 规定：在persons/person类型中，一个地点只能出现一次，方便map上的展示
            $table->enum('display',['persons','person','normal'])->default('normal');


            $table->bigInteger('person_id')->unsigned();
            $table->string('comment',500)->nullable();
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
        Schema::drop('experiences');
    }
}
