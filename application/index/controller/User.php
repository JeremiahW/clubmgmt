<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/11/2016
 * Time: 11:42 AM
 */

namespace app\index\controller;


use think\Controller;

use think\Request;
use app\index\model\User as UserModel;

class User extends Controller
{
    public function add(){

        $id = Request::instance()->param('id');
        if(Request::instance()->isPost()) {
            $this->getPostData();
            $data = input('post.');
            $result = $this->validate($data,'User',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new UserModel();
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
        $list = UserModel::where("1=1")->paginate(10);
        $this->assign('list', $list);
         return $this->fetch();
    }

    protected function getUserData($id){
        $m = UserModel::get($id);
        $this->assign("username", $m['username']);
        $this->assign("chinese", $m['chinese']);
        $this->assign("phone",  $m['phone']);
        $this->assign("password", $m['password']);
        $this->assign("repassword", $m['password']);
        $this->assign("id",  $m['id']);
    }

    protected function getPostData(){
        $this->assign("username", Request::instance()->param('username'));
        $this->assign("chinese", Request::instance()->param('chinese'));
        $this->assign("phone", Request::instance()->param('phone'));
        $this->assign("password", Request::instance()->param('password'));
        $this->assign("repassword", Request::instance()->param('repassword'));
        $this->assign("id",  Request::instance()->param('id'));
    }
}