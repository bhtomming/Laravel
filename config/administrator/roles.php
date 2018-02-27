<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\27 0027
 * Time: 10:21
 */
use Spatie\Permission\Models\Role;

return [
    'title' => '用户角色',
    'single' => '角色',
    'model' => Role::class,

    'permission' => function(){
        return Auth::user()->can('manage_users');
    },

    'columns' => [
        'id' => [
            'title' => '角色ID',
        ],
        'name' => [
            'title' => '标识',
        ],
        'permissions' =>[
            'title' => '权限',
            'output' => function($value,$model){
                $model->load('permissions');
                $result = [];
                foreach ($model->permissions as $permission){
                    $result[] = $permission->name;
                }

                return empty($result) ? 'N/A' : implode($result,'|');
            },
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'output' => function($value,$model){
                return $value;
            },
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '标识',
        ],
        'permissions' => [
            'title' => '权限',
            'type' => 'relationship',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => '标识',
        ],
        'permissions' =>[
            'title' => '权限',
        ],
    ],

    //新建角色名称验证规则
    'rules' => [
        'name' => 'required|max:15|unique:roles,name',
    ],

    //表单验证错误提示
    'message' => [
        'name.required' => '角色名称不能为空',
        'name.max' => '角色名称长度不能超过15个字符',
        'name.unique' => '角色名称已经存在，请不要设置相同角色名称',
    ],
];