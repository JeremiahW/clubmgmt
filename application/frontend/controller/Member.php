<?php
namespace app\frontend\controller;


use app\index\model\ActivityRegister;
use app\index\model\Member as MemberModel;
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
            return json(["data"=>$result, "result"=>false]);
        }
        else{

            $db = new MemberModel();
            $db->allowField(true)->save($data);
         }
        return json(["data"=>$data, "result"=>true]);
    }
}