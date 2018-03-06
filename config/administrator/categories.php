<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\27 0027
 * Time: 11:25
 */
use App\Models\Category;

return [
    'title' => '分类管理',
    'single' => '分类',
    'model' => Category::class,

    'action_permissions' => [
        'delete' => function(){
            //只有站长才能删除分类
            return Auth::user()->hasRole('Founder');
        },
    ],

    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title' => '类别',
            'sortable' => false,
        ],
        'description' => [
            'title' => '分类描述信息',
            'sortable' => false,
        ],
        'operations' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'name' => [
            'title' => '类别',
        ],
        'description' => [
            'title' => '分类描述',
            'type' => 'textarea',
        ],
    ],

    'filters' => [
        'id' => [
            'title'=>'分类ID',
        ],
        'name' => [
            'title' => '分类名称',
        ],
    ],

    'rules' => [
        'name' => 'required|mix:1|unique:categories,name',
    ],

    'messages' => [
        'name.required' => '分类名称不能为空',
        'name.unique' => '该分类名称已经存在，请另起名称',
    ],

];