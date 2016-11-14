<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 3:11 PM
 */

namespace app\index\controller;


use app\common\BaseController;
use app\index\model\ActivityItem;
use app\index\model\ActivityRegister;
use think\Controller;
use think\Db;
use think\Request;
use app\index\model\Activity as ActivityModel;
use think\Url;

class Activity extends BaseController
{
    public function add(){

        $id = Request::instance()->param('id');
        if(Request::instance()->isPost()){
            $this->getPostData();

            $data = input('post.');
            $result = $this->validate($data,'Activity',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new ActivityModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
            }
        }
        else{
            if(!empty($id)) {
                $this->getActivityData($id);
            }
        }
        return $this->fetch();
    }

    public function addActivityItem(){
        $id = Request::instance()->param('id');
        $activityid = Request::instance()->param('activityid');

        $this->assign("activityid", $activityid);

        if(Request::instance()->isPost()) {
            $this->getPostActivityItemData();
            $data = input('post.');
            $result = $this->validate($data,'ActivityItem',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new ActivityItem();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
            }
        }
        else{
            if(!empty($id)) {
                $this->getActivityItemData($id);
            }
        }
        return $this->fetch();
    }

    public function show(){

       // $list = Db::name("Activity")->where("1=1")->order("seqno desc")->paginate(10);

        $list = ActivityModel::where("1=1")->order("seqno desc")->paginate(10);
        $this->assign('list', $list);
        //Db::table("table")->select();

        return $this->fetch();
    }

    public function showActivityItem(){
        $actid = Request::instance()->param('activityid');
        $list = ActivityItem::where("1=1")->order("seqno desc")->paginate(10);

        $this->assign('activityid',$actid);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function showMember(){
        $itemid = Request::instance()->param('itemid');
         //$list = ActivityModel::with("activityItems.activityRegisters")->where("1=1")->paginate(1);
        $this->assign("requestUrl", Url::build("/index/activity/setstatus"));
        $list = ActivityRegister::with("activityItem.activity")->where(["itemid"=>$itemid])->paginate(30);
        $this->assign("list", $list);
        return  $this->fetch();
    }


    public function showAllMember(){
        $activityid  = Request::instance()->param('id');
        $this->assign("requestUrl", Url::build("/index/activity/setstatus"));
        $list = ActivityRegister::with("activityItem.activity")->where(["club_activity_register.activityid"=>$activityid])->paginate(30);
        $this->assign("list", $list);
        return  $this->fetch("showmember");
    }

    public function register(){
        $itemid = Request::instance()->param('itemid');
        $activityid  = Request::instance()->param('activityid');
        $mid= Request::instance()->param('mid');
        if(empty($itemid) || empty($activityid))
        {
            $this->error("错误的请求地址参数, 请重新尝试");
            return;
        }

        $this->assign("gender",0);
        $this->assign("clothsize", "M");
        $this->assign("ispaid","0"); //默认未支付
        $this->assign("isapproval", "0"); //默认未通过审核
        $this->assign("itemid", $itemid);
        $this->assign("activityid", $activityid);
        $this->assign("mid", $mid); //自动填写的会存在这个值
        $this->assign("requestMemberByIdUrl",  Url('index/index/getMemberById'));

        $this->assign("requestMemberUrl",  Url('index/index/getMemberByName'));

        if(Request::instance()->isPost()) {
            $this->getPostMemberData();
            //数据验证
            $data = input('post.');
            $result = $this->validate($data,'ActivityRegister',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $user = new ActivityRegister();
                empty($id) ? $user->allowField(true)->save($data): $user->allowField(true)->save($data, ["id"=>$id]);
            }
        }
        else{
            if(!empty($id)) {
                $this->getMemberData($id);
            }
        }

        return $this->fetch();
    }

    public function showActivityDetails(){

        $list = ActivityItem::with("activity")->where("1=1")->paginate(10);
      //  $list = ActivityModel::with("activityItems")->where("1=1")->paginate(10);
        $this->assign("list", $list);
        return $this->fetch();
    }

    //json response
    public function setStatus(){
        Db::transaction(function (){
            $col =  Request::instance()->param('col');
            $value = Request::instance()->param('val');
            $ids = Request::instance()->param('ids');
            $col = strtolower($col);

            foreach (json_decode($ids) as $id){
                $condition = [
                    ["id","=",$id->id],
                    ["$col","<>","$value"]
                ];

                Db::name("ActivityRegister")->update(["id"=>$id->id,"$col"=>"$value"]);
            }
        });



        return json(['result'=>1, 'message'=>'操作完成']);

    }

    protected function getActivityData($id){
        $m = ActivityModel::get($id);
        $this->assign("subject", $m['subject']);
        $this->assign("description", $m['description']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("summary", $m['summary']);
        $this->assign("id", $m['id']);
    }

    protected function getPostData(){
        $this->assign("subject", Request::instance()->param('subject'));
        $this->assign("description", Request::instance()->param('description'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("summary", Request::instance()->param('summary'));
        $this->assign("id",  Request::instance()->param('id'));
    }

    protected function getActivityItemData($id){
        $m = ActivityItem::get($id);
        $this->assign("subject", $m['subject']);
        $this->assign("description", $m['description']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("summary", $m['summary']);
        $this->assign("stargregdate", $m['startregdate']);
        $this->assign("endregdate", $m['endregdate']);
        $this->assign("numofmember", $m['numofmember']);
        $this->assign("actnumofmember", $m['actnumofmember']);
        $this->assign("price", $m['price']);
        $this->assign("actprice", $m['actprice']);
        $this->assign("id", $m['id']);
    }

    protected function getPostActivityItemData(){
        $this->assign("subject", Request::instance()->param('subject'));
        $this->assign("description", Request::instance()->param('description'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("summary", Request::instance()->param('summary'));

        $this->assign("startregdate", Request::instance()->param('startregdate'));
        $this->assign("endregdate", Request::instance()->param('endregdate'));
        $this->assign("numofmember", Request::instance()->param('numofmember'));
        $this->assign("actnumofmember", Request::instance()->param('actnumofmember'));
        $this->assign("price", Request::instance()->param('price'));
        $this->assign("actprice", Request::instance()->param('actprice'));

        $this->assign("id",  Request::instance()->param('id'));
    }

    protected function getPostMemberData(){
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
        $this->assign("description", Request::instance()->param('description'));

        $this->assign("ispaid", Request::instance()->param('ispaid')); //默认未支付
        $this->assign("isapproval",  Request::instance()->param('isapproval')); //默认未通过审核
        $this->assign("itemid",  Request::instance()->param('itemid'));
        $this->assign("activityid", Request::instance()->param('activityid'));
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

        $this->assign("ispaid", $m['ispaid']); //默认未支付
        $this->assign("isapproval",   $m['isapproval']); //默认未通过审核
        $this->assign("itemid",  $m['itemid']);
        $this->assign("activityid",  $m['activityid']);
        $this->assign("description",  $m['description']);

    }
}