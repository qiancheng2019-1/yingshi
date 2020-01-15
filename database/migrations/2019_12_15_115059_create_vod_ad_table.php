<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVodAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vod_ad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('广告名称')->default();
            $table->string('desc')->nullable()->comment('广告描述')->default();
            $table->string('url')->nullable()->comment('广告路径')->default();
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
        Schema::dropIfExists('vod_ad');
    }
}
