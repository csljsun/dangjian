<?php
namespace Home\Controller;

use Think\Controller;
use Home\Common\Dangjian;
use Home\Model\CommentModel;

class WorkController extends CommonController {

    /**
     * 新建工作
     * @return [type] [description]
     */
    public function newAction(){
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        if(IS_POST){
            $title    = I('title/s');
            $abstract = $title;
            $content  = I('content/s');
            $cover    = I('cover/s');

            $category = Dangjian::$catRMap[I('category/s')];
            $user = session('user');
            $branchId = $user['branch_id'];
            $uId      = $user['uid'];
            $type     = Dangjian::$typeRMap[I('type/s')];
            $createtime = date('Y-m-d H:i:s');
            $updatetime = date('Y-m-d H:i:s');

            if (empty($title) || empty($content)) {
                $this->error('标题、正文不能为空！');
            }

            $data = [
                'title'       => $title,
                'abstract'    => $abstract,
                'content'     => $content,
                'cover'       => $cover,
                'category'    => $category,
                'type'        => $type,
                'uid'         => $uId,
                'branch_id'   => $branchId,
                'create_time' => $createtime,
                'update_time' => $updatetime,
            ];
            $Work = D('Work');
            $data = $Work->create($data);
            if (!$data) {
                exit($Work->getError());
            }
            $id = $Work->add();

            // 从内容中抽取出一幅图片数据, 并以图片形式保存
            saveImage($content);
            $this->success('新增成功',"detail?id=$id");
        } else {
            //$data = $baseInfo;
            $data = $baseInfo;
            $data['type_name'] = Dangjian::$typeMap[$data['type']];
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 工作列表
     * @return [type] [description]
     */
    public function listAction(){
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $category  = I('category/d');
        $type  = I('type/d');
        $page = I('page/d', 1);
        $pageSize = I('page_size/d', 5);

        $id  = I('id/d',0);

        $categoryName = '最新动态';
        // 添加权限
        $authority = 0;

        $Work = D('Work');
        if (empty($category)) {
            $cond = [
                'status'   => ['eq', 0],
            ];
        } else if (empty($type)) {
            $categoryName = Dangjian::$catMap[$category];
            $cond = [
                'category' => ['eq',$category],
                'status'   => ['eq', 0],
            ];
        } else {
            $categoryName = Dangjian::$catMap[$category];
            $cond = [
                'category' => ['eq',$category],
                'status'   => ['eq', 0],
                'type'     => ['eq', $type],
            ];
            if (Dangjian::CAT_ZHIBU == $category) {
                $cond['branch_id'] = ['eq', $id];
                if ($id == $baseInfo['base_info']['branch_id']) {
                    $authority = 1;
                }
            }
        }

        // if ((Dangjian::CAT_ZHIBU == $category) && ($id != $baseInfo['base_info']['branch_id'])) {
        //     $this->error('无权限查看其他支部工作！');
        // }
        $count = $Work->where($cond)->count();
        $pager = [
            'curr_page' => $page,
            'page_size' => $pageSize,
            'total_page' => intval(ceil($count/$pageSize)),
        ];

        $data = $Work->where($cond)->order('create_time desc')->page($page,$pageSize)->select();
        foreach($data as &$d) {
            $d['date'] = date('Y-m-d', strtotime($d['update_time']));
        }
        $data = array_merge(['data'=>$data], $baseInfo);
        //$data = ['data'=>$data, 'base_info'=>$baseInfo];

        $data['category'] = $category;
        $data['category_name'] = $categoryName;
        $typeName = Dangjian::$typeMap[$type];
        $data['type'] = $type;
        $data['type_name'] = $typeName;
        $data['pager'] = $pager;

        $data['authority'] = $authority;
        //$this->ajaxReturn($data,'json');
        $this->assign('data', $data);
        $this->display();
    }

    public function removeAction() {
        //B('Home\Behavior\AuthCheck');
        //$baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $id  = I('id/d');
        $category = I('category/d');
        if (empty($id) || empty($category)) {
             $this->error('参数非法！');
        }

        $data = [
            'status' => 1,
        ];
        $Work = D('Work');
        $result = $Work->where("id=$id")->save($data);
        if (false !== $result) {
            $this->success('删除成功',"/home/index/index");
        } else {
            $this->error('删除失败');
        }
    }

    public function detailAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $id = I('id/d');
        if (empty($id)) {
            $this->error('id不能为空！');
        }

        $Work = D('Work');
        $data = $Work->find($_GET['id']);
        if (empty($data) || (1==$data['status'])) {
            $this->error('请求非法！');
        }

        $data['content'] = html_entity_decode( stripslashes($data['content']));
        $data['category_name'] = Dangjian::$catMap[$data['category']];
        $data['type_name'] = Dangjian::$typeMap[$data['type']];
        //$data = array_merge(['data'=>$data], $baseInfo);
        $data = array_merge(['data'=>$data], $baseInfo);
        // 编辑、删除、评论权限
        $data['authority'] = \Home\Model\MemberModel::getAuthority($data['data']['category']);
        $data['comment_authority'] = \Home\Model\MemberModel::getCommentAuthority();
        $comments = CommentModel::getComments($id);
        $data['comment']['list'] = $comments;
        $data['comment']['count'] = count($data['comment']['list']);
        $this->data = $data;
        $this->display();
    }

    public function modifyAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        if(IS_POST){
            $title    = I('title/s');
            $content  = I('content/s');
            $cover    = I('cover/s');
            $updatetime = date('Y-m-d H:i:s');

            if (empty($title) || empty($content)) {
                $this->error('标题、正文不能为空！');
            }

            $data = [
                'title'       => $title,
                'content'     => $content,
                'cover'       => $cover,
                'update_time' => $updatetime,
            ];
            $Work = D('Work');
            $id  = I('id/d');
            if (empty($id)) {
                 $this->error('id不能为空！');
            }
            $result == $Work->where("id=$id")->save($data);
            if (false !== $result) {
                // 从内容中抽取出一幅图片数据, 并以图片形式保存
                saveImage($content);
                $this->success('更新成功',"detail?id=$id");
            } else {
                $this->error('更新失败');
            }
        } else {
            $id    = I('id/d');
            if (empty($id)) {
                $this->error('id不能为空！');
            }
            $Member = D('Work');
            $data = $Member->find($id);
            $data['type_name'] = Dangjian::$typeMap[$data['type']];
            $data = array_merge(['data'=>$data], $baseInfo);
            $this->assign('data', $data);
            $this->display();
        }
    }
}
