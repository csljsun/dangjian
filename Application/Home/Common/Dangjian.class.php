<?php
/**
 * 配置
 * @var [type]
 */
namespace Home\Common;

class Dangjian {
    // 角色
    const ROLE_SUPER_ADMIN = 0;   // 超级管理员
    const ROLE_DJGT_ADMIN  = 1;   // 党委、纪检、工会、团委管理员
    const ROLE_ZHIBU_ADMIN = 2;   // 支部管理员
    const ROLE_LEADER      = 3;   // 书记，纪委书记，工会主席
    const ROLE_GUEST       = -1;  // 游客
    // 文化程度
    const EDU_SENIOR     = 1;  // 高中
    const EDU_DIPLOMA    = 2;  // 中专中技
    const EDU_COLLEGE    = 3;  // 大专
    const EDU_UNIVERSITY = 4;  // 大学及以上
    // 支部id<->名称
    const BRANCH_TONGXIN       = 1;
    const BRANCH_SANYING       = 2;
    const BRANCH_GUYUAN        = 3;
    const BRANCH_PINGLIANG     = 4;
    const BRANCH_PINGLIANGNAN  = 5;
    const BRANCH_CHANGQINGQIAO = 6;
    // 工作类型
    const CAT_DANGWEI = 1;
    const CAT_JIJIAN  = 2;
    const CAT_GONGHUI = 3;
    const CAT_TUANWEI = 4;
    const CAT_ZHIBU   = 5;
    // 职务
    const PRO_SECRETRY        = 1;  // 书记
    const PRO_DEPUTY_SECRETRY = 2;  // 副书记
    const PRO_ORGANIZATION    = 3; // 组织委员
    const PRO_PUBLICITY       = 4;  // 宣传委员
    const PRO_DICIPLINE       = 5;  // 纪检委员
    const PRO_COMMITTEE       = 6;  // 委员
    // 职称
    const LEVEL_SENIOR_WORKER     = 1;  // 高级工
    const LEVEL_TECHNICIAN        = 2;  // 技师
    const LEVEL_SENIOR_TECHNICIAN = 3;  // 高级技师
    const LEVEL_JUNIOR_PROFESSION = 4;
    const LEVEL_MEDIUM_PROFESSION = 5;
    const LEVEL_SENIOR_PROFESSION = 6;
    // 支部工作分类
    const TYPE_MONTH                = 1;
    const TYPE_YEAR                 = 2;
    const TYPE_BRANCH_COMMITTEE     = 3;
    const TYPE_DANG_COMMITTEE       = 4;
    const TYPE_DEMOCRATIC_COMMITTEE = 5;
    const TYPE_DANG_CONFERENCE      = 11;
    const TYPE_DANG_DOCUMENT        = 6;
    const TYPE_DANG_ACTIVITY        = 7;
    const TYPE_JIJIAN               = 8;
    const TYPE_OTHER                = 0;
    const TYPE_DJGT_FILE            = 11;
    const TYPE_DJGT_JOB             = 12;
    const TYPE_DJGT_SPEECH          = 13;
    const TYPE_DJGT_MATTER          = 14;

    public static $eduMap = array(
        self::EDU_SENIOR     => '高中',
        self::EDU_DIPLOMA    => '中专中技',
        self::EDU_COLLEGE    => '大专',
        self::EDU_UNIVERSITY => '大学及以上',
    );

    public static $branchMap = array(
        self::BRANCH_TONGXIN       => '同心',
        self::BRANCH_SANYING       => '三营',
        self::BRANCH_GUYUAN        => '固原',
        self::BRANCH_PINGLIANG     => '平凉',
        self::BRANCH_PINGLIANGNAN  => '平凉南',
        self::BRANCH_CHANGQINGQIAO => '长庆桥',
    );
    public static $branchRMap = array();

    // 性别
    public static $sexMap = array(1=>'女',2=>'男');

    public static $profMap = array(
        self::PRO_SECRETRY        => '支部书记',
        self::PRO_DEPUTY_SECRETRY => '支部副书记',
        self::PRO_ORGANIZATION    => '组织委员',
        self::PRO_PUBLICITY       => '宣传委员',
        self::PRO_DICIPLINE       => '纪检委员',
        self::PRO_COMMITTEE       => '委员',
    );
    public static $profRMap = array(
        '支部书记'  => self::PRO_SECRETRY,
        '支部副书记' => self::PRO_DEPUTY_SECRETRY,
        '组织委员'  => self::PRO_ORGANIZATION,
        '宣传委员'  => self::PRO_PUBLICITY,
        '纪检委员'  => self::PRO_DICIPLINE,
        '委员'     => self::PRO_COMMITTEE,
    );
    // 职称
    public static $levelMap = array(
        1 => '高级工',
        2 => '技师',
        3 => '高级技师',
        4 => '助理级职称',
        5 => '中技职称',
        6 => '高级职称',
    );
    // 政治面貌
    public static $dangMap = [
        0 => '群众',
        1 => '积极分子',
        2 => '预备党员',
        3 => '正式党员',
    ];

    // 工作类型
    public static $catMap = [
        self::CAT_DANGWEI => '党委工作',
        self::CAT_JIJIAN  => '纪委工作',
        self::CAT_GONGHUI => '工会工作',
        self::CAT_TUANWEI => '团委工作',
        self::CAT_ZHIBU   => '支部工作',
    ];

    public static $catRMap = [
        '党委工作' => self::CAT_DANGWEI,
        '纪委工作' => self::CAT_JIJIAN,
        '工会工作' => self::CAT_GONGHUI,
        '团委工作' => self::CAT_TUANWEI,
        '支部工作' => self::CAT_ZHIBU,
    ];

    // 支部工作类别
    public static $typeMap = [
        self::TYPE_MONTH                => '月度工作计划',
        self::TYPE_YEAR                 => '年度工作计划',
        // self::TYPE_BRANCH_COMMITTEE     => '支部委员会',
        // self::TYPE_DANG_COMMITTEE       => '党员大会',
        // self::TYPE_DEMOCRATIC_COMMITTEE => '民主生活会',
        self::TYPE_DANG_CONFERENCE      => '党内会议',
        self::TYPE_DANG_DOCUMENT        => '党课资料',
        self::TYPE_DANG_ACTIVITY        => '党内活动',
        self::TYPE_JIJIAN               => '纪检监察',
        self::TYPE_OTHER                => '其他工作',
        self::TYPE_DJGT_FILE            => '重要文件',
        self::TYPE_DJGT_JOB             => '重点工作',
        self::TYPE_DJGT_SPEECH          => '重要言论',
        self::TYPE_DJGT_MATTER          => '重要事项',
    ];

    public static $typeRMap = [
        '月度工作计划' => self::TYPE_MONTH,
        '年度工作计划' => self::TYPE_YEAR,
        '支部委员会'  => self::TYPE_BRANCH_COMMITTEE,
        '党员大会'    => self::TYPE_DANG_COMMITTEE,
        '民主生活会'  => self::TYPE_DEMOCRATIC_COMMITTEE,
        '党内会议'   => self::TYPE_DANG_CONFERENCE,
        '党课资料'   => self::TYPE_DANG_DOCUMENT,
        '党内活动'   => self::TYPE_DANG_ACTIVITY,
        '纪检监察'   => self::TYPE_JIJIAN,
        '其他工作'   => self::TYPE_OTHER,
        '重要文件'  => self::TYPE_DJGT_FILE,
        '重点工作' => self::TYPE_DJGT_JOB,
        '重要言论' => self::TYPE_DJGT_SPEECH,
        '重要事项' => self::TYPE_DJGT_MATTER,
    ];
}