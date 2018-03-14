<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body',3000);
            $table->string('md',3000)->nullable();
            $table->string('codes',100)->nullable();
            $table->string('origin',300)->nullable();
            $table->boolean('spoiler')->default(true);
            $table->enum('quoteable_type',['App\\\\Video','App\\\\Book']);
            $table->integer('quoteable_id')->unsigned();

            $table->index(['quoteable_type','quoteable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_quotes');
    }
}
