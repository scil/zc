<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tree_id')->unsigned(); // 编辑是谁
            $table->boolean('buy')->default(false);
            $table->enum('type',['weibo','wechat','wechat-pub','zhihu','blog','zhaopin','email',
                'taobao','tmall','official','offline',
                'url',
                // 'other'
            ]);
            $table->string('name');
            $table->string('id1');
            $table->string('id2')->nullable();
            $table->string('intro')->nullable(); // markdown
            $table->tinyInteger('order',false,true)->default(0);
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->index(['buy','type','order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tree_contacts');
    }
}
