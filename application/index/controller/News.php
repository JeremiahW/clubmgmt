<?php
/**
 * Created by PhpStorm.
 * User: wangji
 * Date: 12/2/2016
 * Time: 11:41 AM
 */

namespace app\index\controller;


use app\common\BaseController;
use app\index\model\Catalog;
use app\index\model\News as NewsModel;
use think\Log;
use think\Request;

class News extends BaseController
{
    public function add(){
        $map['id']  = ['>',-1];
        $map['isdeleted']  = ['=','0'];

        $catalogs = Catalog::where($map)->order("seqno")->select();
        $this->assign("catalogs", $catalogs);

        $id = Request::instance()->param('id');

        if(Request::instance()->isPost()){
            $this->getPostedData();
            //数据验证
            $data = input("post.");

            $thumbnail = $this->upload();
            if(!empty($thumbnail)) {
                $data["thumbnail"] = $thumbnail;
                $this->assign("thumbnail", $thumbnail);
            }
            else{
                //如果用户没上传, 则意味着保留原来的图片. 将原来的图片根据id显示出来.
            }

            $result = $this->validate($data, "News", null, true);
            if(true !== $result){
                $this->assign("message", $result);
            }
            else{
                //添加
                $db = new NewsModel();
                empty($id) ? $db->allowField(true)->save($data): $db->allowField(true)->save($data, ["id"=>$id]);

            }
        }
        else{
            if(!empty($id)){
                $this->getData($id);
            }
        }

        return $this->fetch();
    }

    public function show(){
        //关联预载入
        $list = NewsModel::with("catalog")->where("news.isdeleted=0")->order("news.seqno desc")->paginate(20);
        $this->assign('list', $list);
        return $this->fetch();
    }

    protected function upload(){
        $file = request()->file("thumbnail");
        if($file == null) return "";
        //系统文件路径
        $path = ROOT_PATH."public/"."uploads/news";
        $info = $file->move($path);
        if($info){
            $name = $info->getSaveName();

            return  "uploads/news/".$name;
        }
        else{
            Log::error($file->getError());
        }
    }

    protected function getData($id){
        $m = NewsModel::get($id);
        $this->assign("catid", $m['catid']);
        $this->assign("subject", $m['subject']);
        $this->assign("thumbnail", $m['thumbnail']);
        $this->assign("news", $m['news']);
        $this->assign("author", $m['author']);
        $this->assign("seqno", $m['seqno']);
        $this->assign("ishot", $m['ishot']);
        $this->assign("istop", $m['istop']);
        $this->assign("isrecommend", $m['isrecommend']);
        $this->assign("id", $m['id']);
    }

    protected function getPostedData(){

        $this->assign("catid", Request::instance()->param('catid'));
        $this->assign("subject", Request::instance()->param('subject'));
       // $this->assign("thumbnail", Request::instance()->param('thumbnail'));
        $this->assign("news", Request::instance()->param('news'));
        $this->assign("author", Request::instance()->param('author'));
        $this->assign("seqno", Request::instance()->param('seqno'));
        $this->assign("ishot", Request::instance()->param('ishot'));
        $this->assign("istop", Request::instance()->param('istop'));
        $this->assign("isrecommend", Request::instance()->param('isrecommend'));
        $this->assign("id", Request::instance()->param('id'));

    }
}