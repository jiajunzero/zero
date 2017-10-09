<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_profession',function(Blueprint $table){
           $table->engine='InnoDB';
           $table->increments('id')->comment('主键ID');
           $table->unsignedInteger('member_id')->comment('会员ID');
           $table->unsignedInteger('profession_id')->comment('专业ID');
           $table->string('pro_name',200)->comment('专业名称');
           $table->timestamp('expire_start')->nullable()->comment('专业有效期 开始');
           $table->timestamp('expire_end')->nullable()->comment('专业有效期 结束');
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
        Schema::dropIfExists('member_profession');
    }
}
