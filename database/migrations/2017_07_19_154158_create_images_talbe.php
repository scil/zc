<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            // local url
            $table->string('local')->nullable();
            $table->string('url')->nullable();
            // other urls
            $table->string('alter',1000)->nullable();
            $table->string('style')->nullable();
            $table->string('alt',100)->nullable();
            $table->string('title',100)->nullable();
            $table->string('intro',500)->nullable();
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
        Schema::dropIfExists('images');
    }
}
