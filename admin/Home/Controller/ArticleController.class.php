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
 * 文章
 * Class articleController
 * @package Home\Controller
 */
class articleController extends PublicController{

    /**
     * articleController constructor.
     */
    public function __construct()
    {
        //优先调用父项
        parent::__construct();

        if(!empty($_GET)){
            $where['id']=I('get.id');
            $this->where=$where;
        }
    }

    /**
     * 列表
     * @Author joungpig
     * @Date 2018/2/1
     */
    public function index(){
        //条件筛选
        if(!empty($_GET)){
            if($_GET['data1']||$_GET['data2']){
                $where=$this->dateCheck($_GET['data1'],$_GET['data2'],'time');//日期筛选条件
            }
            //时间条件筛选
            $where=$this->check(1,$where);
        }
        //必选条件
        $where['state'] = array('neq','2');
        $count=M('content')->where($where)->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('content')->where($where)->limit($Page->firstRow.','.$Page->listRows)->field('title,type,columuid,view,good,tag,state,time,id,top,uid')->order('top DESC,id DESC ')->select();

        //循环获取条件
        foreach($list as $key => $value){
            if($value['state']==0 && $value['top']!=1){
                $list[$key]['class'] = 'warning';
            }else if($value['top']==1){
                $list[$key]['class'] = 'danger';
                $list[$key]['mark'] = '<label style="color:red;">[\'置顶\']</label>';
            }
        }
        //筛选条件
        $type=M('type')->select();//文章类型
        $columuid=M('columu')->select();//文章栏目
        $uid=M('user')->field('id,username')->select();//文章栏目

        $this->assign('page',$show)
             ->assign('list',$list)
             ->assign('columuid',$columuid)
             ->assign('type',$type)
             ->assign('count',$count)
             ->assign('uid',$uid);
        $this->display();
    }

    /**
     * 增加文章
     */
    public function add(){
        if(IS_AJAX){
                if(!I('post.picture') || !I('post.title') || !I('post.content') || !I('post.typeid') || !I('post.columuid')){
                    $ajax_info['error'] = 1;
                    $ajax_info['info'] = '必填项不允许为空!';
                    $this->ajaxReturn($ajax_info);die;
                }
                $new=I('post.picture');
                $tag=implode(',',I('post.tagid'));//标签切割成字符串
                $path=str_replace("sm", "new",$new);
                $content=htmlspecialchars_decode(I('post.content'));
                //主体内容
                M('content')->title=I('post.title');
                M('content')->content=$content;
                //M('content')->author=I('post.author');

                M('content')->time=date("Y-m-d H:i:s");

                //封面
                M('content')->picture=I('post.picture');
                M('content')->smpicture=$path;

                //说明
                M('content')->tag=$tag;
                M('content')->type=I('post.typeid');
                M('content')->columuid=I('post.columuid');

                //作者
                M('content')->uid=$_SESSION['uid'];

                //状态
                M('content')->state=1;
                M('content')->good=0;
                M('content')->view=0;
                $result=M('content')->add();
                if($result){
                    $ajax_info['success'] = 1;
                    $ajax_info['info'] = '添加成功!';
                    $this->ajaxReturn($ajax_info);die;
                }
                else{
                    $ajax_info['error'] = 1;
                    $ajax_info['info'] = '添加失败';
                    $this->ajaxReturn($ajax_info);die;
        }

        }
        else{
            //栏目
            $columu=M('columu')->select();
            //标签
            $tag=M('tag')->select();
            //类型
            $type=M('type')->select();
            $this->assign('columu',$columu)
                 ->assign('tag',$tag)
                 ->assign('type',$type)
                 ->display();
        }

    }

    /**
     * 上传封面
     */
    public  function ajaxpicture(){
        /*调用上传函数*/
        $info=$this->upload();
        /*获取文件路径*/
        $path=$info['Filedata']['savepath'].$info['Filedata']['savename'];

        /*缩略图处理*/

        /*实例化image类*/
        $image=new \Think\Image();
        /*载入图片的源路径*/
        $image->open('./Public/Knowledge/'.$path);  //./Public/Knowledge/2016-07-08/577f5cf290030.jpg
        /*生成缩略图并保存指定的路径*/


        $where='';
        /*封面尺寸1*/
        $small=$info['Filedata']['savepath'].'sm_'.$info['Filedata']['savename'];
        $image->thumb(230, 129,\Think\Image::IMAGE_THUMB_CENTER)->save("./Public/Knowledge/".$small);

        /*实例化image类*/
        $image2=new \Think\Image();
        /*载入图片的源路径*/
        $image2->open('./Public/Knowledge/'.$path);  //./Public/Knowledge/2016-07-08/577f5cf290030.jpg
        /*生成缩略图并保存指定的路径*/

        /*封面尺寸2*/
        $new=$info['Filedata']['savepath'].'new_'.$info['Filedata']['savename'];
        $image2->thumb(720, 405,\Think\Image::IMAGE_THUMB_CENTER)->save("./Public/Knowledge/".$new);
        /*返回路径*/
        echo $small;
        die;
    }

