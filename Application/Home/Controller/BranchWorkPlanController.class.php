<?php
namespace Home\Controller;

use Think\Controller;
use Home\Common\Dangjian;

class BranchWorkPlanController extends CommonController {

    /**
     * 新建工作计划
     * @return [type] [description]
     */
    public function newAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        if(IS_POST){
            $type     = Dangjian::$typeRMap[I('type/s')];
            $year = intval(date('Y'));
            //$month = intval(date('m'));
            $month = I('month/d');
            $content  = I('content/s');

            $user = session('user');
            $branchId = $user['branch_id'];
            $uId      = $user['uid'];

            $Work = D('BranchWorkPlan');
            $cond = (1==$type)?[
                'type'  => ['eq',$type],
                'year'  => ['eq', $year],
                'month' => ['eq', $month],
            ]:[
                'type' => ['eq',$type],
                'year' => ['eq', $year],
            ];
            $count = $Work->where($cond)->count();
            if (0< $count) {
                $this->error('重复添加！');
            }
            $data = [
                'content'   => $content,
                'type'      => $type,
                'uid'       => $uId,
                'branch_id' => $branchId,
                'year'      => $year,
                'month'     => $month,
            ];
            $data = $Work->create($data);
            if (!$data) {
                exit($Work->getError());
            }
            $id = $Work->add();

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
     * 工作计划
     * @return [type] [description]
     */
    public function detailAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $branchId  = I('branch_id/d',1);
        $year = I('year/d',intval(date('Y')));
        $user = session('user');

        $yearPlan = [];
        $monthPlan = [];

        $Work = D('BranchWorkPlan');
        $cond = [
            'branch_id' => ['eq', $branchId],
            'year'      => ['eq', $year],
            'status'    => ['neq', 1],
        ];
        $works = $Work->where($cond)->select();
        foreach ($works as $w) {
            if (Dangjian::TYPE_YEAR == $w['type']) {
                $yearPlan['content'] = $w['content'];
                $yearPlan['year'] = $w['year'];
            } else {
                $monthPlan[] = [
                    'id'      => $w['id'],
                    'content' => $w['content'],
                    'month'   => $w['month'],
                ];
            }
        }
        $data = array_merge($baseInfo, ['data' => ['year_plan'=>$yearPlan,'month_plan'=>$monthPlan]]);
        if ($user['branch_id'] == $branchId) {
            $data['authority'] = 1;
        }
        //$this->ajaxReturn($data,'json');
        $this->assign('data', $data);
        $this->display();
    }

    public function modifyAction() {

        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $id  = I('id/d');
        $content  = I('content/s');
        if (empty($content)) {
            $this->error('标题、正文不能为空！');
        }

        $user = session('user');
        $uId      = $user['uid'];

        $data = [
            'content'     => $content,
            'uid'       => $uId,
        ];
        $Work = D('BranchWorkPlan');

        if (empty($id)) {
             $this->error('id不能为空！');
        }

        $result == $Work->where("id=$id")->save($data);
        if (false !== $result) {
            $this->success('更新成功','/home/index/index');
        } else {
            $this->error('更新失败');
        }
        return true;
    }

    public function removeAction() {
        //B('Home\Behavior\AuthCheck');
        $baseInfo = parent::_baseAction();
        $id  = I('id/d');
        if (empty($id)) {
             $this->error('参数非法！');
        }

        $data = [
            'status' => 1,
        ];
        $Work = D('BranchWorkPlan');
        $result = $Work->where("id=$id")->save($data);

        $redirectUrl = "/home/branch_work_plan/detail?branch_id=".$baseInfo['base_info']['branch_id'];
        if (false !== $result) {
            $this->success('删除成功',$redirectUrl);
        } else {
            $this->error('删除失败');
        }
    }
}
