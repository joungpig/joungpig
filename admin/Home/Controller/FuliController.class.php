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
 * 福利
 * Class fuliController
 * @package Home\Controller
 */
class fuliController extends PublicController
{
    /**
     * fuliController constructor.
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
     *福利管理页面
     * */
    public function index(){
        $count=M('fuli')->where(array('state'=>array('neq',2)))->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('fuli')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->where(array('state'=>array('neq',2)))->select();
        $this->assign('page',$show)
            ->assign('list',$list)
            ->assign('count',$count)
            ->display();
    }

    /**
     * 添加福利
     */
    public function add(){
        if(IS_AJAX){
            if(!I('post.name') || !I('post.content')){
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '题目或者内容不能为空';
                $this->ajaxReturn($ajax_info);die;
            }
            M('fuli')->name=I('post.name');
            M('fuli')->content=I('post.content');
            M('fuli')->state=0;
            M('fuli')->count=0;
            $result=M('fuli')->add();
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
        else{
            $this->display();
        }
    }

    /**
     * 编辑福利
     */
    public function edit(){
        if(IS_AJAX){
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
            $edit_result=M('fuli')->save($edit_info);
            if($edit_result!=false){
                $this->ajaxReturn(1);die;
            }else{
                $return['error']=true;
                $return['msg']=$label.'修改失败!';
                $this->ajaxReturn($return);die;
            }
        }else{
            //获取详细信息
            $this->assign('fuli_info',M('fuli') -> where($this->where) ->find());
            $this->display();
        }
    }

}