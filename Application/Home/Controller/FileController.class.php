<?php
namespace Home\Controller;

use Think\Controller;

class FileController extends CommonController {
    public function index(){

    }

    public function uploadAction() {
        if(IS_POST){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->autoSub = false;  // 是否使用子目录保存上传
            //$upload->exts     = array('jpg', 'gif', 'png', 'jpeg','doc','ppt','xls','docx','pptx','xlsx');// 设置附件上传类型
            $upload->rootPath = './Public/'; // 设置附件上传根目录
            $upload->savePath = './documents/'; // 设置附件上传（子）目录
            $upload->saveName = '';   // 保留文件名
            // 上传文件
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
                exit;
            }else{// 上传成功
                $this->success('上传成功！');
            }
        } else {
            $this->display();
        }

    }

    /**
     * 文件列表
     * @return [type] [description]
     */
    public function listAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $dir= './Public/documents';
        $list = scandir($dir);
        $data = [];
        foreach($list as $file) {
            if($file != "." && $file != "..") { // 暂时只支持一级目录
                $path = $dir . "/" . $file;
                $data[] = [
                    //'name' => iconv('gbk', 'utf-8', $file),
                    'name' => $file,
                    'path' => $path,
                ];
            }
        }
        $data = array_merge(['data'=>$data], $baseInfo);
        $data['category_name'] = '资料室';


        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 党员风采列表
     * @return [type] [description]
     */
    public function presenceListAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');

        $dir= './Public/precence';
        $list = scandir($dir);
        $data = [];
        foreach($list as $file) {
            if($file != "." && $file != "..") { // 暂时只支持一级目录
                $path = $dir . "/" . $file;
                $data[] = [
                    //'name' => iconv('gbk', 'utf-8', $file),
                    'name' => $file,
                    'path' => $path,
                ];
            }
        }
        $data = array_merge(['data'=>$data], $baseInfo);
        $data['category_name'] = '党员风采';

        $this->assign('data', $data);
        $this->display();
    }
}