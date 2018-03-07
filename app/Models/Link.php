<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Link extends Model
{
    //需要填充的字段
    protected $fillable = ['title','link'];

    //需要缓存的信息
    public $cache_key = 'larabbs_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached(){
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function (){
            return $this->all();
        });
    }
}
