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
        if($value == "on")
            return "是";
        else
            return "否";
    }

    public function getIshotAttr($value){
        if($value == "on")
            return "是";
        else
            return "否";
    }

    public function getIsrecommendAttr($value){
        if($value == "on")
            return "是";
        else
            return "否";
    }

    public function setistopAttr($value)
    {
        if($value == "on"){
            return $value;
        }
        else{
            return "";
        }
    }

    public function setIshotAttr($value)
    {
        if($value == "on"){
            return $value;
        }
        else{
            return "";
        }
    }

    public function setIsrecommendAttr($value)
    {
        if($value == "on"){
            return $value;
        }
        else{
            return "";
        }
    }

}