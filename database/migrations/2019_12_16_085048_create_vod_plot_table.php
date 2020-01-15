<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVodPlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vod_plot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('剧情分类名称')->default();
            $table->string('pid')->nullable()->comment('剧情分类pid')->default();
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
        Schema::dropIfExists('vod_plot');
    }
}
