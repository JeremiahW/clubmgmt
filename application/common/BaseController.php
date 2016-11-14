<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/14/2016
 * Time: 3:36 PM
 */

namespace app\common;


use think\Controller;
use think\Hook;
use think\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        Hook::listen("CheckAuth", $params);

        parent::__construct($request);

    }
}