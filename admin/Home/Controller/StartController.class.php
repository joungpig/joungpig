<?php
namespace Home\Controller;
use Think\Controller;
class StartController extends PublicController{

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

    private $where='';

    /**
     * 管理
     */
    public function index(){
        $count=M('start')->count();
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('start')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('page',$show)
             ->assign('list',$list)
             ->assign('bread','引导语列表')
             ->display();
    }

    /**
     * 增加
     */
    public function add(){
        if(!empty($_POST)){
            M('start')->title=I('post.title');
            M('start')->subtitle=I('post.subtitle');
            M('start')->state=0;
            M('start')->time=time();
            $result=M('start')->add();
            if($result){
                $this->success('新增成功');
            }
            else{
                $this->error('新增失败');
            }
        }
        else{
        $this
            ->assign('bread','引导语增加')
            ->display();
        }
    }

    /**
     * 删除
     */
    public function del(){
        M('start')->state=2;
        M('start')->where($this->where)->save();
        $this->redirect('Start/index');
    }

    /**
     * 修改
     */
    public function edit(){

    }

    /**
     * 启用
     */
    public function put(){
        M('start')->state=1;
        M('start')->where($this->where)->save();
        $this->redirect('Start/index');
    }

    /**
     * 禁用
     */
    public function down(){
        M('start')->state=0;
        M('start')->where($this->where)->save();
        $this->redirect('Start/index');
    }
}
