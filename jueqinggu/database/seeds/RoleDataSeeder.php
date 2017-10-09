<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Role;
class RoleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Role $role)
    {
        $role->truncate();
        $role->insert([
           ['role_name'=>'超级管理员','note'=>'拥有至高无上的权利'],
           ['role_name'=>'总编','note'=>'具有添加、审核、发布、删除内容的权限'],
           ['role_name'=>'栏目主辑	','note'=>'只对所在栏目具有添加、审核、发布、删除内容的权限'],
           ['role_name'=>'栏目主辑','note'=>'只对所在栏目具有添加、审核、发布、删除内容的权限'],
           ['role_name'=>'栏目编辑','note'=>'只对所在栏目具有添加、删除草稿等权利'],
        ]);
    }
}
