<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 4:35 PM
 */

namespace app\index\validate;


use think\Validate;

class ActivityItem extends Validate
{
    protected $rule = [
        ['subject', 'require|max:50', '活动名称必填|活动名称不得大于25个汉字'],
        ['seqno', 'require|number', '序号必填|请输入正确的序号'],
        ['summary', 'require', '摘要必填'],
        ['description', 'require', '详细介绍必填'],
        ['activityid', 'require|number', '请选择上一级活动|请确保输入正确的活动号'],

        ['startregdate', 'require|date', '请输入注册开始日期|请确保日期格式正确'],
        ['endregdate', 'require|date', '请输入注册结束日期|请确保日期格式正确'],
        ['numofmember', 'require|number', '请输入允许报名人数|请确保输入正确的活动号'],

        ['price', 'require|float', '请输入官方费用|请正确的费用'],
        ['actprice', 'require|float', '请输入应缴纳费用|请正确的费用'],


    ];
}