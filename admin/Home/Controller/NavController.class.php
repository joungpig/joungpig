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

class navController extends PublicController
{
    /**
     * StartController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if(!empty($_GET)){
            $where['id']=I('get.id');
            $this->where=$where;
        }
    }

    /**
     * 导航列表
     * @Author joungpig
     * @Date 2018/3/25
     */
    public function index(){
        $count=M('nav')->where(array('state'=>array('neq',2)))->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('nav')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->where(array('state'=>array('neq',2)))->select();
        $this->assign('page',$show)
            ->assign('list',$list)
            ->assign('count',$count)
            ->display();
    }

    /**
     * 增加导航
     * @Author joungpig
     * @Date 2018/3/25
     */
    public function add(){
        if(IS_AJAX){
            if(!$_POST['title'] || !$_POST['img'] || !$_POST['url']){
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '必填项目不能为空';
                $this->ajaxReturn($ajax_info);die;
            }
            //导航标题
            M('nav')->title=$_POST['title'];
            //导航图片
            M('nav')->img=$_POST['img'];
            //导航链接
            M('nav')->url=$_POST['url'];
            //时间
            M('nav')->time=time();
            //操作人
            M('nav')->uid=$_SESSION['uid'];
            //状态
            M('nav')->state=1;
            if(M('nav')->add()){
                $ajax_info['success'] = 1;
                $ajax_info['info'] = '添加成功!';
                $this->ajaxReturn($ajax_info);die;
            }else{
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '添加失败';
                $this->ajaxReturn($ajax_info);die;
            };
        }else{
            $this->display();
        }
    }

    /**
     * 修改导航
     * @Author joungpig
     * @Date 2018/3/25
     */
    public function edit(){
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
            $edit_result=M('nav')->save($edit_info);
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
            $this->assign('columu_info',M('nav') -> where($this->where) ->find());
            $this->display();
        }
    }
}