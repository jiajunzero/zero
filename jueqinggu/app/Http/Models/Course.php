<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class Course extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='course';
    protected $fillable=['pro_id','course_name','course_desc','sort','note','content','disabled_at'];

    //课程和专业的关系 多对一
    public function profession(){
        return $this->belongsTo(\App\Http\Models\Profession::class,'pro_id','id');
    }

    //课程和课时的关系 一对多
    public function lesson(){
        return $this->hasMany(\App\Http\Models\Lesson::class,'course_id','id');
    }

}
