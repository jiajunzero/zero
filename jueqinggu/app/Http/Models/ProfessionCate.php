<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class professionCate extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='professioncate';
    protected $primaryKey='id';
    protected $fillable=['cate_name','logo','sort'];


    function profession(){  //连接关联
        return  $this->hasMany(\App\Http\Models\Profession::class,'cate_id','id');
    }

}
