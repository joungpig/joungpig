<?php
namespace Home\Controller;
use Think\Controller;
class loginController extends Controller {

    /**
     * 用户登陆
     * @Author joungpig
     * @Date 2018/2/1
     */
    public function login(){
        if(IS_AJAX){
            //账户密码数据合法性验证
            $username = I('username','','trim');
            $password = I('password','','trim');
            if ($username == '' || $password == '') {
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '用户名或者密码不能为空';
                $this->ajaxReturn($ajax_info);die;
            }

            //身份验证
            $map['username']=$username;
            $user = M('User')->where($map)->find();
            if (!$user || ($user['password'] != get_login($password,$user['encrypt']))) {
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '密码错误！';
                $this->ajaxReturn($ajax_info);die;
            }
            if ($user['state'] == 0) {
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '用户未激活或被停用！';
                $this->ajaxReturn($ajax_info);die;
            }

            //上次登录时间
            $logintime=$user['logintime'];
            //更新数据库参数
            $arr = array('id' => $user['id'] ,//保存时会自动为此ID的更新
                         'logintime' => date("Y-m-d H:i:s"),
                         'ip' => get_client_ip(),
                         'count'=>$user['count']+1,
            );
            //更新数据库
            M('User')->save($arr);

            //TODO 判断是否有记住密码
            if(I('remember')){
//                cookie('joungpig','value');
            }

            //缓存初始化条件
            session('logintime', $logintime);
            session('uid', $user['id']);
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '登陆成功!';
            $this->ajaxReturn($ajax_info);die;
        }
        else{
            $this->display();
        }
    }

    /**
     * 退出登录
     */
    public function dologout(){
        $_SESSION=array();
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-1,'/');
        }
        session_destroy();
        $this->redirect('login/login');
    }

}