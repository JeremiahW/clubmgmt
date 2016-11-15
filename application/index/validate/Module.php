<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 5:06 PM
 */

namespace app\index\validate;


use think\Validate;

class Module extends Validate
{
    protected $rule = [
        ['module', 'require|max:50', '模块名称必填|模块名称不能大于50个字符'],
        ['controller', 'require|max:50', '控制器名称必填|控制器名称不能大于50个字符'],
        ['action', 'require|max:50', 'Action名称必填|action名称不能大于50个字符'],
    ];
}