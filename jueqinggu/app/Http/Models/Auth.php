<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //软删除类

class Auth extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $table='auth';
    protected $primaryKey='id';
    protected $fillable=['auth_pid', 'auth_name', 'auth_action', 'auth_controller', 'auth_address', 'is_menu'];

    public function _getTree($data,$pid=0,$level=1){
        static $list=[];
        foreach($data as $k => $v ){
            if($v['auth_pid']==$pid){
                $v['level']=$level;
                $list[]=$v;
                $this->_getTree($data,$v['id'],$level+1);
            }
        }
        return $list;
    }

}
