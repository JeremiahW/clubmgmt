<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/2/2016
 * Time: 11:49 AM
 */

namespace app\index\controller;


use app\common\BaseController;
use app\index\model\Catalog as CatalogModel;
use think\Request;

class Catalog extends BaseController
{
    public function add(){
        return $this->fetch();
    }

    public function show(){
        $list = CatalogModel::where("1=1")->paginate(10);
        $this->assign('list', $list);
        $this->assign("catalog",CatalogModel::where("1=1")->select());
        return $this->fetch();
    }

    public function save(){
        if(Request::instance()->isPost()) {
            $data = input('post.');
            $result = $this->validate($data, "Catalog", null, true);
            if(true !== $result){
                return json(["message"=>$result, "result"=>false]);
            }
            else{
                $db = new CatalogModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
                return json(["message"=>"分类添加成功", "result"=>true]);

            }
        }
        return json(["message"=>"hello", "result"=>true]);
    }
}