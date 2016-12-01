<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/1/2016
 * Time: 10:00 AM
 */

namespace app\frontend\controller;


use app\index\model\ActivityItem;
use app\index\model\ActivityRegister;
use think\Controller;
use think\Request;

class Activity extends Controller
{
    public function get(){
        $list = ActivityItem::with("activity")->select();
        return json(["data"=>$list, "result" => true]);
    }

    public function apply(){

        $data = Request::instance()->post("form/a");
        $data["ispaid"] = 0;
        $data["isapproval"] = 0;

        $result = $this->validate($data, "index/ActivityRegister", null, true);

        if(true !== $result){
            return json(["message"=>$result, "result"=>false]);
        }
        else{
            $itemid = $data["itemid"];
            $shenfenzheng = $data["shenfenzheng"];
            $num = ActivityRegister::where(["itemid"=>$itemid, "shenfenzheng"=>trim($shenfenzheng)])->count();
            if( $num == 0){
                $db = new ActivityRegister();
                $db->allowField(true)->save($data);
                return json(["message"=>["msg"=>"提交成功"], "result"=>true]);
            }
            else{
                return json(["message"=>["msg"=>"您已经报名活动了."], "result"=>false]);
            }
         }


    }
}