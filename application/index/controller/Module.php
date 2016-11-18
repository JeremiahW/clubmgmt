<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 11/15/2016
 * Time: 5:05 PM
 */

namespace app\index\controller;


use think\Controller;
use think\Request;
use app\index\model\Module as ModuleModel;

class Module extends Controller
{
    public function add(){

        $id = Request::instance()->param('id');
        if(Request::instance()->isPost()) {
            $this->getPostData();
            $data = input('post.');
            $result = $this->validate($data,'Module',null,true);
            if (true !== $result) {
                $this->assign("message",$result);
            }
            else{
                $db = new ModuleModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);
            }
        }
        else{
            if(!empty($id)) {
                $this->getData($id);
            }
        }
        return $this->fetch();
    }

    public function show(){
        $list = ModuleModel::where("isdeleted <> 1")->paginate(10);
        $this->assign('list', $list);

         return $this->fetch();
    }

    public function delete(){
        $id = Request::instance()->param('id');
        ModuleModel::update(["id"=>$id, "isdeleted"=>1]);
        $this->success("模块删除成功");
    }

    protected function getData($id){
        $m = ModuleModel::get($id);
        $this->assign("module", $m['module']);
        $this->assign("controller", $m['controller']);
        $this->assign("action",  $m['action']);
        $this->assign("subject", $m['subject']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("icon",  $m['icon']);
        $this->assign("id",  $m['id']);
    }

    protected function getPostData(){
        $this->assign("module", Request::instance()->param('module'));
        $this->assign("controller", Request::instance()->param('controller'));
        $this->assign("action",  Request::instance()->param('action'));
        $this->assign("subject", Request::instance()->param('subject'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("icon",  Request::instance()->param('icon'));
        $this->assign("id",  Request::instance()->param('id'));
    }
}