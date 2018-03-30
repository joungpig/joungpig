<?php
namespace Home\Controller;
use Think\Controller;
class DataController extends PublicController {
    /**
     * 数据统计模块
     */
    public function data(){
        //历史总访问量
        $count=M('view')->count();
        //历史访问人数
        $ip=M('view')->count('DISTINCT ip');
        //今日访问量
        $time=date("Y-m-d",time());
        $time=strtotime($time);//转换为时间错
        $tomorrow=$time+24*60*60;
        $how=array($time,$tomorrow);
        $where['date']=array('between',$how);
        $today=M('view')->where($where)->count();
        //获取所有访问记录
        $Page = new \Think\Page($count,20);
        $Page->rollPage=10;
        $show = $Page->show();
        $list=M('view')->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('count',$count)
             ->assign('ip',$ip)
             ->assign('today',$today)
             ->assign('page',$show)
             ->assign('list',$list)
             ->assign('bread','访问数据');
        $this->display();
    }
}