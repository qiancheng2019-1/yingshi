<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',100)->nullable()->comment('链接名称')->default();
            $table->string('desc',100)->nullable()->comment('链接描述')->default();
            $table->string('url',100)->nullable()->comment('链接')->default();
            $table->integer('sort')->comment('排序');
            $table->integer('status')->comment('状态');
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
        Schema::dropIfExists('friend');
    }
}
