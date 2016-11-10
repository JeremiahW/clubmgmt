<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/7/2016
 * Time: 10:53 AM
 */

namespace app\index\validate;


use think\Validate;

class Branch extends Validate
{
    protected $rule = [
        ['subject', 'require|max:50', '分部名称必填|分部名称不能大于25个汉字'],
        ['seqno', 'require|number', '序号必填|请输入正确的序号'],
        ['supervisor', 'require|number', '部门负责人必填|请选择正确的部门负责人'],
    ];


}