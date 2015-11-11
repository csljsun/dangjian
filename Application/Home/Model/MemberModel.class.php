<?php

namespace Home\Model;

use Think\Model;
use Home\Common\Dangjian;

class MemberModel extends Model {
    protected $connection = 'DB_CONFIG1';
    protected $_validate = array(
        array('username','','帐号名称已经存在!',0,'unique',1), // 在新增的时候验证name字段是否唯一
    );

    /**
     * 获取CRUD权限
     * @param  [type] $catogory 工作类型
     * @param  [type] $role     用户角色
     * @return [type] $authority         0：无权限，1：有权限
     */
    public static function getAuthority($category, $role = null) {
        $authority = 0;
        if (!isset($role)) {
            $role = session('user')['role']?:Dangjian::ROLE_GUEST;
        }
        switch ($role) {
            case Dangjian::ROLE_SUPER_ADMIN:
                $authority = 1;
                break;
            case Dangjian::ROLE_DJGT_ADMIN:
                if (in_array($category,[ Dangjian::CAT_DANGWEI, Dangjian::CAT_TUANWEI, Dangjian::CAT_JIJIAN, Dangjian::CAT_GONGHUI ])) {
                    $authority = 1;
                }
                break;
            case Dangjian::ROLE_ZHIBU_ADMIN:
                if (in_array($category,[ Dangjian::CAT_ZHIBU ])) {
                    $authority = 1;
                }
                break;
        }

        return $authority;
    }

    /**
     * 获取评论权限
     * @param  [type] $role     用户角色
     * @return [type] $authority         0：无权限，1：有权限
     */
    public static function getCommentAuthority($role = null) {
        if (!isset($role)) {
            $role = session('user')['role']?:Dangjian::ROLE_GUEST;
        }
        return (Dangjian::ROLE_GUEST == $role) ? 0 : 1;
    }

    public static function getBatchInfo($ids) {
        if (empty($ids) || !is_array($ids)) {
            return [];
        }
        $ids = array_unique($ids);
        $ids = implode(',',$ids);
        $Member = D('Member');
        $result = $Member->where("id in ($ids)")->select();
        return array_column($result, null, 'id');
    }

    //protected $insertFields = 'sex,mobile,email,avatar,address,education,profession,level,dang,status,nation,birthday,worktime,dangtime,feebase,feemoney,branch_id,create_time,update_time'; // 新增数据的时候允许写入name和email字段
}