<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/2/2016
 * Time: 3:51 PM
 */

namespace app\index\validate;


use think\Validate;

class Catalog extends Validate
{
    protected $rule = [
        ['subject', 'require|max:50', '标题是必填的|标题不能大于50个出神入化'],
        ['seqno', 'require|number', '序号必填|请输入正确的序号'],
        ['pid', 'require|number', '请选择上一级分类|请选择正确的上一级分类'],
    ];
}