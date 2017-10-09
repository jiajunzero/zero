<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_stream',function(Blueprint $table){
           $table->engine='innoDB';
           $table->increments('id');
           $table->string('stream_name',150)->unique()->comment('直播流名称');
           $table->unsignedTinyInteger('status')->default(1)->comment('禁播状态 1正常 2永久禁播 3显示禁播');
           $table->timestamp('expired_at')->nullable()->comment('禁播时间');
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
        Schema::dropIfExists('live_stream');
    }
}
