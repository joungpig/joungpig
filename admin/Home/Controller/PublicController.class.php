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
     * PublicController constructor.
     */
    public function __construct()
    {
        parent::__construct();//优先调用父函数

        //登录验证
        if(!$_SESSION['uid']){
            $this->redirect('login/login');
        }

        //用户信息
        $user=M('user')->where(array('id'=>$_SESSION['uid']))->find();

        //上次登录时间
        $logintime=date('Y-m-d',strtotime($user['logintime']));

        $this->assign('user',$user)
             ->assign('logintime',$logintime);
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