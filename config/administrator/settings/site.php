<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\2 0002
 * Time: 11:15
 */
return [
    'title' => '站点设置',

    'permission' => function(){
        return Auth::user()->hasRole('Founder');
    },

    'edit_fields' => [
        'site_name' =>[
            'title' => '网站名称',
            'type' => 'text',
            'limit' => 50,
        ],

        'contact_email' =>[
            'title' => '联系邮箱',
            'type' => 'text',
            'limit' => 50,
        ],

        'seo_description' => [
            'title' => 'SEO信息描述',
            'type' => 'textarea',
            'limit' => 250,
        ],

        'seo_keyword' => [
            'title' => 'SEO关键词',
            'type' => 'text',
            'limit' => 180,
        ],

    ],

    'rules' =>[
        'site_name' => 'required|max:50',
        'contact_email' => 'email',
    ],

    'messages' =>[
        'site_name.required' => '网站名称是必填的',
        'contact_email' => '请填写正确的邮箱',
    ],

    //网站内容保存前调的钩子
    'before_save' => function($data){
        //判断是否加后缀,为了防止添加多次后缀.
        if(!strpos($data['site_name'],'Power By LaravelBBS')){
            $data['site_name'] .= '- Power By LaravelBBS';
        }
    },

    //可以添加自定义动作
    'actions' => [
        'clear_cache' => [
            'title' => '更新系统缓存',

            'messages' => [
                'active' => '正在更新缓存',
                'success' => '清空缓存成功',
                'error' => '清空缓存失败',
            ],

            'action' => function($data){
                \Artisan::call('cache:clear');
                return true;
            }
        ],
    ],
];