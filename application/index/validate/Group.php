<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 4:35 PM
 */

namespace app\index\validate;


use think\Validate;

class Group extends Validate
{
    protected $rule = [
        ['subject', 'require|max:50', '分组名称必填|分组名称不能大于25个汉字'],
        ['seqno', 'require|number', '序号必填|请输入正确的序号'],
    ];
}