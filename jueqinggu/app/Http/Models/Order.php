<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='order';
    protected $fillable=['price','status','order_number','pro_id','pro_name','member_id','pay_at','note'];

    //订单和会员的关系
    public function member(){
       return $this->belongsTo(\App\Http\Models\Member::class,'member_id','id');
    }

    //订单和专业的关系
    public function profession(){
        return $this->belongsTo(\App\Http\Models\Profession::class,'pro_id','id');
    }
}
