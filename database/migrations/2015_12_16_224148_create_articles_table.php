<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug',70)->nullable();


            $table->bigInteger('image_id')->unsigned()->nullable();

            // todo 如果以后需要表示月、日，那可把类型改为小数 如92.0321 sig仍然只针对年数
            $table->bigInteger('year')->nullable();
            // 有效数字，但 -1表示: extact
            $table->tinyInteger('sig')->default(-1);

            $table->string('author')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->string('origin')->nullable(); //来源，注意这是给读者看的，如果没用的(如没多大用的作者信息)就不需要显示在这里，显示在tip
            $table->date('origin_date')->nullable(); //最初发表时间 一般是出版时间 若有更早的创作时间 则使用创作时间；若是时间段,使用起始时间
            $table->boolean('show_date')->nullable(); // 是否除了 origin ，还显示单独的 date，用在 origin不包含时间信息的情况下
            $table->string('origin_url')->nullable();
            $table->string('origin_tip')->nullable();


//            $table->integer('reference_id')->unsigned()->nullable();
            
            //
            /**
             * 0: article;
             * 1: show link ;  不显示全文，只显示摘要，全文要到原地址去
             * 2: quote;
             * 3: quote has long ;
             * 4: quote show link
             */
            $table->tinyInteger('short')->default(0);

            // 不独立成字段了，方便使用markdown
//            $table->string('preface',1000)->nullable();
//            $table->string('note', 500)->nullable();
            $table->string('copyright', 500)->nullable(); // 版权信息，如作者、出处等，文章正文后面就是版权信息

            // 对于已被存档的文章 是否把其与替代者的关系存到数据库里面呢？
            $table->bigInteger('status')->unsigned()->default(1); // 0 not ready; 1 ok; 2 achive ; >2 archive,point to another article id
            // list 对游客显示在列表上
            $table->enum('deep',['open','member-list','deep-list','friend','member','deep']);

            $table->string('comment',900)->nullable(); // mysql里, varchar(300) 300不是指字节 而是指字符


            $table->bigInteger('editor_id')->unsigned()->default(1); // 编辑是谁

            $table->bigInteger('volume_id')->unsigned()->nullable();

            $table->enum('articleable_type',[
                'App\\\\Article',  // this one is only for Quote
                'App\\\\Column',
                'App\\\\Video',
                'App\\\\Book']);
            $table->bigInteger('articleable_id')->unsigned();
            $table->tinyInteger('order')->unsigned()->default(0);
            $table->enum('type',[
                'first','normal',

                // dispute book or video 的争议
                // quote 书籍长篇文章的quote
                // script 视频的文字或剧本
                // select 评论选集
                // review 评论文
                'discuss',
                'quote','script',
                'select','review',


                // for Quote
                // top 指放到文章最上头显示；
                // Book/Video:
                //  comment 是评论
                // suggestion 参考
                //  origin ? 用 BookQuote
                'top', 'tail', 'comment',
                'spoiler_comment',
                'suggestion'

            ])->default('first')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['articleable_type','articleable_id','slug']);
            $table->index('slug');

        });
        Schema::create('article_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();

            $table->string('title',50)->nullable();
            $table->string('sub_title',50)->nullable();
            $table->string('desc',200)->nullable(); // <meta desc> or  show on map
            $table->string('intro',1500)->nullable(); // 用处：描述、作为相关信息时展示、文章列表时显示
            $table->string('intro_md',1500)->nullable();

            $table->bigInteger('article_id')->unsigned();
            $table->unique(['article_id', 'locale']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_translations');
        Schema::drop('articles');
    }
}
