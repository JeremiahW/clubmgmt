<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/14/2016
 * Time: 3:33 PM
 */

namespace app\index\controller;


use app\index\model\User;
use think\Controller;
use think\Request;
use think\Session;

class Guest extends Controller
{
    public function login(){

        if(Request::instance()->isPost()){
            $username = Request::instance()->param('username');
            $password = Request::instance()->param("password");
            $this->assign("username", $username);
            $data = input('post.');
            $result = $this->validate($data,'Guest',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                 //登录验证
                $user = User::get(["username"=>$username, "password"=>$password]);
                if(count($user)>0){
                    Session::set("User", $user);
                    $this->success("用户登录成功", "index/index/show");
                 }
            }
        }
        return $this->fetch();
    }

    public function logoff(){
        Session::delete('User');
        return $this->fetch("login");
    }
}