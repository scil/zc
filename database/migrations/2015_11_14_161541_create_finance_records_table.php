<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_records', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('title',255);
            $table->decimal('amount', 8, 2);
//            $table->morphs('another')->nullable(); // source or destination
            $table->string('another_type')->nullable();
            $table->integer('another_id')->unsigned()->nullable();
            $table->string('memo',5000);
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
        Schema::drop('finance_records');
    }
}
