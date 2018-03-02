<?php
     function route_class() {
        return str_replace('.','_',Route::currentRouteName());
    }

    function make_excerpt($value, $max_length = 200){
         $excerpt = trim(preg_replace('/\r\n|\r|\n|\n+/',' ',strip_tags($value)));

         return str_limit($excerpt,$max_length);
    }

    //把模型转换成复数蛇形命名
    function model_plural_name($model){
        //获取完整的类名如:App\Models\User
        $full_class_name = get_class($model);

        //获取基本的类名如: User
        $class_name = class_basename($full_class_name);

        //转换成蛇形命名如：user
        $snake_case_name = snake_case($class_name);

        //返回复数的蛇形命名如：users
        return str_plural($snake_case_name);
    }

    function model_link($title,$model, $prefix = ""){
        $model_name = model_plural_name($model);

        $prefix = $prefix ? "/$prefix/" : '/';

        $url = config('app.url').$prefix.$model_name.'/'.$model->id;

        return '<a href="'.$url.'" target="_blank">'.$title.'</a>';
    }

    function model_admin_link($title,$model){
        return model_link($title,$model,'admin');
    }
