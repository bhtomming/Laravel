<?php
     function route_class() {
        return str_replace('.','_',Route::currentRouteName());
    }

    function make_excerpt($value, $max_length = 200){
         $excerpt = trim(preg_replace('/\r\n|\r|\n|\n+/',' ',strip_tags($value)));

         return str_limit($excerpt,$max_length);
    }
