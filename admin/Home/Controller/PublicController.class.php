<?php
// +----------------------------------------------------------------------
// | joungpig
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2018 http://www.joungpig.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: joungpig
// +----------------------------------------------------------------------

namespace Home\Controller;

use Think\Controller;

class PublicController extends Controller
{
    /**
     * 公共页面方法调用
     */
    public function __construct()
    {
        parent::__construct();//优先调用父函数
        //判断是否来源于微信，是则跳过登录验证
        $ip =  get_client_ip();
        //记录ip
        //M('ip')->add(array('wx_ip'=>$ip));
        //检测IP是否为微信IP段
        $ip_check = M('wx')->where(array('ip'=>$ip))->getField('id');
        //检测成功赋予微信session值为时间戳
        if($ip_check){
            $_SESSION['uid'] = time();
        }
        /*登录验证*/
        if(!$_SESSION['uid']){
            //$this->redirect('login/login');
        }
        /*计算访问,用户,文章数目*/
        $vcount=M('view')->count();//访问
        $ucount=M('user')->count();//用户
        $wcount=M('content')->count();//文章
        $user=M('user')->where(array('id'=>$_SESSION['uid']))->find();//用户信息
        $logintime=date('Y-m-d',strtotime($user['logintime']));//上次登录时间
        //dump($user);die;
        $this->assign('vcount',$vcount)
             ->assign('ucount',$ucount)
             ->assign('user',$user)
             ->assign('logintime',$logintime)
             ->assign('wcount',$wcount);
    }

    /**
     * 用户登录
     */
    public function login(){

    }

    /**
     * 用户退出
     */
    public function out(){

    }

    /**
     * 用户修改密码
     */
    public function Modify(){

    }

    /**
     * 数据库备份
     */
    public function back(){

    }

    /**
     * 数据还原
     */
    public function recovery(){

    }
}