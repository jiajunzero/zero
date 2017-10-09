<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Auth;

class AuthDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Auth $auth)
    {
        $auth->truncate();

        // 顶级权限
        $auth->create(['id'=>1,'auth_pid'=>0,'auth_name'=>'管理员管理','is_menu'=>1]);
        $auth->create(['id'=>2,'auth_pid'=>0,'auth_name'=>'角色管理','is_menu'=>1]);
        $auth->create(['id'=>3,'auth_pid'=>0,'auth_name'=>'权限管理','is_menu'=>1]);
        $auth->create(['id'=>4,'auth_pid'=>0,'auth_name'=>'会员管理','is_menu'=>1]);

        $auth->create(['id'=>5,'auth_pid'=>0,'auth_name'=>'专业分类','is_menu'=>1]);
        $auth->create(['id'=>6,'auth_pid'=>0,'auth_name'=>'专业管理','is_menu'=>1]);
        $auth->create(['id'=>7,'auth_pid'=>0,'auth_name'=>'点播课程','is_menu'=>1]);
        $auth->create(['id'=>8,'auth_pid'=>0,'auth_name'=>'点播课时','is_menu'=>1]);
        $auth->create(['id'=>9,'auth_pid'=>0,'auth_name'=>'直播课程管理','is_menu'=>1]);
        $auth->create(['id'=>10,'auth_pid'=>0,'auth_name'=>'直播流管理','is_menu'=>1]);


        // 专业分类的子权限
        $auth->create(['auth_pid'=>5,'auth_name'=>'添加专业分类','auth_action'=>'create','auth_controller'=>'ProfessionCate','auth_address'=>'admin/professioncate/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>5,'auth_name'=>'保存专业分类','auth_action'=>'store','auth_controller'=>'ProfessionCate','auth_address'=>'']);
        $auth->create(['auth_pid'=>5,'auth_name'=>'编辑专业分类','auth_action'=>'edit','auth_controller'=>'ProfessionCate','auth_address'=>'']);
        $auth->create(['auth_pid'=>5,'auth_name'=>'更新专业分类','auth_action'=>'update','auth_controller'=>'ProfessionCate','auth_address'=>'']);
        $auth->create(['auth_pid'=>5,'auth_name'=>'删除专业分类','auth_action'=>'destory','auth_controller'=>'ProfessionCate','auth_address'=>'']);
        $auth->create(['auth_pid'=>5,'auth_name'=>'专业分类列表','auth_action'=>'index','auth_controller'=>'ProfessionCate','auth_address'=>'admin/professioncate','is_menu'=>1]);

        // 专业的子权限
        $auth->create(['auth_pid'=>6,'auth_name'=>'添加专业','auth_action'=>'create','auth_controller'=>'Profession','auth_address'=>'admin/profession/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>6,'auth_name'=>'保存专业','auth_action'=>'store','auth_controller'=>'Profession','auth_address'=>'']);
        $auth->create(['auth_pid'=>6,'auth_name'=>'编辑专业','auth_action'=>'edit','auth_controller'=>'Profession','auth_address'=>'']);
        $auth->create(['auth_pid'=>6,'auth_name'=>'更新专业','auth_action'=>'update','auth_controller'=>'Profession','auth_address'=>'']);
        $auth->create(['auth_pid'=>6,'auth_name'=>'删除专业','auth_action'=>'destory','auth_controller'=>'Profession','auth_address'=>'']);
        $auth->create(['auth_pid'=>6,'auth_name'=>'专业列表','auth_action'=>'index','auth_controller'=>'Profession','auth_address'=>'admin/profession','is_menu'=>1]);

        // 课程的子权限
        $auth->create(['auth_pid'=>7,'auth_name'=>'添加课程','auth_action'=>'create','auth_controller'=>'Course','auth_address'=>'admin/course/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>7,'auth_name'=>'保存课程','auth_action'=>'store','auth_controller'=>'Course','auth_address'=>'']);
        $auth->create(['auth_pid'=>7,'auth_name'=>'编辑课程','auth_action'=>'edit','auth_controller'=>'Course','auth_address'=>'']);
        $auth->create(['auth_pid'=>7,'auth_name'=>'更新课程','auth_action'=>'update','auth_controller'=>'Course','auth_address'=>'']);
        $auth->create(['auth_pid'=>7,'auth_name'=>'删除课程','auth_action'=>'destory','auth_controller'=>'Course','auth_address'=>'']);
        $auth->create(['auth_pid'=>7,'auth_name'=>'课程列表','auth_action'=>'index','auth_controller'=>'Course','auth_address'=>'admin/course','is_menu'=>1]);

        // 课时的子权限
        $auth->create(['auth_pid'=>8,'auth_name'=>'添加课时','auth_action'=>'create','auth_controller'=>'Lesson','auth_address'=>'admin/lesson/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>8,'auth_name'=>'保存课时','auth_action'=>'store','auth_controller'=>'Lesson','auth_address'=>'']);
        $auth->create(['auth_pid'=>8,'auth_name'=>'编辑课时','auth_action'=>'edit','auth_controller'=>'Lesson','auth_address'=>'']);
        $auth->create(['auth_pid'=>8,'auth_name'=>'更新课时','auth_action'=>'update','auth_controller'=>'Lesson','auth_address'=>'']);
        $auth->create(['auth_pid'=>8,'auth_name'=>'删除课时','auth_action'=>'destory','auth_controller'=>'Lesson','auth_address'=>'']);
        $auth->create(['auth_pid'=>8,'auth_name'=>'课时列表','auth_action'=>'index','auth_controller'=>'Lesson','auth_address'=>'admin/lesson','is_menu'=>1]);

        // 会员的子权限
        $auth->create(['auth_pid'=>4,'auth_name'=>'添加会员','auth_action'=>'create','auth_controller'=>'Member','auth_address'=>'admin/member/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>4,'auth_name'=>'保存会员','auth_action'=>'store','auth_controller'=>'Member','auth_address'=>'']);
        $auth->create(['auth_pid'=>4,'auth_name'=>'编辑会员','auth_action'=>'edit','auth_controller'=>'Member','auth_address'=>'']);
        $auth->create(['auth_pid'=>4,'auth_name'=>'更新会员','auth_action'=>'update','auth_controller'=>'Member','auth_address'=>'']);
        $auth->create(['auth_pid'=>4,'auth_name'=>'删除会员','auth_action'=>'destory','auth_controller'=>'Member','auth_address'=>'']);
        $auth->create(['auth_pid'=>4,'auth_name'=>'会员列表','auth_action'=>'index','auth_controller'=>'Member','auth_address'=>'admin/member','is_menu'=>1]);

        // 管理员的子权限
        $auth->create(['auth_pid'=>1,'auth_name'=>'添加管理员','auth_action'=>'create','auth_controller'=>'Admin','auth_address'=>'admin/admin/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>1,'auth_name'=>'保存管理员','auth_action'=>'store','auth_controller'=>'Admin','auth_address'=>'']);
        $auth->create(['auth_pid'=>1,'auth_name'=>'编辑管理员','auth_action'=>'edit','auth_controller'=>'Admin','auth_address'=>'']);
        $auth->create(['auth_pid'=>1,'auth_name'=>'更新管理员','auth_action'=>'update','auth_controller'=>'Admin','auth_address'=>'']);
        $auth->create(['auth_pid'=>1,'auth_name'=>'删除管理员','auth_action'=>'destory','auth_controller'=>'Admin','auth_address'=>'']);
        $auth->create(['auth_pid'=>1,'auth_name'=>'管理员列表','auth_action'=>'index','auth_controller'=>'Admin','auth_address'=>'admin/admin','is_menu'=>1]);

        // 角色的子权限
        $auth->create(['auth_pid'=>2,'auth_name'=>'添加角色','auth_action'=>'create','auth_controller'=>'Role','auth_address'=>'admin/role/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>2,'auth_name'=>'保存角色','auth_action'=>'store','auth_controller'=>'Role','auth_address'=>'']);
        $auth->create(['auth_pid'=>2,'auth_name'=>'编辑角色','auth_action'=>'edit','auth_controller'=>'Role','auth_address'=>'']);
        $auth->create(['auth_pid'=>2,'auth_name'=>'更新角色','auth_action'=>'update','auth_controller'=>'Role','auth_address'=>'']);
        $auth->create(['auth_pid'=>2,'auth_name'=>'删除角色','auth_action'=>'destory','auth_controller'=>'Role','auth_address'=>'']);
        $auth->create(['auth_pid'=>2,'auth_name'=>'角色列表','auth_action'=>'index','auth_controller'=>'Role','auth_address'=>'admin/role','is_menu'=>1]);

        // 权限的子权限
        $auth->create(['auth_pid'=>3,'auth_name'=>'添加权限','auth_action'=>'create','auth_controller'=>'Auth','auth_address'=>'admin/auth/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>3,'auth_name'=>'保存权限','auth_action'=>'store','auth_controller'=>'Auth','auth_address'=>'']);
        $auth->create(['auth_pid'=>3,'auth_name'=>'编辑权限','auth_action'=>'edit','auth_controller'=>'Auth','auth_address'=>'']);
        $auth->create(['auth_pid'=>3,'auth_name'=>'更新权限','auth_action'=>'update','auth_controller'=>'Auth','auth_address'=>'']);
        $auth->create(['auth_pid'=>3,'auth_name'=>'删除权限','auth_action'=>'destory','auth_controller'=>'Auth','auth_address'=>'']);
        $auth->create(['auth_pid'=>3,'auth_name'=>'权限列表','auth_action'=>'index','auth_controller'=>'Auth','auth_address'=>'admin/auth','is_menu'=>1]);

        // 直播流的子权限
        $auth->create(['auth_pid'=>10,'auth_name'=>'添加直播流','auth_action'=>'create','auth_controller'=>'LiveStream','auth_address'=>'admin/livestream/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>10,'auth_name'=>'保存直播流','auth_action'=>'store','auth_controller'=>'LiveStream','auth_address'=>'']);
        $auth->create(['auth_pid'=>10,'auth_name'=>'编辑直播流','auth_action'=>'edit','auth_controller'=>'LiveStream','auth_address'=>'']);
        $auth->create(['auth_pid'=>10,'auth_name'=>'更新直播流','auth_action'=>'update','auth_controller'=>'LiveStream','auth_address'=>'']);
        $auth->create(['auth_pid'=>10,'auth_name'=>'删除直播流','auth_action'=>'destory','auth_controller'=>'LiveStream','auth_address'=>'']);
        $auth->create(['auth_pid'=>10,'auth_name'=>'直播流列表','auth_action'=>'index','auth_controller'=>'LiveStream','auth_address'=>'admin/livestream','is_menu'=>1]);

        // 直播流的子权限
        $auth->create(['auth_pid'=>9,'auth_name'=>'添加直播课程','auth_action'=>'create','auth_controller'=>'LiveCourse','auth_address'=>'admin/liveCourse/create','is_menu'=>1]);
        $auth->create(['auth_pid'=>9,'auth_name'=>'保存直播课程','auth_action'=>'store','auth_controller'=>'LiveCourse','auth_address'=>'']);
        $auth->create(['auth_pid'=>9,'auth_name'=>'编辑直播课程','auth_action'=>'edit','auth_controller'=>'LiveCourse','auth_address'=>'']);
        $auth->create(['auth_pid'=>9,'auth_name'=>'更新直播课程','auth_action'=>'update','auth_controller'=>'LiveCourse','auth_address'=>'']);
        $auth->create(['auth_pid'=>9,'auth_name'=>'删除直播课程','auth_action'=>'destory','auth_controller'=>'LiveCourse','auth_address'=>'']);
        $auth->create(['auth_pid'=>9,'auth_name'=>'直播课程列表','auth_action'=>'index','auth_controller'=>'LiveCourse','auth_address'=>'admin/liveCourse','is_menu'=>1]);

    }
}
