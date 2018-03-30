<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends PublicController {

    /**
     * 首页
     */
    public function index(){
      $mview=array();//自定义空数组存放每月数据
      $year=$this->getYears();//获取当前年份
        for ($m=1; $m<=12; $m++) {
            if($m<10){
                $m='0'.$m;
            }
            $last=date("t",strtotime("$year-$m"));//获取每月天数
            $btime=strtotime($year.'-'.$m.'-'.'01 00:00:00');//开始时间
            $etime=strtotime($year.'-'.$m.'-'."$last 23:59:59");//结束时间
            $where['date']=array(array('BETWEEN',array($btime,$etime)));
            $count=M('view')->where($where)->count();//获取每月访问量
            $mview[]=$count;
        };
            $mview=implode(',',$mview);

            $cid=M('columu')->where(array('pid'=>array('neq',0)))->field('id,name')->select();//获取栏目ID
            $type=array();//自定义空数组存放文章类型
            foreach($cid as $key=>$value){
                $concount=M('content')->where(array('columuid'=>$value['id']))->count();//查找该栏目文章数量
                $type[]='{name:'."'".$value['name']."'".',y:'.$concount.'}';
            }
            $type=implode(',',$type);
            //dump($type);die;
            $this->assign('year',$year)
                 ->assign('mview',$mview)
                 ->assign('type',$type)
                 ->assign('bread','首页')
                 ->display();
    }

    /**
    +------------------------------------------------------------------------------
     * 工具方法
    +------------------------------------------------------------------------------
     */

    /**
     * 获取本年年份
     */
    private function getYears(){
        $time=time();//当前时间
        return date('Y',$time);
    }
}