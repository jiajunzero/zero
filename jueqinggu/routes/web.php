<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|    Route::match(['get,post'],'login','IndexController@login');
*/
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::match(['get','post'],'login','IndexController@login');
    Route::group(['middleware'=>'CheckAdminLogin'],function(){
        Route::any('/','IndexController@index');
        Route::get('logout','IndexController@logout');
        Route::get('welcome','IndexController@welcome');
        Route::post('role/ajax_list','RoleController@ajax_list');
        Route::post('admin/ajax_list','AdminController@ajax_list');
        Route::match(['get','post'],'admin_change_password','AdminController@change_password');
        Route::get('admin_show','AdminController@admin_show');
        Route::get('admin_stop','AdminController@admin_stop');
        Route::get('admin_start','AdminController@admin_start');
        Route::post('admin/upload/{path}','IndexController@upload');
        Route::post('del_upload','IndexController@del_upload');
        Route::post('auth/ajax_list','AuthController@ajax_list');
        Route::get('logout','IndexController@logout');
        Route::get('profession/select_teacher','ProfessionController@select_teacher');
        Route::get('live/select_teacher','LiveCourseController@select_teacher');
        Route::get('live/addr/{stream}','LiveCourseController@create_addr');
        Route::get('live/send/','LiveCourseController@send');

        Route::group(['middleware'=>'CheckAdminAuth'],function(){
            Route::resource('role','RoleController');
            Route::resource('admin','AdminController');
            Route::resource('auth','AuthController');
            Route::resource('member','MemberController');
            Route::resource('professioncate','ProfessionCateController');
            Route::resource('profession','ProfessionController');
            Route::resource('course','CourseController');
            Route::resource('lesson','LessonController');
            Route::resource('livestream','LiveStreamController');
            Route::resource('livecourse','LiveCourseController');
        });

        Route::post('member/ajax_list','MemberController@ajax_list');
        Route::post('professioncate/ajax_list','ProfessionCateController@ajax_list');
        Route::post('profession/ajax_list','ProfessionController@ajax_list');
        Route::post('course/ajax_list','CourseController@ajax_list');
        Route::post('lesson/ajax_list','lessonController@ajax_list');
        Route::post('livestream/ajax_list','LiveStreamController@ajax_list');
        Route::post('livecourse/ajax_list','LiveCourseController@ajax_list');


    });

});


Route::group(['namespace'=>'Home'],function() {
    Route::any('/','IndexController@index');
    Route::get('/profession/{profession}','IndexController@profession');
    Route::get('/order/{profession}/sure','IndexController@sure');

    Route::get('/order/{profession}/create','IndexController@create')->middleware('CheckMemberLogin');
    Route::get('/order/{order}/pay','IndexController@pay');
    Route::get('/order/{order}/wechatpay','IndexController@wechatpay');
    Route::get('/order/qrcode','IndexController@qrcode');
    Route::post('/order/notify','IndexController@notify');
    Route::get('/order/queryOrder','IndexController@queryOrder');
    Route::get('/member/loginRegister','MemberController@loginRegister');
    Route::get('/member','MemberController@index');
    Route::post('/member/login','MemberController@login');
    Route::post('/member/register','MemberController@register');
    Route::get('/member/logout','MemberController@logout');
    Route::post('/member/sendSMS','MemberController@sendSMS');
    Route::post('/member/find','MemberController@find');
    Route::get('/live/{livecourse}','IndexController@live');

});



