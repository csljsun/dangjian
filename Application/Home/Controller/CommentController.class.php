<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class CommentController extends CommonController {
    public function index(){

    }

    /**
     * 发表评论，待改为ajax请求与加载
     * @return [type] [description]
     */
    public function newAction() {
        $baseInfo = parent::_baseAction();
        $workId   = I('work_id/d', 0);
        $parentId = I('parent_id/d', 0);
        $content  = I('content/s');

        if (empty($workId)) {
            $this->error('参数错误！');
        }

        if (empty($content)) {
            $this->error('评论内容不能为空！');
        }

        $data = [
            'parent_id' => $parentId,
            'work_id'   => $workId,
            'content'   => $content,
            'member_id' => intval($baseInfo['base_info']['uid']),
            'member_name' => $baseInfo['base_info']['realname'],
            'status'    => 0,
            'create_time' => date('Y-m-d H:i:s'),
        ];
        $Comment = D('Comment');
        $data = $Comment->create($data);
        if (!$data) {
            exit($Comment->getError());
        }
        $id = $Comment->add();
        if ($id) {
            $this->success('评论成功',"/home/work/detail?id=$workId");
        } else {
            $this->error('评论失败',"/home/work/detail?id=$workId");
        }
    }

    public function removeAction() {
        $id = I('id/d', 0);
        if (empty($id)) {
            $this->error('参数错误');
        }
        $Comment = D('Comment');
        $data = [
            'status' => 1,
        ];
        $result = $Comment->where("id=$id")->save($data);
        if (false !== $result) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }

    }
}