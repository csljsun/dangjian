<?php

namespace Home\Model;

use Think\Model;

class CommentModel extends Model {
    protected $connection = 'DB_CONFIG1';
    //protected $insertFields = '';


    public static function getComments($workId) {
        if (empty($workId)) {
            return false;
        }
        $Comment = D('Comment');
        $cond = [
            'work_id' => ['eq',$workId],
            'status'   => ['eq', 0],
        ];
        $comments = $Comment->where($cond)->select();
        if (empty($comments)) {
            return [];
        }
        $userInfo = MemberModel::getBatchInfo(array_column($comments,'member_id'));
        array_walk($comments, function(&$value,$key,$p) {
            $value['user_info'] = $p[$value['member_id']];
        }, $userInfo);
        return $comments;
    }

}