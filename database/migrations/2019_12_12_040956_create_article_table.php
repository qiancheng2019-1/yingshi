<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("article_cate")->comment("文章分类id")->default('0');
            $table->string("title",60)->nullable()->comment("文章标题")->default();
            $table->longText("content")->nullable()->comment("文章内容")->nullable();
            $table->string("thumb",255)->nullable()->comment("文章缩略图")->default();
            $table->tinyInteger("status")->nullable()->comment("文章状态")->default('0');
            $table->integer("red")->comment("文章阅读")->default('0');
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
        Schema::dropIfExists('article');
    }
}
