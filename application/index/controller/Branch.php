<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/7/2016
 * Time: 10:21 AM
 */

namespace app\index\controller;

use app\common\BaseController;
use app\index\model\Branch as BranchModel;
use app\index\model\Member;
use think\Controller;
use think\Db;
use think\db\Query;
use think\Request;
use think\Url;

class Branch extends BaseController
{
    public function add()
    {
        $id = Request::instance()->param('id');
        $requestUrl = Url('index/index/getMemberByName');
        $this->assign("requestUrl", $requestUrl);

        if(Request::instance()->isPost()){
            $this->getPostData();
            $data = input('post.');
            $result = $this->validate($data,'Branch',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new BranchModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
            }

            if(!empty($id)) $this->getBranchSupervisor($id);
        }
        else{
            if(!empty($id)) {
                $this->getBranchData($id);
                $this->getBranchSupervisor($id);
            }
        }
        return $this->fetch();
    }

    protected function getBranchSupervisor($id){
        $b = BranchModel::get($id);
        $m = Member::get($b["supervisor"]);
        $this->assign("chinese", $m['chinese']);
        $this->assign("supervisor", $m['id']);
    }

    protected function getPostData(){
        $this->assign("subject", Request::instance()->param('subject'));
        $this->assign("description", Request::instance()->param('description'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("supervisor", Request::instance()->param('supervisor'));
        $this->assign("id",  Request::instance()->param('id'));
    }

    protected function getBranchData($id){

        $m = BranchModel::get($id);
        $this->assign("subject", $m['subject']);
        $this->assign("description", $m['description']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("supervisor", $m['supervisor']);
        $this->assign("id", $m['id']);
    }

    public function addMemberToBranch(){
        Db::transaction(function (){
            $jsonMembers = $_POST["members"];
            $branchid = Request::instance()->param('branchid');
            foreach ($jsonMembers as $member){
                $mid = $member["id"];
                $data = ["mid"=>$mid, "bid"=>$branchid];

                if( Db::name("BranchMember")->where("mid=$mid and bid=$branchid")->count()==0){
                    Db::name("BranchMember")->insert($data);
                }
            }
        });

        return  json(['result'=>1,'message'=>'操作完成']);
    }

    //json response
    //获取没有分部的会员的列表
    public function getAbsentMember(){
        $branchid = Request::instance()->param('branchid');
        $sql = "SELECT m.* from ";
        $sql .= "club_member m left join club_branch_member a on m.id = a.mid ";
        $sql .= "   where   ";
        $sql .= "COALESCE(a.bid,0)<>:id and ISNULL(a.bid)";
        $list = Db::query($sql,["id"=>$branchid]);

        return json($list);
    }

    public function show(){
        //关联预载入
        $list = BranchModel::with("leader")->where("1=1")->order("seqno desc")->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function member(){
        $branchid =  Request::instance()->param('branchid');

        $join = [
            ["club_member m","m.id=a.mid"],
            ["club_branch b","b.id=a.bid"],
        ];

        $list = Db::name("BranchMember")->alias("a")->join($join)->where("b.id=$branchid")->paginate(20);

         $this->assign('list', $list);
        //Db::table("table")->select();
        return $this->fetch();
    }

    public function  removeFromBranch(){
        $mid = Request::instance()->param('mid');
        $bid = Request::instance()->param("bid");
        if(!empty($mid) && !empty($bid)){
            $condition = [
                "mid"=>$mid,
                "bid"=>$bid
            ];
            Db::name('BranchMember')->where($condition)->delete();
            $this->success("移除成功");
        }
        else{
            $this->error("请求错误.");
        }

     }

     public function addToBranch(){
        $branchid =  Request::instance()->param('branchid');
        $branchname = Request::instance()->param('branchname');

        $requestUrl = Url::build("index/branch/getAbsentMember","branchid=$branchid");
         $postUrl = Url::build("index/branch/addMemberToBranch",["branchid"=>$branchid]);
         $this->assign("postUrl", $postUrl);

         $this->assign("requestUrl", $requestUrl);
         $this->assign("branchname", $branchname);
         $this->assign("branchid", $branchid);
         return $this->fetch("addmember");
     }
}