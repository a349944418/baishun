<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class AdController extends AdminController 
{

	public function huandeng() 
	{
		$list = $this->getlist('huandeng');
		$this->assign('title', '首页幻灯片');
		$this->assign('list', $list);
		$this->display('list');
	}


	public function getlist($type)
	{
		$list = D('ad')->where('type="'.$type.'"')->order('sort')->select();
		return $list;
	}

	public function add()
	{
		$name = array('huandeng'=>'首页幻灯片');
		$type = I('get.type');
		$type_name = $name[$type];
		$this->assign('type_name', $type_name);
		$this->assign('type', $type);
		$this->display('edit');
	}

	public function edit()
	{
		$name = array('huandeng'=>'首页幻灯片');
		$ad_id = I('get.id');
		$res = D('ad')->where('ad_id='.$ad_id)->find();
		$type_name = $name[$res['type']];
		$this->assign('info', $res);
		$this->assign('type', $res['type']);
		$this->assign('id', $ad_id);
		$this->display('edit');
	}

	public function save()
	{
		$post = I('post.');
		$id = I('post.id');
		if($id) {
			$res = D('ad')->where('ad_id='.$id)->save($post);
		} else {
			$res = D('ad')->add($post);
		}
		if(!$res){
            $this->error(D('ad')->getError());
        }else{
            $this->success($id?'更新成功':'新增成功',U($post['type']));
        }
	}

	public function del()
	{
		$ad_id = I('get.id');
		$type = D('ad')->where('ad_id='.$ad_id)->getField('type');
		$res = D('ad')->where('ad_id='.$ad_id)->delete();
		if(!$res){
            $this->error(D('ad')->getError());
        }else{
            $this->success('删除成功',U($type));
        }
	}

	public function pic1()
	{
		$info = D('ad')->field('img, ad_id')->where('type="pic1"')->find();
		$this->assign('img', $info['img']);
		$this->assign('id', $info['ad_id']);
		$this->display('pic1');
	}

	public function save_pic1()
	{
		$post = I('post.');
		if($post['id']){			
			$res = D('ad')->where('ad_id='.$post['id'])->save($post);
		} else {
			$post['type'] = 'pic1';
			$res = D('ad')->add($post);
		}
		
		if($res){
			$this->success('保存成功',U('pic1'));
		}else{
			$this->error('保存失败');
		}
	}

	/**
	 * 产品页及背景图
	 */
	public function goodsback()
	{
		$goods = $this->getlist('goods');
		$goodsback = $this->getlist('goodsback');
		$list = array_merge($goodsback, $goods);
		dump($list);
		$this->assign('goods', $goods);
		$this->assign('goodsback', $goodsback);
		$this->assign('list', $list);
		$this->display();
	}
}