<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/2/2016
 * Time: 3:10 PM
 */

namespace app\index\model;


use think\Model;

class Catalog extends Model
{
    public function getCreate_TimeAttr($value){
        return  date_format(new \DateTime($value), 'Y-m-d ');
    }

    public function getUpdate_TimeAttr($value){
        return  date_format(new \DateTime($value), 'Y-m-d ');
    }

    public function parent(){
        return $this->belongsTo("catalog", "pid", "id", "pcatalog");
    }
}