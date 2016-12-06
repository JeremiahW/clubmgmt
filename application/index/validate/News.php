<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/6/2016
 * Time: 11:39 AM
 */

namespace app\index\validate;


use think\Validate;

class News extends Validate
{
    protected $rule = [
        ['catid', 'require|number', '必需选择分类|分类为ID'],
        ['subject', 'require|max:100', '标题必填|标题最长为100'],
      //  ['thumbnail', 'require|max:255', '缩略图必需要提供|缩略图地址最大为225'],
        ['news', 'require', '请输入新闻'],
        ['author', 'require|max:50', '作者信息必需要填写|作者姓名不超过50个汉字'],
        ['seqno', 'require|number', '显示顺序必需要填写|请输入正确的显示顺序'],
      //  ['ishot', 'require|number', '是否热门|热门应该是数值'],
     //   ['istop', 'require|number', '是否置顶|置顶应该是数值'],
     //   ['isrecommend', 'require|number', '是否推荐|推荐人应该是数值'],
     ];
}