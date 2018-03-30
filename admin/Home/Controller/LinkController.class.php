<?php
namespace Home\Controller;
use Think\Controller;
class linkController extends PublicController{

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
     * 联系方式列表
     */
    public function index(){

        $this->display();
    }
}