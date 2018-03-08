<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\3\7 0007
 * Time: 16:15
 */

namespace App\Models\Traits;

use Carbon\Carbon;
use Redis;

trait LastActivedAtHelper
{
    protected $hash_prefix = 'larabbs_last_actived_at_';
    protected $field_prefix = 'user_';

    public function recordLastActivedAt(){

        $hash = $this->getHashFromDate(Carbon::now()->toDateString());

        $field = $this->getHashField();

        $now = Carbon::now()->toDateTimeString();

        Redis::hSet($hash,$field,$now);

    }

    public function syncUserActiveAt(){

        $hash = $this->getHashFromDate(Carbon::now()->subDay()->toDateString());

        $dates = Redis::hGetAll($hash);

        foreach ($dates as $user_id => $date){
            $id = str_replace($this->field_prefix,'',$user_id);

            if($user = $this->find($id)){
                $user->last_active_at = $date;
                $user->save();
            }
        }

        Redis::del($hash);
    }

    public function getLastActivedAtAttribute($value){

        $hash = $this->getHashFromDate(Carbon::now()->toDateString());

        $field = $this->getHashField();

        $datetime = Redis::hGet($hash,$field) ? : $value;

        if($datetime){
            return new Carbon($datetime);
        }else{
            return $this->created_at;
        }
    }

    public function getHashFromDate($date){
        return $this->hash_prefix.$date;
    }

    public function getHashField(){
        return $this->field_prefix.$this->id;
    }
}