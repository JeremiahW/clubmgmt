<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 4:23 PM
 */

namespace app\index\controller;


use app\index\model\GroupModule;
use app\index\model\GroupUser;
use app\index\model\Member;
use app\index\model\Module;
use think\Controller;
use think\Db;
use think\Request;
use \app\index\model\Group as GroupModel;
use think\Url;

class Group extends Controller
{
    public function add(){

        $id = Request::instance()->param('id');
        if(Request::instance()->isPost()) {
            $this->getPostData();
            $data = input('post.');
            $result = $this->validate($data,'Group',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new GroupModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
            }
        }
        else{
            if(!empty($id)) {
                $this->getUserData($id);
            }
        }
        return $this->fetch();
    }

    public function show(){
        $list = GroupModel::where("1=1")->paginate(10);
        $this->assign('list', $list);

        return $this->fetch();
    }

    /*
     * 分组模块管理
     * */
    public function module(){


        $groups = GroupModel::where("1=1")->select();
        $modules = Module::where("1=1")->select();

        $this->assign("groups", $groups);
        $this->assign("modules", $modules);
        $this->assign("requestUrl", Url::build("index/group/showModule"));
        $this->assign("saveUrl", Url::build("index/group/addModule"));
        $this->assign("selectedModuleUrl",  Url::build("index/group/getModulesByGroupId"));
        return $this->fetch();
    }

    /*
   *
     * 分组用户管理
   * */
    public function user(){

        $this->assign("getMemberUrl", Url::build("index/index/getMemberByName"));
        $this->assign("getGroupUrl", Url::build("index/group/getGroup") );
        $this->assign("addUserUrl", Url::build("index/group/addUser") );
        return $this->fetch();
    }

    //belongs to many demo...
    public function showMember(){
        $gid = Request::instance()->param('gid');

        $rows = GroupModel::get(["id"=>$gid], "members");
        $this->assign("list", $rows->Members);
        $this->assign("gid", $gid);
        return $this->fetch();
    }

    //JSON Response
    public function showModule(){
        $groupid = Request::instance()->param('groupid');
        $modules = Module::where("isdeleted<>1")->field("id,module,controller,action")->select();
        return json($modules);
    }

    public function deleteUser(){
        $gid = Request::instance()->param('gid');
        $uid = Request::instance()->param('uid');

        GroupUser::where(["gid"=>$gid, "uid"=>$uid])->delete();
        $this->success("移除成功");

    }
    //JSON Response
    public function addModule(){

        Db::transaction(function (){
             $groupid = Request::instance()->param('groupid');

             $modules = input('post.modules/a');
            GroupModule::where(["gid"=>$groupid])->delete();
            foreach ($modules as $m){
                $mid = $m["id"];
                $data = ["gid"=>$groupid, "mid"=>$mid];
                $db = new GroupModule($data);
                $db->save();
            }
        });
        return json(["result"=>1]);
    }

    //JSON Response
    public function getModulesByGroupId(){
        $groupid = Request::instance()->param('groupid');
        $modules = GroupModule::where(["gid"=>$groupid])->field("mid")->select();
        return json($modules);
    }

    //JSON Response
    public function getGroup(){
        $uid = Request::instance()->param('uid');
        if(empty($uid)){
            $groups = GroupModel::where("1=1")->select();
        }
        else{
            $groups = GroupUser::where(["uid"=>$uid])->select();
        }

       return json($groups);
    }

    //JSON Response
    public function addUser(){

        Db::transaction(function (){
            $uid = Request::instance()->param('uid');

            $groups = input('post.groups/a');
            GroupUser::where(["uid"=>$uid])->delete();
            foreach ($groups as $m){
                $gid = $m["id"];
                $data = ["gid"=>$gid, "uid"=>$uid];
                $db = new GroupUser($data);
                $db->save();
            }
        });

        return ["result"=>1];
    }

    protected function getUserData($id){
        $m = GroupModel::get($id);
        $this->assign("subject", $m['subject']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("id",  $m['id']);
    }

    protected function getPostData(){
        $this->assign("subject", Request::instance()->param('subject'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("id",  Request::instance()->param('id'));
    }
}