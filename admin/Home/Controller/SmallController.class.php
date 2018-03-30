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

/**
 * 小程序用户
 * Class SmallController
 * @package Home\Controller
 */
class SmallController extends PublicController
{
    /**
     * 小程序访问列表
     * @Author joungpig
     * @Date 2018/3/30
     */
    public function index(){
        $this->display();
    }

    /**
     * 获取Token
     * @Author joungpig
     * @Date 2018/3/14号
     */
    public function getToken(){

        //APP_id && APP_SECRET
        $data['APP_ID'] = config('APP_ID');
        $data['APP_SECRET'] = config('APP_SECRET');

        //Code
        $data['Code'] = input('code','','trim');

        //获取openID
        $result = $this->api($data);

        //判断是否存在库中
        if($result['openid']){

            $checkOpenID = Db::name('user_wx')->where(array('openID'=>$result['openid']))->find();

            if(!$checkOpenID){
                // 启动事务
                Db::startTrans();

                //实例化用户模型
                $user = new User();

                //增加用户
                $user_add_result = $user->wxAdd();

                if(!$user_add_result){
                    // 回滚事务
                    Db::rollback();
                }else{
                    //实例化用户模型
                    $user_wx = new UserWx();

                    $data['uid'] = $user_add_result;
                    $data['openID'] = $result['openid'];

                    $add_user_wx_result = $user_wx->addWx($data);

                    if(!$add_user_wx_result){
                        // 回滚事务
                        Db::rollback();
                    }else{
                        $uid = $user_add_result;
                        Db::commit();
                    }
                }

                //增加微信用户
            }
            else{
                //用户信息已存在库中,生成需要返回数据
                $uid = $checkOpenID['uid'];
            }
        }
        //todo 获取openID失败情况

        return json(array('token'=>$uid));
    }

    /**
     * 调用微信api获取响应数据
     * @param  string $name   API名称
     * @param  string $data   POST请求数据
     * @param  string $method 请求方式
     * @param  string $param  GET请求参数
     * @return array          api返回结果
     */
    protected function api($name, $data = '', $method = 'POST', $param = '', $json = true){
        $params = array('appid' => $name['APP_ID'],'secret' => $name['APP_SECRET'],'js_code' => $name['Code'],'grant_type' => 'authorization_code');
        $url  = "https://api.weixin.qq.com/sns/jscode2session";
        if($json && !empty($data)){
            //保护中文，微信api不支持中文转义的json结构
            array_walk_recursive($data, function(&$value){
                $value = urlencode($value);
            });
            $data = urldecode(json_encode($data));
        }

        $data = self::http($url, $params, $data, $method);

        return json_decode($data, true);
    }

    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url    请求URL
     * @param  array  $param  GET参数数组
     * @param  array  $data   POST的数据，GET请求时该参数无效
     * @param  string $method 请求方法GET/POST
     * @return array          响应数据
     */
    protected static function http($url, $param, $data = '', $method = 'GET'){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        /* 根据请求类型设置特定参数 */
        $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);

        if(strtoupper($method) == 'POST'){
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $data;

            if(is_string($data)){ //发送JSON数据
                $opts[CURLOPT_HTTPHEADER] = array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($data),
                );
            }
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        //发生错误，抛出异常
        if($error) throw new \Exception('请求发生错误：' . $error);

        return  $data;
    }

    /**
     * 测试接口
     * @Author joungpig
     * @Date 2018/3/19
     */
    public function getJson(){
        $this-> ajaxreturn (array('code'=>'200','msg'=>'数据返回成功!'));
    }
}