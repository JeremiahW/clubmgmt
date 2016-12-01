<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/1/2016
 * Time: 10:00 AM
 */

namespace app\frontend\controller;


use app\index\model\ActivityItem;
use think\Controller;

class Activity extends Controller
{
    public function get(){
        $list = ActivityItem::with("activity")->select();
        return ["data"=>$list, "result" => true];
    }
}