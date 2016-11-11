<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/11/2016
 * Time: 11:46 AM
 */

namespace app\index\model;


use think\Model;

class User extends Model
{
    public function getIsdeletedAttr($value){
        $status = ["1"=>"停用", "0"=>"启用"];
        return $status[$value];
    }
}