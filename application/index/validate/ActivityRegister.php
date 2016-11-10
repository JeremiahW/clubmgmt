<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/9/2016
 * Time: 5:31 PM
 */

namespace app\index\validate;


use think\Validate;

class ActivityRegister extends Validate
{
    protected $rule = [
        ['chinese', 'require|max:20', '姓名必须|姓名不能大于10个汉字'],
        ['email', 'require|email', '邮箱必须|邮箱格式错误'],
        ['phone', 'require|max:20', '电话必填|电话不能超过20个字符'],
        ['gender', 'require', '请选择性别'],
        ['birthdate', 'require|date', '出生日期必填|请输入正确的日期'],
        ['shenfenzheng', 'require|max:18', '身份证必填|请输入18位的身份证信息'],
        ['address', 'require|max:255', '家庭住址必填|住址不超过255个字符'],
        ['clothsize', 'require|max:10', '衣服尺码必填|尺码不超过10个字符'],
        ['emergencycontactname', 'require|max:20', '紧急联系人必填|紧急联系人不能超过10个汉字'],
        ['emergencycontactphone', 'require|max:20', '紧急联系方式必填|紧急联系方式必不能超过20个字符'],
        ['ispaid', 'require|number', '是否支付|请填写是否支付信息'],
        ['isapproval', 'require|number', '是否批准|是否批准此次申请'],
        ['bloodtype', 'require|max:10', '请填写血型|血型最大为10个字符'],

    ];
}