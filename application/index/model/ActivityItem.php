<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 3:56 PM
 */

namespace app\index\model;


use think\Model;

class ActivityItem extends Model
{
    public function getIsdeletedAttr($value){
        $status = ["1"=>"停用", "0"=>"启用"];
        return $status[$value];
    }

    public function getStartregdateAttr($value){
        return  date_format(new \DateTime($value), 'Y-m-d ');
    }

    public function getEndregdateAttr($value){
        return  date_format(new \DateTime($value), 'Y-m-d ');
    }

    public function activityRegisters(){
        $result = $this->hasMany("ActivityRegister","itemid");
        return $result;
    }


    public function activity(){
        $result = $this->belongsTo("Activity", "activityid");
        return $result;
    }
}