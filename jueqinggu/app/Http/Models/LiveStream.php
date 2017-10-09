<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
     protected $table='live_stream';
    protected $fillable=['stream_name','status','expired_at'];

    //直播流和直播课程的关系 一对多
    public function live_course(){
        return $this->hasMany(\App\Http\Models\LiveCourse::class,'stream_id','id');
    }
}
