<?php
namespace app\frontend\controller;


use app\index\model\ActivityRegister;
use think\Controller;
use think\Request;

class Member extends Controller
{
    public function searchyById(){
      //  $list = ActivityRegister::with("activityItem.activity")->where(["club_activity_register.activityid"=>$activityid])->paginate(30);

        $shenfenzheng = Request::instance()->post('id');
        if(!empty($shenfenzheng)){
            $list = ActivityRegister::with("activityItem.activity")->where(["shenfenzheng"=>"$shenfenzheng"])->select();


            $this->assign("list", $list);
            $result = ["data"=>$list, "result"=>true,"shenfenzheng"=>$shenfenzheng];
        }
        else{
            $result = ["result"=>false, "shenfenzheng"=>$shenfenzheng];
        }

        return json($result);
    }
}