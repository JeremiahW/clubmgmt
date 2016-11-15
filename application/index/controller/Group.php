<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 4:23 PM
 */

namespace app\index\controller;


use think\Controller;
use think\Request;
use \app\index\model\Group as GroupModel;
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