<?php
namespace app\index\model;
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/3/2016
 * Time: 2:02 PM
 */
class Branch extends \think\Model
{
    public function leader(){
       //  $result = $this->hasOne("Member","id","supervisor");

        $result = $this->belongsTo("Member","supervisor");
        return $result;
    }
}