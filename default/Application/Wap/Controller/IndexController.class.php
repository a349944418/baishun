<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wap\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//系统首页
    public function index(){
        $category = D('Category')->getTree();
        $lists    = D('Document')->lists(null);

        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',D('Document')->page);//分页

        $huandeng = D('ad')->where('type="huandeng"')->select();
        $this->assign('huandeng', $huandeng);
        $news_left = D('ad')->where('type="pic1"')->getField('img');
        $this->assign('news_left', $news_left);
        $goods = D('ad')->where('type="goods"')->order('sort')->select();
		$goodsback = D('ad')->where('type="goodsback"')->select();
		$this->assign('goods', $goods);
		$this->assign('goodsback', $goodsback);

		$huoban = D('ad')->where('type="huoban"')->order('sort')->select();
		$this->assign('huoban', $huoban);
        $this->assign('menu_act', 'index');
        $this->display();
    }

}