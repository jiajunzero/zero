<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class Role extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='role';
    protected $primaryKey='id';
    protected $fillable=['role_name','note','role_auth_ids','role_auth_ac','role_auth_addr'];


    protected $casts = [
        'role_auth_ac' => 'array',
        'role_auth_addr' => 'array',
        'role_auth_ids' => 'array',
    ];

    function admin(){  //连接关联 1 对 多 1个角色可对应多个管理员
       return  $this->hasMany(\App\Http\Models\Admin::class,'role_id','id');
    }

}
