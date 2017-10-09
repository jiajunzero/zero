<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order',function(Blueprint $table){
           $table->engine='InnoDB';
           $table->increments('id')->comment('主键ID');
           $table->decimal('price',9,2)->default(0.00)->comment('价格');
           $table->unsignedBigInteger('status')->default(0)->comment('订单状态');
           $table->string('order_number',150)->unique()->comment('订单号');
           $table->unsignedInteger('pro_id')->comment('专业的ID');
           $table->string('pro_name',200)->comment('专业的名称');
           $table->unsignedInteger('member_id')->comment('会员的ID');
           $table->timestamp('pay_at')->nullable()->comment('支付时间');
           $table->text('note')->nullable()->comment('备注');
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
        Schema::dropIfExists('order');
    }
}
