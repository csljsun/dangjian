<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\MemberModel;

class AuthController extends Controller {

    /**
     * 后台用户登录
     */
    public function loginAction($username=null, $password=null,$verify=null){
        if(IS_POST){
            /* 检测验证码 TODO: */
            // if(!check_verify($verify)){
            //     $this->error('验证码输入错误！');
            // }

            $Member = D('Member');
            $map['username'] = $username;
            $user = $Member->where($map)->find();
            if(!$user){
                $this->error('帐号不存在');
            }
            if($user['password'] != md5($password)){
                $this->error('密码错误');
            }


            /* 记录登录SESSION和COOKIES */
            $auth = array(
                'uid'        => $user['id'],
                'username'   => $user['username'],
                'realname'   => $user['realname'],
                'profession' => $user['profession'],
                'branch_id'  => $user['branch_id'],
                'role'       => $user['role'],
                'sex'        => $user['sex'],
            );
            session('user', $auth);
            $this->success('登录成功！', U('Index/index'));
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                $this->display();
            }
        }

    }
    /* 退出登录 */
    public function logoutAction(){
        if(is_login()){
            session('user', null);
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }

    public function verifyAction(){
        ob_end_clean();
        $verify = new \Think\Verify();
        $verify->entry();
    }
}