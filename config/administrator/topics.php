<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\2\27 0027
 * Time: 11:51
 */
use App\Models\Topic;

return [
    'title' => '话题管理',
    'single' => '话题',
    'model' => Topic::class,

    'columns' =>[
        'id' => [
            'title' => '话题ID',
        ],
        'title' => [
            'title' => '标题',
            'output' => function($value,$model){
                return '<div style="max-width:260px;">'.model_link($value,$model).'</div>';
            },
            'sortable' => false,
        ],
        'user' => [
            'title' => '作者',
            'sortable' => false,
            'output' => function($value,$model){
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="width:28px;" />'.$model->user->name;
                return model_link($value,$model);
            }
        ],
        'category' => [
            'title' => '分类',
            'sortable' => false,
            'output' => function($value,$model){
                return model_admin_link($model->category->name, $model->category);
            },
        ],
        'reply_count' => [
            'title' => '评论',
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'title' => [
            'title' => '标题',
        ],
        'user' => [
            'title' => '作者',
            'type' => 'relationship',
            'name_field' => 'name',

            //开启自动补全功能
            'autocomplete' => true,

            //自动补全搜索的字段
            'search_fields' => ["CONCAT(id, ' ' , name)"],

            //自动补全排序方式
            'options_sort_field' => 'id',
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name',
            'search_fields' => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
        'reply_count' => [
            'title' => '评论',
        ],
        'view_count' => [
            'title' => '查看',
        ],
    ],

    'filters' => [
        'id' => [
            'title' => 'ID',
        ],
        'user' => [
            'title' => '作者',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
        'title' => [
            'title' => '标题',
        ],
        'category' => [
            'title' => '分类',
            'type' => 'relationship',
            'name_field' => 'name',
            'search_fields' => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],

    ],

    'rules' => [
        'title' => 'required',
    ],

    'message' => [
        'title.required' => '话题标题不能为空',
    ],
];