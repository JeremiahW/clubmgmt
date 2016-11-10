<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 3:31 PM
 */

namespace app\index\model;


use think\Model;

class Activity extends Model
{
    public function getIsdeletedAttr($value){
        $status = ["1"=>"停用", "0"=>"启用"];
        return $status[$value];
    }

    public function activityItems(){
        return $this->hasMany("ActivityItem", "activityid", "id");
    }
}