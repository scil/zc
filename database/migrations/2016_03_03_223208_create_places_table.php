<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('native_lang',10)->nullable();// fr, zh, en ..

//            $table->string('names',300)->nullable(); // 其它语言的名字,格式为: ja\\日语1\日语2;fr\\法语1

            $table->string('addr')->nullable(); // 短地址
            $table->string('address')->nullable();
            $table->float('lat',10,6);
            $table->float('lng',10,6);

            // 如果是旧地名 则这里指向现在地址的id ; 如果是指针性 这里储存lat lng 的真实地名的id
            $table->bigInteger('relate_id')->unsigned()->nullable();
            $table->enum('type',['old','point'])->nullable();

            $table->string('url')->nullable();

            $table->timestamps();

            $table->string('comment',1000)->nullable(); // 备注， 如昆明二十二中的历史
        });
        Schema::create('place_translations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('locale')->index();

            $table->string('name',60);
            $table->string('other_names',300)->nullable(); // 其它名字,格式为: 钢锯岭\钢铁英雄(台)
//            $table->string('english_name',60)->nullable(); // 若国外名字，则留下名字的英文名；地址只留英文名

            $table->bigInteger('place_id')->unsigned();
            $table->unique(['place_id', 'locale']);
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
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
        Schema::drop('place_translations');
        Schema::drop('places');
    }
}
