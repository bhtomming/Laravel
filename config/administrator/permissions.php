<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\27 0027
 * Time: 10:52
 */

use Spatie\Permission\Models\Permission;

return [
    'title' => '权限管理',
    'single' => '权限',
    'model' => Permission::class,

    'permission' => function(){
        return Auth::user()->can('manage_users');
    },

    //对CRUD动作分别进行权限管理
    'action_permissions' => [
        'create' => function($model){
            return true;
        },
        'update' => function($model){
            return true;
        },
        'delete' => function($model){
            return false;
        },
        'view' => function($model){
            return true;
        }
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '权限名称',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '名称(请慎修改)',

            //提示信息
            'hint' => '修改权限名称会影响网站代码调用，请慎重~!',
        ],
        'roles' => [
            'type' => 'relationship',
            'title' =>'角色',
            'name_field' => 'name',
        ],
    ],

    'filters' => [
        'name' => [
            'title' => '名称',
        ],
    ],


];