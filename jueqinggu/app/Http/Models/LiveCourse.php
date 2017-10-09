<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class LiveCourse extends Model
{


    protected $table='live_course';
    protected $fillable=['course_name','stream_id','pro_id','teacher_id','cover_img','start_at','end_at','sort','note'];

    //直播课程和专业的关系 多对一
    public function profession(){
        return $this->belongsTo(\App\Http\Models\Profession::class,'pro_id','id');
    }

    //直播课程和直播流的关系 多对一
    public function stream(){
        return $this->belongsTo(\App\Http\Models\LiveStream::class,'stream_id','id');
    }

    //直播课程和老师的关系 多对一
    public function member(){
        return $this->belongsTo(\App\Http\Models\Member::class,'teacher_id','id');
    }
}
