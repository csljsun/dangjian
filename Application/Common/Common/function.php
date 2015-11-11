<?php
/*
 * 打印数组
 * $param array $array
 */
function p($array){
	dump($array,1,'',0);
}

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login(){
    $user = session('user');
    if (empty($user)) {
        return 0;
    } else {
        return $user['uid'];
    }
}

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
/**
 * 返回json格式的数据岛客户端
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function jsonReturn($data) {
    $json_str = json_encode($data);
    header('Content-Type:application/json;charset=utf-8');
    $search = 'null';
    $replace='""';
    $returndata = str_replace($search,$replace,$json_str);
    exit($returndata);
}

/**
 * 从html文本中抽取图片并保存
 * @param  [type] $content [description]
 * @return true:抽取到图片并成功保存，false：失败
 */
function saveImage($content) {
     //if (preg_match('/(data:\s*image\/(\w+);base64,)/', $content, $result)){
    if (preg_match('/(data:\s*image\/(\w+);base64,(.*))/', $content, $result)){
        $content = substr($result[0], 0, strpos($result[0],'&quot;'));
        if (preg_match('/(data:\s*image\/(\w+);base64,)/', $content, $result)) {
            $type = $result[2];
            $config = C('TMPL_PARSE_STRING');
            $dir='.' . $config['__UPLOAD__'];
            $filePath = $dir . '/' . strval(time()) . '.' . $type;
            file_put_contents($filePath, base64_decode(str_replace($result[1], '', $content)));
            return true;
        }
    }
    return false;
}

?>