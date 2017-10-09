<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProfession extends Model
{
    protected $table='member_profession';
    protected $fillable=['member_id','profession_id','pro_name','expire_start','expire_end'];

    //订单和会员的关系
    public function member(){
        return $this->belongsTo(\App\Http\Models\Member::class,'member_id','id');
    }

    //订单和专业的关系
    public function profession(){
        return $this->belongsTo(\App\Http\Models\Profession::class,'pro_id','id');
    }
}
