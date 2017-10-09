<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member',function(Blueprint $table){
            $table->engine='InnoDB';
            $table->increments('id')->comment( '主键ID' );
            $table->unsignedTinyInteger('type_id')->default(1)->comment('会员类型(1：学生,2:老师)');
            $table->string('username',150)->unique()->comment( '登录帐号' );
            $table->string('nickname',150)->nullable()->comment( '昵称' );
            $table->decimal('money',11,2)->default('0.00')->comment( '账户余额' );
            $table->string('password',255)->comment( '密码' );
            $table->string('avatar',255)->nullable()->comment( '头像' );
            $table->string('phone',15)->unique()->nullable()->comment( '手机' );
            $table->string('email',150)->unique()->nullable()->comment( '邮箱' );
            $table->unsignedTinyInteger('sex')->default(1)->comment( '性别(1:女,2:男,3:保密)' );
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedTinyInteger('education')->default(null)->comment('学历');
            $table->string('job',50)->nullable()->comment('职业');
            $table->text('note')->nullable()->comment('备注');
            $table->string('login_ip',50)->default('')->comment( '最后登录IP' );
            $table->unsignedInteger('login_number')->default(0)->comment( '登录次数' );
            $table->rememberToken()->comment('记住登录');
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
        Schema::dropIfExists('member');
    }
}
