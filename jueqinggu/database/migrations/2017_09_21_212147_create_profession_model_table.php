<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 专业分类表
        Schema::create('professioncate',function(Blueprint $table){
            // 声明表结构
            $table->engine = 'InnoDB';
            $table->increments('id')->comment( '主键ID' );
            $table->string('cate_name',50)->unique()->comment('分类名称');
            $table->text('logo')->nullable()->comment('专业logo');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });

        // 专业表
        Schema::create('profession',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment( '主键ID' );
            $table->unsignedInteger('cate_id')->comment( '分类ID' );
            $table->string('pro_name',150)->unique()->comment('专业名称');
            $table->text('teacher_ids')->nullable()->comment('任课老师的ids串，如 10,13,21');
            $table->text('pro_desc')->nullable()->comment('专业简介');
            $table->unsignedInteger('click')->default(0)->comment('点击量');
            $table->unsignedSmallInteger('duration')->default(0)->comment('课程总时长(单位：小时)');
            $table->string('cover_img',255)->nullable()->comment('封面图');
            $table->text('banner_img')->nullable()->comment('轮播图片,多图');
            $table->unsignedSmallInteger('is_recommend')->default(0)->comment('是否是推荐专业(0:不是,1:是)');
            $table->unsignedSmallInteger('is_best')->default(0)->comment('是否是优秀专业(0:不是,1:是)');
            $table->unsignedSmallInteger('is_hot')->default(0)->comment('是否是热门专业(0:不是,1:是)');
            $table->unsignedSmallInteger('expired_at')->default(0)->comment('有效期');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->decimal('price',9,2)->default('0.0')->comment('价格');
            $table->decimal('market_price',9,2)->default('0.0')->comment('市场价格');
            $table->text('detail')->nullable()->comment('课程详情');
            $table->text('note')->nullable()->comment('备注');
            $table->timestamp('disabled_at')->nullable()->comment('禁用时间');
            $table->timestamps();
            $table->softDeletes();
        });


        // 点播课程表
        Schema::create('course',function(Blueprint $table){
            $table->engine = "innoDB";
            $table->increments('id')->comment( '主键id');
            $table->unsignedInteger('pro_id')->comment('(归属)专业id');
            $table->string('course_name',128)->comment( '课程名称');
            $table->text('course_desc')->nullable()->comment( '课程描述');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->text('content')->nullable()->comment( '课程详情');
            $table->text('note')->nullable()->comment('备注');
            $table->timestamp('disabled_at')->nullable()->comment('禁用时间');
            $table->timestamps();
            $table->softDeletes();

        });

        // 点播课时表
        Schema::create('lesson',function(Blueprint $table){
            $table->engine = "innoDB";
            $table->increments('id')->comment( '主键id');
            $table->unsignedInteger('course_id')->comment( '(归属)课程id');
            $table->string('lesson_name',128)->comment( '课时名称');
            $table->string('cover_img',255)->nullable()->comment( '课时封面图');
            $table->string('video_address',255)->comment( '播放视频地址');
            $table->string('lesson_desc',255)->nullable()->comment( '视频描述');
            $table->unsignedInteger('lesson_time')->default(0)->comment( '视频分钟数');
            $table->string('teacher',255)->comment( '视频讲解老师');
            $table->text('note')->nullable()->comment('备注');
            $table->timestamp('disabled_at')->nullable()->comment('禁用时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professioncate');
        Schema::dropIfExists('profession');
        Schema::dropIfExists('course');
        Schema::dropIfExists('lesson');
    }
}
