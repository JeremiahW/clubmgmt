<?php
namespace app\frontend\controller;


use app\index\model\ActivityRegister;
use app\index\validate\Member as MemberModel;
use think\Controller;
use think\Request;

class Member extends Controller
{
    public function searchyById(){
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

    public function addMember(){
        $data = Request::instance()->post("form/a");

        $result = $this->validate($data,'index/Member',null,true);
        if (true !== $result) {
            return json(["data"=>"请填写必填的字段.", "result"=>false]);
        }

        return json(["data"=>$data, "result"=>true]);
    }
}