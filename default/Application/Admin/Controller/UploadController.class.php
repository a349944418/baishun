<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 行为控制器
 * @author huajie <banhuajie@163.com>
 */
class UploadController extends AdminController 
{
	/**
	 * 上传图片
	 */
	public function pic()
	{
		$return = array('error'=>'');
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	    $upload->savePath  =     'Picture/'; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $return['error'] = $upload->getError();
	    }else{// 上传成功
	    	//dump($info);
	        $return['imgurl'] = $info['file']['savepath'].$info['file']['savename'];
	    }
	    echo json_encode($return);
	}

	/**
	 * 上传图片
	 */
	public function video()
	{
		$return = array('error'=>'');
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     5242880 ;// 设置附件上传大小
	    $upload->exts      =     array('mp4');// 设置附件上传类型
	    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	    $upload->savePath  =     'Video/'; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $return['error'] = $upload->getError();
	    }else{// 上传成功
	    	//dump($info);
	        $return['imgurl'] = $info['file']['savepath'].$info['file']['savename'];
	    }
	    echo json_encode($return);
	}
}