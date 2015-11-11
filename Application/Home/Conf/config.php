<?php
return array(
    //'配置项'=>'配置值'
    'default_module' => 'Index', //默认模块
    'URL_MODEL' => '2', //URL模式
    'session_auto_start' => true, //是否开启session
    'USER_CONFIG' => array(
        'USER_AUTH' => true,
        'USER_TYPE' => 2,
    ),
    'URL_CASE_INSENSITIVE' => true,   // 忽略url大小写
    'URL_HTML_SUFFIX'      => '',     // URL伪静态后缀设置
    //'URL_HTML_SUFFIX'      => 'html|shtml|xml',     // URL伪静态后缀设置
    //'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg', // URL禁止访问的后缀设置
    'URL_PARAMS_BIND'      => true,   // URL变量绑定到操作方法作为参数
    'ACTION_SUFFIX' => 'Action', // 操作方法后缀
    'DB_CONFIG1' => array(
        'DB_TYPE' => 'mysql',
        'DB_USER' => 'root',
        //'DB_PWD'  => '',
        'DB_PWD'  => 'root',
        'DB_HOST' => 'localhost',
        'DB_PORT' => '3306',
        'DB_NAME' => 'dangjian',
        'DB_PREFIX' => 'think_',
        'DB_CHARSET' => 'utf8',
        'DB_DEBUG' => TRUE,
    ),
    'DB_CONFIG2' => 'mysql://root:root@localhost:3306/dangjian',
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'onethink_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
        '__DOC__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/documents',
        '__UPLOAD__' => __ROOT__ . '/Public/' . MODULE_NAME . '/uploads',
    ),
    // 文件上传
    'FILE_UPLOAC_CONFIG' => array(
        'mimes'      => '',    // 允许上传的文件类型
        'maxSize'    => 6 * 1024 * 1024,  // 上传文件大小限制
        'exts'       => array('jpg', 'gif', 'png', 'jpeg'),    // 设置附件上传类型
        // 'autoSub' => true, // 自动子目录保存文件
        // 'subName' => array('date','Y-m-d'),
        'rootPath'   => './Uploads/',    // 保存根路径
        'savePath'   => '',    // 保存路径
        'saveName'   => array('uniqid',''),
    ),
);
