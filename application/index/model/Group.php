<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 4:36 PM
 */

namespace app\index\model;


use think\Model;

class Group extends Model
{
    public function Members(){
        return $this->belongsToMany("Member","club_group_user","uid", "gid");
    }

    public function Modules(){
        return $this->belongsToMany("Module","club_group_module","mid","gid");
    }
}