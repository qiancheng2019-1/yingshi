<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vod', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('视频名称')->default();
            $table->string('alias')->nullable()->comment('别名')->default();
            $table->string('director')->nullable()->comment('导演')->default();
            $table->string('to_star')->nullable()->comment('主演')->default();
            $table->string('type')->nullable()->comment('类型')->default();
            $table->string('region')->nullable()->comment('地区')->default();
            $table->string('language')->nullable()->comment('语言')->default();
            $table->string('release_time')->nullable()->comment('上映时间')->default();
            $table->string('film_length')->nullable()->comment('片长')->default();
            $table->integer('broadcast')->nullable()->comment('总播放量')->default();
            $table->string('score')->nullable()->comment('总评分数')->default();
            $table->integer('count_score')->nullable()->comment('评分次数')->default();
            $table->string('thumb')->nullable()->comment('视频封面');
            $table->text('desc')->nullable()->comment('剧情介绍');
            $table->text('play_list')->nullable()->comment('播放地址');
            $table->string('ad')->nullable()->comment('广告地址')->default();
            $table->tinyInteger('status')->nullable()->comment('状态')->default('0');
            $table->tinyInteger('stop')->nullable()->comment('完结')->default('0');
            $table->integer('red')->nullable()->comment('播放量')->default('0');
            $table->tinyInteger('pid')->nullable()->comment('父集id')->default();
            $table->tinyInteger('pids')->nullable()->comment('父集ids')->default();
            $table->integer('vod_douban_id')->nullable()->comment('豆瓣id')->default();
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
        Schema::dropIfExists('vod');
    }
}
