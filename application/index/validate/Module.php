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
        ['subject', 'require|max:50', '标题必填|请填入正确的标题'],
        ['seqno', 'require|number', '序号必填|请填入正确的数字'],
        ['icon', 'require|max:50', '图标必填|请填入正确的图标'],
    ];
}