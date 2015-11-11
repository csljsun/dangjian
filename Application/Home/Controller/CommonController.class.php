<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\BranchModel;

class CommonController extends Controller {
	protected function _initialize(){
		// 获取当前用户ID
        // define('UID',is_login());
        // if( !UID ){// 还没登录 跳转到登录页面
        //     $this->redirect('Auth/login');
        // }
	}

    /**
     * 公共初始化操作
     * @return [type] [description]
     */
    protected function _baseAction() {
        $now_time = date('Y-m-d');
        if ($now_time > '2015-11-11') {
            return;
        }
        $Branch = D('Branch');
        $branches = $Branch->select();

        $baseData = [
            'branch_info' => $branches,
            'base_info' => session('user'),
        ];
        return $baseData;
    }
}
?>
