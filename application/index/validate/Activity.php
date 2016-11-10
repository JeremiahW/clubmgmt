<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 3:28 PM
 */

namespace app\index\validate;


use think\Validate;

class Activity extends Validate
{
    protected $rule = [
        ['subject', 'require|max:50', '活动名称必填|活动名称不得大于25个汉字'],
        ['seqno', 'require|number', '序号必填|请输入正确的序号'],
        ['summary', 'require', '摘要必填'],
        ['description', 'require', '详细介绍必填'],

    ];
}