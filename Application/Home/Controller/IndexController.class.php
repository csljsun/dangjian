<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Dangjian;

class IndexController extends Controller {

    public function indexAction(){
        //$baseInfo = parent::_baseAction();
        $Work = D('Work');
        $cond = array(
            'status'   => array('eq', 0),
        );
        $work = $Work->where($cond)->order('create_time desc')->select();
        $data = array(
            'newest'  => array(),
            'picture' => array(),
            'dangwei' => array(),
            'jijian'  => array(),
            'gonghui' => array(),
            'tuanwei' => array(),
            'zhibu'   => array(),
        );
        foreach($work as $w) {
            $w['create_date'] = date('Y-m-d', strtotime($w['update_time']));
            if (4 > count($data['newest'])) {
                $data['newest'][] = $w;
            }

            switch ($w['category']) {
                case Dangjian::CAT_DANGWEI:
                    if (4 > count($data['dangwei'])) {
                        $data['dangwei'][] = $w;
                    }
                    break;
                case Dangjian::CAT_JIJIAN:
                    if (4 > count($data['jijian'])) {
                        $data['jijian'][] = $w;
                    }
                    break;
                case Dangjian::CAT_GONGHUI:
                    if (4 > count($data['gonghui'])) {
                        $data['gonghui'][] = $w;
                    }
                    break;
                case Dangjian::CAT_TUANWEI:
                    if (4 > count($data['tuanwei'])) {
                        $data['tuanwei'][] = $w;
                    }
                    break;
                case Dangjian::CAT_ZHIBU:
                    if (4 > count($data['zhibu'])) {
                        //if (isset(session('user')['branch_id']) && (session('user')['branch_id'] == $w['branch_id'])) {
                            $data['zhibu'][] = $w;
                        //}
                    }
                    break;
            }
        }

        $baseInfo = session('user');

        $imageList = array();    // 最近一季度图片
        $newestImg = 0;  // 最新图片
        $config = C('TMPL_PARSE_STRING');
        $dir='.' . $config['__UPLOAD__'];

        $list = scandir($dir);

        foreach($list as $file) {
            if($file != "." && $file != "..") { // 最近一个季度的图片，暂时只支持一级目录
                $arrFile = explode(',',$file);
                if ((time()-intval($arrFile[0])) <= 3*30*86400) {
                    $imageList[$arrFile[0]] = $file;
                }
            }
        }

        krsort($imageList);
        $newestImg = current($imageList);
        $arrGroup = array();
        $index = 0;
        foreach($imageList as $img) {
            $arrGroup[$index/3][] = $img;
            ++$index;
        }

        $Branch = D('Branch');
        $branches = $Branch->select();
        $data = array(
            'branch_info'=> $branches,
            'base_info'  => $baseInfo,
            'data'       => $data,
            'image_list' => $arrGroup,
            'newest_img' => $newestImg,
        );
        $this->assign('data', $data);
        $this->display();
    }

    public function index2Action(){
        //$baseInfo = parent::_baseAction();
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this->display();
    }

}
