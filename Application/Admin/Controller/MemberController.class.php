<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\MemberModel;

class MemberController extends Controller {
    public function indexAction(){
    }

    public function addAction(){
        $sex        = I('sex/d',0);
        $name       = I('realname/s','李四');
        $password   = md5(I('password/s','lisi'));
        $mobile     = I('mobile/d','13333333333');
        $email      = I('email/s','test@test.com');
        $avatar     = I('avatar/s', 'http://localhost/img/123.jpg');
        $address    = I('address/s','甘肃省平凉市xx区xx路xx号xx小区');
        $education  = I('education/s','高中');
        $profession = I('profession/s','党委书记');
        $level      = I('level/s','高级技师');
        $dang       = I('dang/d',0);
        $status     = I('status/d',1);
        $nation     = I('nation/s','汉族');
        $birthday   = I('birthday/s','1980-01-01 08:00:00');
        $worktime   = I('work_time/s','1980-01-01 08:00:00');
        $dangtime   = I('dang_time/s','1980-01-01 08:00:00');
        $feebase    = I('fee_base/f',0.02);
        $feemoney   = I('fee_money/f',60);
        $branchId  = I('branch_id/d',1);
        $createtime = date('Y-m-d H:i:s');
        $updatetime = date('Y-m-d H:i:s');

        $data = [
            'sex'        => $sex,
            'name'       => $name,
            'password'   => $password,
            'mobile'     => $mobile,
            'email'      => $email,
            'avatar'     => $avatar,
            'address'    => $address,
            'education'  => $education,
            'profession' => $profession,
            'level'      => $level,
            'dang'       => $dang,
            'status'     => $status,
            'nation'     => $nation,
            'birthday'   => $birthday,
            'worktime'   => $worktime,
            'dangtime'   => $dangtime,
            'feebase'    => $feebase,
            'feemoney'   => $feemoney,
            'branch_id'  => $branchId,
            'create_time'=> $createtime,
            'update_time'=> $updatetime,

        ];
        $Member = D('Member');
        $data = $Member->create($data);
        if (!$data) {
            exit($Member->getError());
        }
        $Member->add();
        $this->success('新增成功',"list/branch_id/$branch_id");
    }

    public function removeAction(){
        $id  = I('id/d');
        if (empty($id)) {
             $this->error('id不能为空！');
        }
        $Member = D('Member');
        $result = $Member->delete($id);
    }

    public function modifyAction(){
        $id  = I('id/d');
        if (empty($id)) {
             $this->error('id不能为空！');
        }
        $sex        = I('sex/d',0);
        $name       = I('name/s','李四');
        $password   = md5(I('password/s','lisi'));
        $mobile     = I('mobile/d','13333333333');
        $email      = I('email/s','test@test.com');
        $avatar     = I('avatar/s', 'http://localhost/img/123.jpg');
        $address    = I('address/s','甘肃省平凉市xx区xx路xx号xx小区');
        $education  = I('education/s','高中');
        $profession = I('profession/s','党委书记');
        $level      = I('level/s','高级技师');
        $dang       = I('dang/d',0);
        $status     = I('status/d',1);
        $nation     = I('nation/s','汉族');
        $birthday   = I('birthday/s','1980-01-01 08:00:00');
        $worktime   = I('work_time/s','1980-01-01 08:00:00');
        $dangtime   = I('dang_time/s','1980-01-01 08:00:00');
        $feebase    = I('fee_base/f',0.02);
        $feemoney   = I('fee_money/f',60);
        $branchId  = I('branch_id/d',1);
        $createtime = date('Y-m-d H:i:s');
        $updatetime = date('Y-m-d H:i:s');

        $data = [
            'sex'        => $sex,
            'name'       => $name,
            'password'   => $password,
            'mobile'     => $mobile,
            'email'      => $email,
            'avatar'     => $avatar,
            'address'    => $address,
            'education'  => $education,
            'profession' => $profession,
            'level'      => $level,
            'dang'       => $dang,
            'status'     => $status,
            'nation'     => $nation,
            'birthday'   => $birthday,
            'worktime'   => $worktime,
            'dangtime'   => $dangtime,
            'feebase'    => $feebase,
            'feemoney'   => $feemoney,
            'branch_id'  => $branchId,
            'create_time'=> $createtime,
            'update_time'=> $updatetime,

        ];
        $Member = D('Member');
        $result == $Member->where("id=$id")->save($data);
        if (false !== $result) {
            $this->success('更新成功');
        } else {
            $this->error('更新失败');
        }
    }

    public function listAction() {
        $branchId  = I('branch_id/d',1);
        $Member = D('Member');
        $ret = $Member->select();
        $cond = [
            'branch_id' => ['eq',$branchId],
        ];
        $data = $Member->where($cond)->select();
        //$this->ajaxReturn($data,'json');
        $this->assign('data', $data);
        $this->display();
    }
}