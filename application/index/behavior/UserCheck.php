<?php
namespace app\index\behavior;

use think\Controller;
use think\Session;

;
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/14/2016
 * Time: 1:05 PM
 */
class UserCheck
{
    use \traits\controller\Jump;
     public function run(&$params){
         if(!Session::has('User')){
             return $this->error('请登录！','guest/login');
         }
    }
}