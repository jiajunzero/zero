<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='admin';
    protected $primaryKey='id';
    protected $fillable=['role_id', 'username', 'nickname', 'password', 'avatar', 'phone', 'email', 'sex', 'note', 'login_ip', 'login_number', 'disabled_at'];
//
    function role(){  //连接关联
       return  $this->belongsTo(\App\Http\Models\Role::class,'role_id','id');
    }




}
