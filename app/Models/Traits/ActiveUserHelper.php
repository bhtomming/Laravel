<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\6 0006
 * Time: 16:14
 */

namespace App\Models\Traits;


use App\Models\Reply;
use App\Models\Topic;
use Carbon\Carbon;
use DB;
use Cache;

trait ActiveUserHelper
{
    //用于缓存用户信息
    protected $users = [];

    //配置权重信息
    protected $topic_weight = 4;
    protected $reply_weight = 1;
    protected $pass_days = 7;
    protected $user_number = 6;

    //缓存相关配置
    protected $cache_key = 'larabbs_active_user';
    protected $cache_expire_in_minutes = 65;

    //从数据库查询贴子数目并统计
    public function calculateTopicScore(){
        $topic_users = Topic::query()->select(DB::raw('user_id, count(*) as topic_count'))
            ->where('created_at','>=',Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        //根据话题数计算用户分数
        foreach ($topic_users as $value){
            $this->users[$value->user_id]['score'] = $this->topic_weight * $value->topic_count;
        }
    }

    //从数据库中查询回复数目并统计
    public function calculateReplyScore(){
        $reply_users = Reply::query()->select(DB::raw('user_id, count(*) as reply_count'))
            ->where('created_at','>=',Carbon::now()->subDays($this->pass_days))
            ->groupBy('user_id')
            ->get();

        //统计回复分数
        foreach ($reply_users as $value){
            $reply_score = $value->reply_count * $this->reply_weight;
            if(isset($this->users[$value->user_id])){
                $this->users[$value->user_id]['score'] += $reply_score;
            }else{
                $this->users[$value->user_id]['score'] = $reply_score;
            }
        }
    }

    //计算活跃用户
    private function calculateActiveUsers(){
        $this->calculateTopicScore();
        $this->calculateReplyScore();

        // 数组按照得分排序
        $users = array_sort($this->users, function ($user) {
            return $user['score'];
        });

        // 我们需要的是倒序，高分靠前，第二个参数为保持数组的 KEY 不变
        $users = array_reverse($users, true);

        // 只获取我们想要的数量
        $users = array_slice($users, 0, $this->user_number, true);

        // 新建一个空集合
        $active_users = collect();

        foreach ($users as $user_id => $user) {
            // 找寻下是否可以找到用户
            $user = $this->find($user_id);

            // 如果数据库里有该用户的话
            if (count($user)) {

                // 将此用户实体放入集合的末尾
                $active_users->push($user);
            }
        }

        // 返回数据
        return $active_users;
    }

    //缓存活跃用户
    private function cacheActiveUsers($activeUsers){
        Cache::put($this->cache_key,$activeUsers,$this->cache_expire_in_minutes);
    }

    //计算活跃用户并把它缓存起来
    public function calculateAndCacheActiveUsers(){
        $activeUsers = $this->calculateActiveUsers();

        $this->cacheActiveUsers($activeUsers);
    }

    public function getActiveUsers(){
        //返回活跃用户并试图缓存起来
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function(){
            return $this->calculateActiveUsers();
        });
    }

}