    /**
     * 上传方法
     */
    function  upload(){
        //实例化上传类
        $upload=new  \Think\Upload();
        //指定上传的相关参数
        $upload->maxSize=3145728;    //1024*1024*3    3M
        //指定文件上传格式
        $upload->exts=array('jpg','png','gif','jpeg','zip','rar','docx','doc');
        /*指定上传目录*/
        $upload->rootPath='./Public/knowledge/';
        /*上传文件*/
        $info=$upload->upload();
        if($info){
            return  $info; //返回上传成功的信息
        }else{
            /*输出上传失败的错误信息*/
            $this->error($upload->getError());
        }
    }

    /**
     * 编辑文章
     */
    public function edit(){
        if(!empty(IS_AJAX)) {
            if($_POST['name']=='type'){
                $data = M('type') -> field('id as _value, name as _label') -> select();
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='columuid'){
                $data = M('columu') -> field('id as _value, name as _label') -> select();
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='tag'){
                $data = M('tag') -> field('id as _value, name as _label') -> select();
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='content'){
                $content=M('content')->where(array('id'=>I('id')))->getField('content');
                $this->ajaxReturn($content);die;
            }
            if($_POST['name']=='state'){
                $data[0]['_label'] ='未启用' ;
                $data[0]['_value'] =0 ;
                $data[1]['_label'] ='启用' ;
                $data[1]['_value'] =1 ;
                $data[2]['_label'] ='删除' ;
                $data[2]['_value'] =2 ;
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='top'){
                $data[0]['_label'] ='未置顶' ;
                $data[0]['_value'] =0 ;
                $data[1]['_label'] ='置顶' ;
                $data[1]['_value'] =1 ;
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='picture'){
                $new=I('post.smpicture');
                $path=str_replace("sm", "new",$new);
                $data['picture']=I('post.smpicture');
                $data['smpicture']=$path;
                $data['id'] = I('id');
                $edit_result=M('content')->save($data);
                if($edit_result!=false){
                    $this->ajaxReturn(1);die;
                }else{
                    $return['error']=true;
                    $return['msg']=$label.'修改失败!';
                    $this->ajaxReturn($return);die;
                }
            }
            if(I('content')){
                $edit_info['content']=$content=htmlspecialchars_decode(I('post.content'));
                $edit_info['id']=I('id');
                $edit_result=M('content')->save($edit_info);
                if($edit_result!=false){
                    $this->ajaxReturn(1);die;
                }else{
                    $return['error']=true;
                    $return['msg']='内容修改失败!';
                    $this->ajaxReturn($return);die;
                }
            }
            //需要更新字段名称
            $field = I('field');
            //需要更新字段值
            $fieldValue = I('fieldValue');
            //更新字段id
            $id = I('thisId');
            //返回更新成功失败提示值
            $label = I('label');
            //组装修改信息
            $edit_info[$field]=$fieldValue;
            $edit_info['id']=$id;
            $edit_result=M('content')->save($edit_info);
            if($edit_result!=false){
                $this->ajaxReturn(1);die;
            }else{
                $return['error']=true;
                $return['msg']=$label.'修改失败!';
                $this->ajaxReturn($return);die;
            }
        }
            else
            {
                //文章内容
                $content=M('content')->where($this->where)->find();
                //获取置顶和文章状态
                if($content['state']==0){
                    $content['state_name'] = '未启用';
                }elseif($content['state']==1){
                    $content['state_name'] = '启用';
                }elseif($content['state']==2){
                    $content['state_name'] = '删除';
                }
                if($content['top']==0){
                    $content['top_name'] = '未置顶';
                }elseif($content['top']==1){
                    $content['top_name'] = '置顶';
                }
                $this->assign('content',$content);
                //获取标签名称
                $tag_name = explode(',',$content['tag']);
                $this->assign('tag_name',$tag_name);
                //栏目
                $columu=M('columu')->select();
                //标签
                $tag=M('tag')->select();
                //类型
                $type=M('type')->select();

                $this->assign('columu',$columu)
                     ->assign('tag',$tag)
                     ->assign('type',$type);
                $this->display();
            }
    }

