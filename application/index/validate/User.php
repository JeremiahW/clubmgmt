<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/11/2016
 * Time: 11:46 AM
 */

namespace app\index\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['username', 'require|max:50', '请输入用户名|用户名不得超过50个字符'],
        ['password', 'require|length:6,20', '请输入密码|密码为6-20个字符'],
        ['repassword', 'require|confirm:repassword', '请输入确认密码|两次密码不一致'],
        ['chinese', 'require|max:10', '请输入中文名称|中文名称不得多于5个汉字'],
        ['email', 'require|email', '邮箱必须|邮箱格式错误'],
    ];
}