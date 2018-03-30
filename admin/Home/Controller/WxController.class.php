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

use Com\Wechat;

use Com\WechatAuth;

define("TOKEN", "joung");

/**
 * 微信
 * Class articleController
 * @package Home\Controller
 */
class WxController extends PublicController
{
    /**
     * 初始化
     * WxController constructor.
     */
    public function __construct()
    {
        //优先调用父类
        parent::__construct();

        //微信基本条件
        $appid     = C('APPID');
        $appsecret = C('APPSECRET');

        //判断是否有 token
        $token = session("token");

        //有token则直接初始化微信类,没有则进行重新获取
        if($token){
            $this -> auth = new WechatAuth($appid, $appsecret, $token);
        }
        else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);

            $this -> auth = $auth;
        }

//        $url = 'https://www.baidu.com/';
//        dump(urlEncode($url));
    }

    //微信类
    private $auth = '';

    /**
     * 微信控制后台
     * @author joungpig
     * @Date/2/9
     */
    public function wxController(){
        //获取素材数量
        $materialcount = M('materialcount')->order('id desc')->find();
        $this->assign('materialcount',$materialcount);
        $this->display();
    }

    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function index($id = ''){
        $ip = get_client_ip();
        writePayLog('Admin_Wx_index.log', $ip, 1);
        //调试
        try{
            //判断是否是微信进行访问
            $appid = 'wx58aebef2023e68cd'; //AppID(应用ID)
            $token = 'joungpig'; //微信后台填写的TOKEN
            $crypt = 'q6FPCUoCQWaOiR3UUe5RfQu8A7hlJcMW4BnNyH9z2il'; //消息加密KEY（EncodingAESKey）

            /* 加载微信SDK */
            $wechat = new Wechat($token, $appid, $crypt);

            /* 获取请求信息 */
            $data = $wechat->request();

            if($data && is_array($data)){
                /**
                 * 你可以在这里分析数据，决定要返回给用户什么样的信息
                 * 接受到的信息类型有10种，分别使用下面10个常量标识
                 * Wechat::MSG_TYPE_TEXT       //文本消息
                 * Wechat::MSG_TYPE_IMAGE      //图片消息
                 * Wechat::MSG_TYPE_VOICE      //音频消息
                 * Wechat::MSG_TYPE_VIDEO      //视频消息
                 * Wechat::MSG_TYPE_SHORTVIDEO //视频消息
                 * Wechat::MSG_TYPE_MUSIC      //音乐消息
                 * Wechat::MSG_TYPE_NEWS       //图文消息（推送过来的应该不存在这种类型，但是可以给用户回复该类型消息）
                 * Wechat::MSG_TYPE_LOCATION   //位置消息
                 * Wechat::MSG_TYPE_LINK       //连接消息
                 * Wechat::MSG_TYPE_EVENT      //事件消息
                 *
                 * 事件消息又分为下面五种
                 * Wechat::MSG_EVENT_SUBSCRIBE    //订阅
                 * Wechat::MSG_EVENT_UNSUBSCRIBE  //取消订阅
                 * Wechat::MSG_EVENT_SCAN         //二维码扫描
                 * Wechat::MSG_EVENT_LOCATION     //报告位置
                 * Wechat::MSG_EVENT_CLICK        //菜单点击
                 */

                //记录微信推送过来的数据
                file_put_contents('./data.json', json_encode($data));

                /* 响应当前请求(自动回复) */
                //$wechat->response($content, $type);

                /**
                 * 响应当前请求还有以下方法可以使用
                 * 具体参数格式说明请参考文档
                 *
                 * $wechat->replyText($text); //回复文本消息
                 * $wechat->replyImage($media_id); //回复图片消息
                 * $wechat->replyVoice($media_id); //回复音频消息
                 * $wechat->replyVideo($media_id, $title, $discription); //回复视频消息
                 * $wechat->replyMusic($title, $discription, $musicurl, $hqmusicurl, $thumb_media_id); //回复音乐消息
                 * $wechat->replyNews($news, $news1, $news2, $news3); //回复多条图文消息
                 * $wechat->replyNewsOnce($title, $discription, $url, $picurl); //回复单条图文消息
                 *
                 */

                //执行Demo
                $this->demo($wechat, $data);
            }
        }
        catch(\Exception $e){
            file_put_contents('./error.json', json_encode($e->getMessage()));
        }
    }

    /**
     * 自定义菜单管理
     * @author joungpig
     * @Date 2018/2/10
     */
    public function menu(){
        //如果有ajax传值
        if(IS_AJAX){
            //循环组装数组
            foreach(I('p_name') as $key=>$value){
                //父菜单
                $data[$key]['name'] =$value;
                foreach(I('s_name') as $k=>$v){
                    //子菜单
                    $data[$key]['sub_button'][$key]['name'] =$value;
                    $data[$key]['sub_button'][$key]['type'] =I('s_type')[$key];
                    if(I('s_key')){
                        $data[$key]['sub_button'][$key]['key'] =I('s_key')[$key];
                    }
                    if(I('s_url')){
                        //对外部连接进行处理
                        $url = urlEncode(I('s_url')[$key]);
                        $data[$key]['sub_button'][$key]['url'] ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('APPID').'&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
                    }
                    //$data[$key]['sub_button']['sub_button'] =[ ];
                }

            }
            writePayLog('Admin_menu_data', $data, 1);
            //获取参数合成数组
            $result = $this ->auth ->menuCreate($data);
            //token失效重新获取
            if($result['errcode'] == 42001){
                session("token",null);
                //Ajax 返回结果
                $ajax_info['error'] = 1;
                $ajax_info['info'] = 'token失效!请重新提交!';
                $this->ajaxReturn($ajax_info);die;
            }
            else{
                writePayLog('Admin_menuCreate', $result, 1);
                //Ajax 返回结果
                $ajax_info['success'] = 1;
                $ajax_info['info'] = '日志写入成功!';
                $this->ajaxReturn($ajax_info);die;
            }
        }
        else{
            $this->display();
        }
    }

    /**
     * 获取自定义菜单
     * @author joungpig
     * @Date 2018/2/11
     */
    public function getMenu(){
        $Menu_info = $this->auth->menuGet();
        writePayLog('Admin_Menu_info', $Menu_info, 1);
        if($Menu_info['errcode'] == 0){
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '日志写入成功!';
            $this->ajaxReturn($ajax_info);die;
        }
    }

    /**
     * 删除自定义菜单
     * @author joungpig
     * @Date 2018/2/11
     */
    public function delMenu(){
        $Menu_info = $this->auth->menuDelete();
        writePayLog('Admin_Menu_Del', $Menu_info, 1);
        if($Menu_info['errcode'] == 0){
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '日志写入成功!';
            $this->ajaxReturn($ajax_info);die;
        }
    }

    /**
     * 获取微信IP段
     * @Author joungpig
     * @Date 2018/2/7
     */
    public function getCallBackIp(){
        //获取微信IP段
        $ip_lists = $this->auth->getCallBackIp();
        //日志记录
        writePayLog('Admin_ip_lists', $ip_lists, 1);
        //如果返回失败则重新获取token
        if($ip_lists['errcode']){
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);

            //Ajax 返回结果
            $ajax_info['error'] = 1;
            $ajax_info['info'] = 'token更新中，请重新获取IP!';
            $this->ajaxReturn($ajax_info);die;
        }else{
            //先清空数据库数据
            M() ->execute( 'Truncate TABLE joung_wx');
            //ip入库
            foreach($ip_lists['ip_list'] as $key => $value){
                $data = '';
                $data['ip'] = $value;
                M('wx')->add($data);
            }
            //Ajax 返回结果
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '更新成功!';
            $this->ajaxReturn($ajax_info);die;
        }
    }

    /**
     * 获取素材总数
     * @author joungpig
     * @Date 2018/2/9
     */
    public function getMaterialcount(){
        //获取微信服务器的ip段
        $appid     = 'wxe975188924ef4120';
        $appsecret = 'f75d9d585dd44c29c6828d84ee87675e';

        $token = session("token");

        if($token){
            $auth = new WechatAuth($appid, $appsecret, $token);
        }
        else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);

            //Ajax 返回结果
            $ajax_info['error'] = 1;
            $ajax_info['info'] = 'token更新中，请重新获取IP!';
            $this->ajaxReturn($ajax_info);die;
        }
        //获取微信IP段
        $Materialcount = $auth->getMaterialcount();
        if($Materialcount['errcode']){
            //日志记录
            writePayLog('Admin_Wx_demo.log', $Materialcount, 1);
            $ajax_info['error'] = 1;
            $ajax_info['info'] = '获取失败!';
            $this->ajaxReturn($ajax_info);die;
        }else{
             //日志记录
            //writePayLog('Admin_Wx_demo.log', $Materialcount, 1);
            //Ajax 返回结果
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '获取成功!';
            //数据入库
            $Materialcount['time'] = time();
            M('materialcount')->add($Materialcount);
            $this->ajaxReturn($ajax_info);die;
        }
    }

    /**
     * 图片上传
     * @author joungpig
     * @Date 2018/2/9/
     */
    public function upload_img(){
        //调用上传函数
        $info=$this->Mixupload('image');
        //获取文件路径
        $path=$info['Filedata']['savepath'].$info['Filedata']['savename'];
        //调用上传微信方法
        $result = $this -> upload('image','./Public/Admin/wx/Img/'.$path);
        //上传成功返回文件信息
        $ajax_info['success'] = 1;
        $ajax_info['info'] = $result;
        //日志记录
        writePayLog('Admin_Wx_upload', $result, 1);
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 创建标签
     * @author joungpig
     * @Date 2018/2/13
     */
    public function creatTag(){
        if(IS_AJAX){
            //创建数据标签数据
            $data = array('tag'=>array('name'=>I('name')));
            $result = $this ->auth->tagCreate($data);
            writePayLog('Admin_Tags', $result, 1);
            //Ajax 返回结果
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '日志记录成功!';
            $this->ajaxReturn($ajax_info);die;
        }else{
            $this->display();
        }

    }

    /**
     * 获取标签
     * @author joungpig
     * @Date 2018/2/13
     */
    public function getTag(){
        if(IS_AJAX){
            //获取标签
            $result = $this->auth->tagGet();
            //日志记录
            writePayLog('Admin_Tags', $result, 1);
            //Ajax 返回结果
            $ajax_info['success'] = 1;
            $ajax_info['info'] = '日志记录成功!';
            $this->ajaxReturn($ajax_info);die;
        }
    }

    /**
     * 为用户批量打标签
     * @author joungpig
     * @Date 2018/2/13
     */
    public function userTag(){
        //生成数组
        $data['openid_list'] = array('oZEjIv5m3Oj3kpGozx3hu0xG9D0U');
        $data['tagid'] = 100;
        //获取标签
        $result = $this->auth->userTag($data);
        //日志记录
        writePayLog('Admin_Tags', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 获取用户身上标签
     * @author joungpig
     * @Date 2018/2/13
     */
    public function getUserTag(){
        //生成数组
        $data['openid'] = 'oZEjIv5m3Oj3kpGozx3hu0xG9D0U';
        //获取标签
        $result = $this->auth->getUserTag($data);
        //日志记录
        writePayLog('Admin_Tags', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 设置用户备注名
     * @author joungpig
     * @Date 2018/2/13
     */
    public function userRemark(){
        //生成数组
        $data['openid'] = 'oZEjIv5m3Oj3kpGozx3hu0xG9D0U';
        $data['remark'] = 'pangzi';
        //获取标签
        $result = $this->auth->userRemark($data);
        //日志记录
        writePayLog('Admin_userRemarks', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 获取指定用户详细信息
     * @author joungpig
     * @Date 2018/2/13
     */
    public function userInfo(){
        //获取标签
        $result = $this->auth->userInfo('oZEjIv5m3Oj3kpGozx3hu0xG9D0U');
        //日志记录
        writePayLog('Admin_userInfo', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 获取关注者列表
     * @author joungpig
     * @Date 2018/2/13
     */
    public function userGet(){
        //获取标签
        $result = $this->auth->userGet();
        //日志记录
        writePayLog('Admin_userIndex', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 创建二维码
     * @author joungpig
     * @Date 2018/2/13
     */
    public function createQrcode(){
        $scene_id = array('id'=>112);
        //获取标签
        $result = $this->auth->qrcodeCreate($scene_id,'604800');
        //日志记录
        writePayLog('Admin_createQrcode', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * 根据ticket获取二维码URL
     * @author joungpig
     * @Date 2018/2/13
     */
    public function showqrcode(){
        //获取标签
        $result = $this->auth->showqrcode("gQGL8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyNVJGV2tIQThiOF8xeUgzY05xMUoAAgQryYJaAwSAOgkA");
        //日志记录
        writePayLog('Admin_getQrcode', $result, 1);
        //Ajax 返回结果
        $ajax_info['success'] = 1;
        $ajax_info['info'] = '日志记录成功!';
        $this->ajaxReturn($ajax_info);die;
    }

    /**
     * DEMO
     * @param  Object $wechat Wechat对象
     * @param  array  $data   接受到微信推送的消息
     */
    private function demo($wechat, $data){
        //日志记录
        writePayLog('Admin_Wx_demo.log', $data, 1);
        switch ($data['MsgType']) {
            //事件
            case Wechat::MSG_TYPE_EVENT:
                switch ($data['Event']) {
                    case Wechat::MSG_EVENT_SUBSCRIBE:
                        $wechat->replyText('欢迎您关注麦当苗儿公众平台！回复“文本”，“图片”，“语音”，“视频”，“音乐”，“图文”，“多图文”查看相应的信息！');
                        break;

                    case Wechat::MSG_EVENT_UNSUBSCRIBE:
                        //取消关注，记录日志
                        break;

                    default:
                        $wechat->replyText("欢迎访问麦当苗儿公众平台！您的事件类型：{$data['Event']}，EventKey：{$data['EventKey']}");
                        break;
                }
                break;
            //文本
            case Wechat::MSG_TYPE_TEXT:
//                M('wx')->add(array('content'=>$data['Content']));
                switch ($data['Content']) {
                    case '文本':
                        $wechat->replyText('欢迎访问麦当苗儿公众平台，这是文本回复的内容！');
                        break;

                    case '图片':
                        //$media_id = $this->upload('image');
                        $media_id = 'RxoS2FaGg8xqrmb-b9W6fWatMLzQDx_d4eLqNR7xeAA';
                        $wechat->replyImage($media_id);
                        break;

                    case '语音':
                        //$media_id = $this->upload('voice');
                        $media_id = '1J03FqvqN_jWX6xe8F-VJgisW3vE28MpNljNnUeD3Pc';
                        $wechat->replyVoice($media_id);
                        break;

                    case '视频':
                        //$media_id = $this->upload('video');
                        $media_id = '1J03FqvqN_jWX6xe8F-VJn9Qv0O96rcQgITYPxEIXiQ';
                        $wechat->replyVideo($media_id, '视频标题', '视频描述信息。。。');
                        break;

                    case '音乐':
                        //$thumb_media_id = $this->upload('thumb');
                        $thumb_media_id = '1J03FqvqN_jWX6xe8F-VJrjYzcBAhhglm48EhwNoBLA';
                        $wechat->replyMusic(
                            'Wakawaka!',
                            'Shakira - Waka Waka, MaxRNB - Your first R/Hiphop source',
                            'http://wechat.zjzit.cn/Public/music.mp3',
                            'http://wechat.zjzit.cn/Public/music.mp3',
                            $thumb_media_id
                        ); //回复音乐消息
                        break;

                    case '图文':
                        $wechat->replyNewsOnce(
                            "全民创业蒙的就是你，来一盆冷水吧！",
                            "全民创业已经如火如荼，然而创业是一个非常自我的过程，它是一种生活方式的选择。从外部的推动有助于提高创业的存活率，但是未必能够提高创新的成功率。第一次创业的人，至少90%以上都会以失败而告终。创业成功者大部分年龄在30岁到38岁之间，而且创业成功最高的概率是第三次创业。",
                            "http://www.topthink.com/topic/11991.html",
                            "http://yun.topthink.com/Uploads/Editor/2015-07-30/55b991cad4c48.jpg"
                        ); //回复单条图文消息
                        break;

                    case '多图文':
                        $news = array(
                            "全民创业蒙的就是你，来一盆冷水吧！",
                            "全民创业已经如火如荼，然而创业是一个非常自我的过程，它是一种生活方式的选择。从外部的推动有助于提高创业的存活率，但是未必能够提高创新的成功率。第一次创业的人，至少90%以上都会以失败而告终。创业成功者大部分年龄在30岁到38岁之间，而且创业成功最高的概率是第三次创业。",
                            "http://www.topthink.com/topic/11991.html",
                            "http://yun.topthink.com/Uploads/Editor/2015-07-30/55b991cad4c48.jpg"
                        ); //回复单条图文消息

                        $wechat->replyNews($news, $news, $news, $news, $news);
                        break;

                    default:
                        $wechat->replyText("欢迎访问麦当苗儿公众平台！您输入的内容是：{$data['Content']}");
                        break;
                }
                break;
            //图片
            case Wechat::MSG_TYPE_IMAGE:
                $wechat->replyText('你的图片很棒棒噢!');
                break;
            //语音
            case Wechat::MSG_TYPE_VOICE:
                $wechat->replyText('你的语音很棒棒噢!');
                break;
            //视频
            case Wechat::MSG_TYPE_VIDEO:
                $wechat->replyText('你的视频很棒棒噢!');
                break;
            //小视频
            case Wechat::MSG_TYPE_SHORTVIDEO:
                $wechat->replyText('你的小视频很棒棒噢!');
                break;
            //地理位置
            case Wechat::MSG_TYPE_LOCATION:
                $wechat->replyText('你的地理位置很棒棒噢!');
                break;
            //链接
            case Wechat::MSG_TYPE_LINK:

            default:
                # code...
                break;
        }
    }

    /**
     * 资源文件上传方法
     * @param  string $type 上传的资源类型
     * @return string       媒体资源ID
     */
    private function upload($type,$filename){
        $appid     = 'wx58aebef2023e68cd';
        $appsecret = 'bf818ec2fb49c20a478bbefe9dc88c60';

        $token = session("token");

        if($token){
            $auth = new WechatAuth($appid, $appsecret, $token);
        } else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);
        }

        switch ($type) {
            case 'image':
                //$filename = './Public/image.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'voice':
                $filename = './Public/voice.mp3';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'video':
                $filename    = './Public/video.mp4';
                $discription = array('title' => '视频标题', 'introduction' => '视频描述');
                $media       = $auth->materialAddMaterial($filename, $type, $discription);
                break;

            case 'thumb':
                $filename = './Public/music.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            default:
                return '';
        }

        if($media["errcode"] == 42001){ //access_token expired
            session("token", null);
            $this->upload($type);
        }

        return $media['media_id'];
    }

    /**
     * 上传方法
     * @author joungpig
     * @Date 2018/2/9
     */
    private function Mixupload($type){
        //实例化上传类
        $upload=new  \Think\Upload();
        //
        switch ($type) {
            //图片类型
            case 'image':
                $size = 2097152; //2M
                break;
            //语音
            case 'voice':
                $size = 2097152; //2M
                break;
            //视频
            case 'video':
                $size = 10485760; //10M
                break;
            //缩略图
            case 'thumb':
                $size = 65536; //64K
                break;
            default:
                # code...
                break;
        }
        //指定上传的相关参数
        $upload->maxSize=$size;
        //指定文件上传格式
        $upload->exts=array('jpg','png','bmp','jpeg','gif','mp3','wma','wav','amr','MP4');
        //指定上传目录
        $upload->rootPath='./Public/Admin/wx/Img/';
        //上传文件
        $info=$upload->upload();
        if($info){
            //返回上传成功的信息
            return  $info;
        }else{
            //输出上传失败的错误信息
            $return['error']=true;
            $return['msg']=$upload->getError();
            $this->ajaxReturn($return);die;
        }
    }
}