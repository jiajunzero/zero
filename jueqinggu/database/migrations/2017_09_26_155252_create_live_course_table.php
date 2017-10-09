<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_course',function(Blueprint $table){
            $table->engine = "innoDB";
            $table->increments('id')->comment( '自增ID');
            $table->string('course_name',100)->comment( '直播课程名称');
            $table->unsignedInteger('stream_id')->comment( '直播流ID');
            $table->unsignedInteger('pro_id')->nullable()->commnet('专业ID');
            $table->unsignedInteger('teacher_id')->nullable()->comment('直播老师ID');
            $table->string('cover_img',255)->nullable()->comment( '课程封面图');
            $table->timestamp('start_at')->nullable()->comment('直播开始时间');
            $table->timestamp('end_at')->nullable()->comment('直播结束时间');
            $table->text('note')->nullable()->comment('直播课程简介');
            $table->unsignedInteger('sort')->nullable()->commnet('排序');
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
        Schema::dropIfExists('live_course');
    }
}
