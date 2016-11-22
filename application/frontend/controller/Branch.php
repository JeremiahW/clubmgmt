<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/22/2016
 * Time: 11:43 AM
 */

namespace app\frontend\controller;


use think\Controller;
use  app\index\model\Branch as BranchModel;

class Branch extends Controller
{
    public function getBranches(){
        $list = BranchModel::where("1=1")->select();
        return json(["data"=>$list, "result"=>true]);
    }
}