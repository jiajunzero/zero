<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //角色表
        Schema::create('role',function(Blueprint $table){
            $table->engine='InnoDB';
            $table->smallincrements('id')->comment('主键ID');
            $table->string('role_name',50)->unique()->comment('角色名称');
            $table->text('note')->nullable()->comment('角色描述');
            $table->text('role_auth_ids')->nullable()->comment('权限ID值');
            $table->text('role_auth_ac')->nullable()->comment('权限控制器名称和方法');
            $table->string('role_auth_addr',200)->nullable()->comment('菜单地址');
            $table->timestamps();
            $table->softDeletes();
        });

        // 管理员表
        Schema::create('admin',function(Blueprint $table){
            // 声明表结构
            $table->engine = 'InnoDB';
            $table->increments('id')->comment( '主键ID' );
            $table->unsignedSmallInteger('role_id')->comment( '角色ID' );
            $table->string('username',150)->unique()->comment( '登录帐号' );
            $table->string('nickname',150)->nullable()->comment( '昵称' );
            $table->string('password',255)->comment( '密码' );
            $table->string('avatar',255)->nullable()->comment( '头像' );
            $table->string('phone',15)->unique()->nullable()->comment( '手机' );
            $table->string('email',150)->unique()->nullable()->comment( '邮箱' );
            $table->unsignedTinyInteger('sex')->default(1)->comment( '性别(1:女,2:男)' );
            $table->text('note')->nullable()->comment('备注');
            $table->string('login_ip',50)->default('')->comment( '最后登录IP' );
            $table->unsignedInteger('login_number')->default(0)->comment( '登录次数' );
            $table->rememberToken()->comment('记住登录');
            $table->timestamp('disabled_at')->nullable()->comment('禁用时间');
            $table->timestamps();
            $table->softDeletes();
        });

        // 权限表
        Schema::create('auth',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('主键ID') ;
            $table->integer('auth_pid') ->default(0) ->comment('父级ID');
            $table->string('auth_name',50) ->comment('权限名称');
            $table->string('auth_action',50) ->nullable() ->comment('权限所属方法');
            $table->string('auth_controller',50) ->nullable() ->comment('权限所属控制器');
            $table->string('auth_address',100) ->nullable() ->comment('权限路由地址');
            $table->unsignedTinyInteger('is_menu')->default(0)->comment('是否作为左边的菜单显示');
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
        // 删除权限模块相关的数据表
        Schema::dropIfExists('role');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('auth');
    }
}
