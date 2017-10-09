<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//ajax选项卡功能显示专业信息
Route::middleware('throttle:60,1')->post('/profession', function (Request $request) {
    $pid= $request->input('pid');
    $profession=new \App\Http\Models\Profession;
    $member=new \App\Http\Models\Member;

    //分类id大于0表示单独的一个专业 0表示全部
    if($pid>0){
        $profession=$profession->where('cate_id',$pid);
    }

    $data=$profession->orderBy('sort','asc')->get();

    //查询老师的昵称  把老师的id集合转换成昵称
    $data->each(function($item,$key)use($member){
       if($item->teacher_ids){
           $teacher=explode(',',$item->teacher_ids);
           $item->teacher_ids=$member->select('nickname')->whereIn('id',$teacher)->get();
       }
    });

    return $data;

});

