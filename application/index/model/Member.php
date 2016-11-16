<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/3/2016
 * Time: 2:02 PM
 */
class Member extends \think\Model
{

    public function groups(){
        return $this->belongsToMany("Group","club_group_user", "gid", "uid");
    }
}