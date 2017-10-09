<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class Lesson extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='lesson';
    protected $fillable=['course_id','lesson_name','cover_img','video_address','lesson_desc','lesson_time','teacher','sort','note','disabled_at'];

    //课时和课程的关系 多对一
    public function course(){
        return $this->belongsTo(\App\Http\Models\Course::class,'course_id','id');
    }

}
