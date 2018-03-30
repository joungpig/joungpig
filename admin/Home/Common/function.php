<?php
    
   //�ݹ齫һά����תΪ��ά����
/**
 *@param[type]    $list[����Ľ�����]
 *@param[integtr] $pid[����ID]
 *@return 
*/
  function node_merge($list,$pid=0){
	 
	  $arr=array();
	  foreach($list as $v){
		  if($v['pid']==$pid){
			  $v['child']=node_merge($list,$v['id']);
			  $arr[]=$v;
			  
		  }
	  }
	  return $arr;
  }

  /**
 * ���û���������м���
 * @param $password
 * @param $encrypt //������ܴ������޸�����ʱ����֤
 * @return array/password
 */
function get_login($password,$encrypt='') {
	
    $pwd = array();
	
    $pwd['encrypt'] =  $encrypt ? $encrypt :get_randomstr();
	
    $pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
	
    return $encrypt ? $pwd['password']:$pwd;
	
}

/**
 * ��������ַ���
 * @param string $lenth ����
 * @return string �ַ���
 */
function get_randomstr($lenth = 6) {
    return get_random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
* ��������ַ���
*
* @param    int        $length  �������
* @param    string     $chars   ��ѡ�� ��Ĭ��Ϊ 0123456789
* @return   string     �ַ���
*/
function get_random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

//获取名字
function get_name($model, $id)
{
    $name = M($model)->where(array('id' => $id))->getField('name');
    if($name){
        return $name;
    }else{
        return '没有数据';
    }

}

/**
 * 处理文章简介部分
 * @param $str
 * @return string
 */
function get_sum($str){
    $str=strip_tags($str);
    $str=mb_substr($str, 0, 150, 'utf-8');
    return $str;
}

/**
 * @param $tagid 标签id
 * @param $type  标签1和标签2
 */
function tl($tagid,$type){
    $where['id']=array('in',$tagid);
    $tag=M('tag')->where($where)->limit(2)->select();
    if($type==1){
        return $tag['0']['name'];
    }
    if($type==2){
        return $tag['1']['name'];
    }
}

/**
 * 默认标签选择
 */
function ct($id,$in){
    $in=explode(",",$in);
    if(in_array($id,$in)){
        return 'checked';
    }

}

/**
 * 获取作者名称
 * @param $uid
 * @return mixed
 * @author joungpig
 * @date @Date&Time ct。
 */
function getName($uid){
    $name=M('user')->where(array('id'=>$uid))->getField('username');
    return $name;
}

/**
 * @desc 写支付日志到log/debug/下
 * @author sujiamin
 * @date 2016-03-26
 * @param string $filename 文件名,命名规范：模块名_控制器名_函数名.log,要小写,如:person_index_personregister.log
 * @param Array $data 日志数据
 * @param int $data_type 数据类型， 1:计算参数，2:参数计算结果，3：其他内容,4:自定义标记位
 * @param string $tag 标记位
 */
function writePayLog($filename,$data,$data_type,$tag=''){
    $fileDir = './Public/'. 'log/debug/'.Date("Y-m-d").'/';
    createFolders($fileDir);
    $filename= $fileDir.$filename;   //一天写一个日志文件
    $content = "";
    if(empty($data)){
        $content = "write content is empty";
    }else if(is_string($data)){
        $content = $data;
    }else{
        $content = json_encode($data);
    }

    if($data_type == 1){
        file_put_contents($filename, "------------------------------------------\r\n",FILE_APPEND);
        file_put_contents($filename, "time:".date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
        file_put_contents($filename, "params:".$content."\r\n",FILE_APPEND);
    }elseif($data_type == 2){
        file_put_contents($filename, "result:".$content."\r\n",FILE_APPEND);
    }elseif($data_type == 4 && $tag){
        $content = sprintf("%s : %s\r\n",$tag,$content);
        file_put_contents($filename, $content,FILE_APPEND);
    }
    else{
        file_put_contents($filename, "others:".$content."\r\n",FILE_APPEND);
    }
}

/**
 * 创建多级文件夹
 * @author Jec
 * @date 2016-04-05
 * @param String $dir
 * @param Num $mode 权限
 * @return boolean;
 */
function createFolders($dir, $mode=0777){
    return is_dir($dir) or (createFolders(dirname($dir)) and @mkdir($dir, $mode));
}

/**
 * 功能:无限级分类
 * 参数:$data 类别查询结果集
 * 返回值:$arr 排序后的数组
 */
function getCateTree($data) {
    $arr = cateSort($data);
    return $arr;
}

/**
 * 功能:无限级分类排序
 * 参数:$data 类别查询结果集
 * 返回值:$arr 递归查询排序后的数组
 */
function cateSort($data,$pid=0,$level=0) {
    static $arr = array();
    foreach($data as $k => $v) {
        if($v['pid'] == $pid) {
            $arr[$k] = $v;
            $arr[$k]['level'] = $level + 1;
            cateSort($data,$v['id'],$level+1);
        }
    }
    return $arr;
}