<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/6/2016
 * Time: 3:10 PM
 */

namespace app\index\model;


class News extends Module
{
    public function catalog(){
        return $this->belongsTo("catalog", "catid");
    }

    public function getIstopAttr($value){
        $status = ["1"=>"是", "0"=>"否"];
        return $status[$value];
    }

    public function getIshotAttr($value){
        $status = ["1"=>"是", "0"=>"否"];
        return $status[$value];
    }

    public function getIsrecommendAttr($value){
        $status = ["1"=>"是", "0"=>"否"];
        return $status[$value];
    }


    public function setIstopAttr($value)
    {
        if($value == "on"){
            return "1";
        }
        else{
            return "0";
        }
    }

    public function setIshotAttr($value)
    {
        if($value == "on"){
            return "1";
        }
        else{
            return "0";
        }
    }

    public function setIsrecommendAttr($value)
    {
        if($value == "on"){
            return "1";
        }
        else{
            return "0";
        }
    }
}