<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\2 0002
 * Time: 9:27
 */
use App\Models\Reply;
return [
    'title' => '回复',
    'single' => '回复',
    'model' => Reply::class,

    'columns' => [
        'id' => [
            'title' =>'回复ID'
        ],
        'content' => [
            'title' => '回复内容',
            'sortable' => false,
            'output' => function($value,$model){
                return '<div style="max-width:280px;">'.$value.'</div>';
            }
        ],
        'user' => [
            'title' => '回复人',
            'sortable' => false,
            'output' => function($value,$model){
                $avatar = $model->user->avatar;
                $value = empty($avatar) ? 'N/A' : '<img style="width:22px; height:22px;" src="'.$avatar.'"/>'.$model->user->name;
                return model_link($value,$model);
            }
        ],
        'topic' => [
            'title' => '主题',
            'sortable' => false,
            'output' => function($value,$model){
                return '<div style="max-width:260px;">'.model_admin_link(e($model->topic->title),$model).'</div>';
            }
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array('COMCAT(id," ", name)'),
            'options_sort_field' => 'id',
        ],

        'topic' => [
            'title' => '主题',
            'type' => 'relationship',
            'name_field' => 'title',
            'autocomplete' => true,
            'search_fields' => array('COMCAT(id, " ", name)'),
            'options_sort_field' => 'id',
        ],

        'content' =>[
            'title' => '回复内容',
        ],
    ],

    'filters' => [
        'user' => [
            'title' => '用户',
            'type' => 'relationship',
            'name_field' => 'name',
            'autocomplete' => true,
            'search_fields' => array('COMCAT(id, " ", name)'),
            'options_sort_field' => 'id',
        ],

        'topic' => [
            'title' => '主题',
            'type' => 'relationship',
            'name_field' => 'title',
            'autocomplete' => true,
            'search_fields' => array('COMCAT(id," ",name)'),
            'options_sort_field' => 'id',
        ],

        'content' =>[
            'title' => '回复内容',
        ],
    ],

    'rules' => [
        'content' => 'required',
    ],

    'messages' => [
        'content.required' => '回复内容不能为空',
    ],
];