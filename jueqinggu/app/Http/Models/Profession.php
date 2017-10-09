<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class profession extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='profession';
    protected $primaryKey='id';
    protected $fillable=['cate_id','pro_name','teacher_ids','pro_desc','click','duration','cover_img','banner_img','is_recommend','is_best','is_hot','expired_at','sort','price','market_price','detail','note','disabled_at'];
    protected $casts=[
        'banner_img'=>'array'
    ];

    function professionCate(){  //与专业分类关系
        return  $this->belongsTo(\App\Http\Models\ProfessionCate::class,'cate_id','id');
    }
//
    function course(){
        return  $this->belongsTo(\App\Http\Models\Course::class,'pro_id','id');

    }
}
