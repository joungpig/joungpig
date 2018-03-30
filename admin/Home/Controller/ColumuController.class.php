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
 * 栏目
 * Class columuController
 * @package Home\Controller
 */
class columuController extends PublicController
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
     * 栏目列表
     * @Author joungpig
     * @Date 2018/2/2
     */
    public function index(){
        $count=M('columu')->where(array('state'=>array('neq',2)))->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('columu')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->where(array('state'=>array('neq',2)))->select();
        $this->assign('page',$show)
             ->assign('list',$list)
             ->assign('count',$count)
             ->display();
    }

    /**
     * 增加
     * @Author joungpig
     * @Date 2018/2/2
     */
    public function add(){
        if(IS_AJAX){
            if(!$_POST['name'] || !$_POST['type']){
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '栏目名称不能为空!';
                $this->ajaxReturn($ajax_info);die;
            }
            //栏目名称
            M('columu')->name=$_POST['name'];
            //栏目类型
            M('columu')->type=$_POST['type'];
            //栏目状态
            M('columu')->state=1;
            //栏目父id
            M('columu')->pid=$_POST['pid'];
            if(M('columu')->add()){
                $ajax_info['success'] = 1;
                $ajax_info['info'] = '添加成功!';
                $this->ajaxReturn($ajax_info);die;
            }else{
                $ajax_info['error'] = 1;
                $ajax_info['info'] = '添加失败';
                $this->ajaxReturn($ajax_info);die;
            };
        }else{
            //todo 用无限分类获取父栏目
            $pid = M('columu')->select();
            $pid = getCateTree($pid);
//            dump($pid);
            foreach($pid as $key => $value){
                $sum = '--';
                for ($x=1; $x<=3; $x++)
                    $sum . '--';
                }
                $pid[$key]['html'] = $sum;
            }
            $this->assign('pid',$pid);
            $this->display();
        }


    /**
     * 修改
     * @Author joungpig
     * @Date 2018/2/1
     */
    public function edit(){
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
            $edit_result=M('columu')->save($edit_info);
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
            $this->assign('columu_info',M('columu') -> where($this->where) ->find());
            $this->display();
        }
    }
}