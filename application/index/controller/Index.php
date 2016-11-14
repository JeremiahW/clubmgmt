<?php
namespace app\index\controller;

use app\common\BaseController;
use app\index\model\Member;
use think\Controller;
use think\Db;
use think\Request;

class Index extends BaseController
{
    public function index()
    {

    }



    public function show()
    {
        $list = Db::name("member")->paginate(10);
        $this->assign('list', $list);
        //Db::table("table")->select();
        return $this->fetch("list");
    }

    public function add()
    {
        $id = Request::instance()->param('id');

        $this->assign("gender",0);
        $this->assign("clothsize", "M");
        if(Request::instance()->isPost()) {
            $this->getPostedMemberData();
            //数据验证
            $data = input('post.');
            $result = $this->validate($data,'Member',null,true);
            if (true !== $result) {
                 $this->assign("message",$result);
            }
            else{
                $user = new Member();
                empty($id) ? $user->allowField(true)->save($data): $user->allowField(true)->save($data, ["id"=>$id]);
            ;
            }
        }
        else{
            if(!empty($id)) {
                $this->getMemberData($id);
            }
        }

        return $this->fetch();
    }

    public function getMemberByName(){
        $chinese = Request::instance()->param('chinese');
        $map['chinese']  = ['like','%'.$chinese.'%'];
        $members =  Db::name("member")->where($map)->field(["id","chinese"])->select();
        return json($members);
    }

    public function getMemberById(){
        $id = Request::instance()->param('id');
        $result = Member::where(["id"=>$id])->select();
        return json(["data"=>$result, "num"=>sizeof($result)]);
    }

    protected function getMemberData($id){
        $m = Member::get($id);
        $this->assign("chinese", $m['chinese']);
        $this->assign("birthdate", $m['birthdate']);
        $this->assign("phone", $m['phone']);
        $this->assign("gender", $m['gender']);
        $this->assign("email", $m['email']);
        $this->assign("shenfenzheng", $m['shenfenzheng']);
        $this->assign("address", $m['address']);
        $this->assign("clothsize", $m['clothsize']);
        $this->assign("emergencycontactname", $m['bloodtype']);
        $this->assign("emergencycontactname", $m['emergencycontactname']);
        $this->assign("emergencycontactphone", $m['emergencycontactphone']);
        $this->assign("id", $m['id']);
    }

    protected function getPostedMemberData(){
        $this->assign("chinese", Request::instance()->param('chinese'));
        $this->assign("birthdate", Request::instance()->param('birthdate'));
        $this->assign("phone", Request::instance()->param('phone'));
        $this->assign("gender", Request::instance()->param('gender'));
        $this->assign("email", Request::instance()->param('email'));
        $this->assign("shenfenzheng", Request::instance()->param('shenfenzheng'));
        $this->assign("address", Request::instance()->param('address'));
        $this->assign("clothsize", Request::instance()->param('clothsize'));
        $this->assign("bloodtype", Request::instance()->param('bloodtype'));
        $this->assign("emergencycontactname", Request::instance()->param('emergencycontactname'));
        $this->assign("emergencycontactphone", Request::instance()->param('emergencycontactphone'));
        $this->assign("id", Request::instance()->param('id'));

    }
}
