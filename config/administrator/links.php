<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\7 0007
 * Time: 11:14
 */
return [
    'title' => '资源链接',
    'single' => '链接',
    'model' => App\Models\Link::class,

    'permission' => function(){//只有站长有修改权限
        return Auth::user()->hasRole('Founder');
    },

    'columns' => [
        'id' => [
            'title' =>'ID标识',
        ],
        'title'=> [
            'title' => '资源标题',
            'sortable' => false,
        ],
        'link' => [
            'title' => '资源链接',
            'sortable' => false,
        ],
        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],
    ],

    'edit_fields' => [
        'title' => [
            'title' => '资源标题',
        ],
        'link' => [
            'title' => '资源链接',
        ],
    ],

    'filters' => [
        'title' => [
            'title' => '标题',
        ],
        'link' => [
            'title' => '链接',
        ],
    ],

];