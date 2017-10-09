<?php

namespace App\Http\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class Member extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table='member';
    protected $primaryKey='id';
    protected $fillable=['type_id', 'username', 'nickname', 'password', 'money','avatar', 'phone', 'email', 'sex', 'note', 'sort','education','job','login_ip', 'login_number', 'disabled_at','remember_token'];
//

}


