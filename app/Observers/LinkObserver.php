<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\7 0007
 * Time: 11:47
 */

namespace App\Observers;


use App\Models\Link;
use Cache;

class LinkObserver
{

    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }

}