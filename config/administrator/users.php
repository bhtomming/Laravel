<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\27 0027
 * Time: 9:03
 */
use App\Models\User;

return [
    'title' => '用户',

    //用户单数，用于新建用户
    'single' => '用户',

    'model' => User::class,

    //访问当前页面所需要的权限
    'permission' =>function(){
        return Auth::user()->can('manage_users');
    },

    //设置要显示出来的列
    'columns' => [
        'id',
        'avatar' => [
            'title' => '头像',
            'output' => function($avatar,$model){
                return empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" width="40" />';
            },
            'sortable' => false,
        ],
        'name' => [
            'title' => '用户名',
            'output' => function($name,$model){
                return '<a href="/users/'.$model->id.'" target="_blank" >'.$name.'</a>';
            },
            'sortable' => false,
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    //模型表单
    'edit_fields' => [
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
        'password' => [
            'title' => '密码',
            'type' => 'password',
        ],
        'avatar' => [
            'title' => '头像',
            'type' => 'image',
            'location' => public_path().'/upload/images/avatar/',
        ],
        'roles' => [
            'title' => '用户角色',
            'type' => 'relationship',
            'field_name' => 'name',
        ],
    ],

    //过滤数据
    'filters' => [
        'id' =>[
            'title' => '用户ID',
        ],
        'name' => [
            'title' => '用户名',
        ],
        'email' => [
            'title' => '邮箱',
        ],
    ],
];