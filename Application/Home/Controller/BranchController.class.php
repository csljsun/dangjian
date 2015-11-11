<?php
namespace Home\Controller;

use Think\Controller;
use Home\Common\Dangjian;

class BranchController extends CommonController {

    public function _before_index() {

    }

    public function indexAction(){
    }

    public function _after_index() {

    }

    /**
     * 党支部概况
     * @return [type] [description]
     */
    public function overviewAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $id  = I('id/d',1);
        if ($id != $baseInfo['base_info']['branch_id']) {
           // $this->error('无权限查看其他支部概况！');
        }
        // 基本情况
        $countSta = [
            'dang_group_count' => 0,
            'class_group_count' => 0,
            'onduty_count' => 0,
            'dang_member_count' => 0,
            'dang_onduty_count' => 0,
            'dang_offduty_count' => 0,
            'dang_other_count' => 0,
            'dang_activist_count' => 0,
            'dang_prepared_count' => 0,
            'dang_formal_count' => 0,
            'dang_apply_count' => 0,
            'dang_other_count' => 0,
            'dang_develop_count' => 0,
            'edu_senior_count' => 0,
            'edu_deploma_count' => 0,
            'edu_college_count' => 0,
            'edu_university_count' => 0,
            'level_senior_worker_count' => 0,
            'level_technician_count' => 0,
            'level_senior_technician_count' => 0,
            'level_junior_profession_count' => 0,
            'level_medium_profession_count' => 0,
            'level_senior_profession_count' => 0,
        ];
        // 委员名单
        $committeeList = [
            'secretry' => '张三',
            'duputy_secretry' => '李四',
            'organization' => '王五',
            'publicity' => '赵六',
            'dicipline' => '田七',
            'committee' => '黑八、赵四、张三、李四、王五、赵六、赵琦、赵八',
        ];
        // 党小组设置情况
        $groupSetting = [
            ['name'=>'1班组', 'leader'=>'赵琦','dang_count'=>12,'staff_count'=>15,'coverage'=>'80%'],
            ['name'=>'二班组', 'leader'=>'赵八','dang_count'=>14,'staff_count'=>20,'coverage'=>'70%'],
        ];

        $Member = D('Member');
        $cond = [
            'branch_id' => ['eq',$branchId],
        ];
        $mems = $Member->where($cond)->select();

        $data = array_merge($baseInfo, ['data' => ['count_sta'=>$countSta,'committee_list'=>$committeeList,'group_setting'=>$groupSetting]]);
        //$this->ajaxReturn($data,'json');
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 党员名册
     * @return [type] [description]
     */
    public function rosterAction() {
        $baseInfo = parent::_baseAction();
        //$baseInfo = session('user');
        $id  = I('id/d',1);
        if ($id != $baseInfo['base_info']['branch_id']) {
        //    $this->error('无权限查看其他支部党员名册！');
        }
        $Member = D('Member');
        $cond = [
            'branch_id' => ['eq',$id],
        ];
        $data = $Member->where($cond)->select();
        foreach($data as &$d) {
            $d['birthday'] = date('Y-m', strtotime($d['birthday']));
            $d['worktime'] = date('Y-m', strtotime($d['worktime']));
            if (!empty($d['dangtime'])) {
                $d['dangtime'] = date('Y-m', strtotime($d['dangtime']));
            } else {
                $d['dangtime'] = '-';
            }
            $d['profession'] = Dangjian::$profMap[$d['profession']]?:'--';
            $d['level'] = Dangjian::$levelMap[$d['level']]?:'--';
            $d['education'] = Dangjian::$eduMap[$d['education']]?:'--';
        }
        $data = array_merge($baseInfo, ['data' => $data]);
        //$this->ajaxReturn($data,'json');
        if ($id == $baseInfo['base_info']['branch_id']) {
            $data['authority'] = 1;
        }
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 党内会议
     * @return [type] [description]
     */
    public function conferenceAction() {

    }
}