    /**
     * 类型
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function type(){
        $count=M('type')->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('type')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('page',$show)
             ->assign('list',$list);
        $this->display();
    }

    /**
     * 增加类型
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function typeAdd(){
        if(IS_AJAX){
            //检测说胡覅已经存在
            $where['name']=I('post.name');
            $exist=M('type')->where($where)->getField();
            if($exist)
            {
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '添加失败，名字已存在';
                $this->ajaxReturn($ajax_info);die;
            }
            else
            {
                M('type')->name=I('post.name');
                $result=M('type')->add();
                if($result){
                    $ajax_info['success'] = 1;
                    $ajax_info['info'] = '添加成功!';
                    $this->ajaxReturn($ajax_info);die;
                }else{
                    $ajax_info['error'] = 1;
                    $ajax_info['info'] = '添加失败';
                    $this->ajaxReturn($ajax_info);die;
                }
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑类型
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function typeEdit(){
        if(IS_AJAX){
            //需要更新字段名称
            $field = I('field');
            //需要更新字段值
            $fieldValue = I('fieldValue');
            //更新字段id
            $id = I('thisId');
            //返回更新成功失败提示值
            $label = I('label');
            //组装修改信息
            $edit_info[$field]=$fieldValue;
            $edit_info['id']=$id;
            $edit_result=M('type')->save($edit_info);
            if($edit_result!=false){
                $this->ajaxReturn(1);die;
            }else{
                $return['error']=true;
                $return['msg']=$label.'修改失败!';
                $this->ajaxReturn($return);die;
            }
        }
        else{
            //获取详细信息
            $this->assign('type_info',M('type') -> where($this->where) ->find());
            $this->display();
        }
    }

    /**
     * 标签
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function tag(){
        $count=M('tag')->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('tag')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('page',$show)
            ->assign('count',$count)
            ->assign('list',$list);
        $this->display();
    }

    /**
     * 增加标签
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function tagAdd(){
        if(IS_AJAX){
            //检测是否已存在
            $where['name']=I('post.name');
            $exist=M('tag')->where($where)->getField();

            if($exist){
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '名称已存在，添加失败';
                $this->ajaxReturn($ajax_info);die;
            }
            else{
                //添加标签
                M('tag')->name=I('post.name');
                $result=M('tag')->add();
                if($result){
                    $ajax_info['success'] = 1;
                    $ajax_info['info'] = '添加成功!';
                    $this->ajaxReturn($ajax_info);die;
                }else{
                    $ajax_info['error'] = 1;
                    $ajax_info['info'] = '添加失败';
                    $this->ajaxReturn($ajax_info);die;
                }
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑标签
     * @Author joungpig
     * @Date 2018/2/4
     */
    public function tagEdit(){
        if(IS_AJAX){
            if($_POST['name']=='type'){
                $data[0]['_label'] ='文章' ;
                $data[0]['_value'] =1 ;
                $data[1]['_label'] ='导航' ;
                $data[1]['_value'] =2 ;
                $this->ajaxReturn($data);die;
            }
            if($_POST['name']=='state'){
                $data[0]['_label'] ='未启用' ;
                $data[0]['_value'] =0 ;
                $data[1]['_label'] ='启用' ;
                $data[1]['_value'] =1 ;
                $data[2]['_label'] ='删除' ;
                $data[2]['_value'] =2 ;
                $this->ajaxReturn($data);die;
            }
            //需要更新字段名称
            $field = I('field');
            //需要更新字段值
            $fieldValue = I('fieldValue');
            //更新字段id
            $id = I('thisId');
            //返回更新成功失败提示值
            $label = I('label');
            //组装修改信息
            $edit_info[$field]=$fieldValue;
            $edit_info['id']=$id;
            $edit_result=M('tag')->save($edit_info);
            if($edit_result!=false){
                $this->ajaxReturn(1);die;
            }else{
                $return['error']=true;
                $return['msg']=$label.'修改失败!';
                $this->ajaxReturn($return);die;
            }
        }
        else{
            //获取详细信息
            $this->assign('tag_info',M('tag') -> where($this->where) ->find());
            $this->display();
        }
    }

    /**
     * 查询条件
     * @param $type 类型
     */
    private function check($type,$where){
        if($type==1){
            if($_GET['type']){
                $where['type']=$_GET['type'];
            }
            if($_GET['columuid']){
                $where['columuid']=$_GET['columuid'];
            }
            if($_GET['uid']){
                $where['uid']=$_GET['uid'];
            }
            if($_GET['state']){
                $where['state']=$_GET['state'];
            }
            if($_GET['search']){
                $where['title']=array('like','%'.$_GET['search'].'%');
            }
            return $where;
        }
    }

    /**
     * 日期筛选
     */
    private function dateCheck($btime,$etime,$field){
        //$btime=strtotime($btime);
        //$etime=strtotime($etime);
        if($btime && !$etime){
            $where[$field]  = array('EGT',$btime);
        }//仅选择起止日期
        elseif(!$btime && $etime){
            $where[$field]  = array('ELT',$etime);
        }//仅选择结束日期
        elseif($btime && $etime){
            if($etime<$btime){
                $this->error('结束日期不能小于开始日期!');
            }
            $where[$field]  = array('BETWEEN',array($btime,$etime));
        }//选择起止日期和结束日期
        return $where;//返回条件
    }

}