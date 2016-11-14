<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 5:30 PM
 */

namespace app\index\model;


use think\Model;

class ActivityRegister extends Model
{


    public function getIsapprovalAttr($value){
        $status = ["1"=>"通过", "0"=>"审核中"];
        return $status[$value];
    }

    public function getIspaidAttr($value){
        $status = ["1"=>"已支付", "0"=>"未支付"];
        return $status[$value];
    }

    public function activityItem(){
        $result = $this->belongsTo("ActivityItem", "itemid");
        return $result;
    }
}