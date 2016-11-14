<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/14/2016
 * Time: 3:58 PM
 */

namespace app\index\validate;


use think\Validate;

class Guest extends Validate
{

    protected $rule = [
        ['username', 'require|max:50', '请输入用户名|用户名不得超过50个字符'],
        ['password', 'require|length:6,20', '请输入密码|密码为6-20个字符'],

    ];
}