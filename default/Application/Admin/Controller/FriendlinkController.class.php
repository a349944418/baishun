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
class FriendlinkController extends AdminController 
{

	public function list() 
	{
		$list = D('friendlink')->select();
		$this->assign('title', '底部友情链接');
		$this->assign('list', $list);
		$this->display('list');
	}

	public function add()
	{
		$this->display('edit');
	}

	public function edit()
	{
		$name = array('huandeng'=>'首页幻灯片');
		$fid = I('get.id');
		$res = D('friendlink')->where('fid='.$fid)->find();
		$this->assign('info', $res);
		$this->assign('id', $fid);
		$this->display('edit');
	}

	public function save()
	{
		$post = I('post.');
		$id = I('post.id');
		if($id) {
			$res = D('friendlink')->where('fid='.$id)->save($post);
		} else {
			$res = D('friendlink')->add($post);
		}
		if(!$res){
            $this->error(D('friendlink')->getError());
        }else{
            $this->success($id?'更新成功':'新增成功',U('list'));
        }
	}

	public function del()
	{
		$fid = I('get.id');
		$res = D('friendlink')->where('fid='.$fid)->delete();
		if(!$res){
            $this->error(D('friendlink')->getError());
        }else{
            $this->success('删除成功',U('list'));
        }
	}
}