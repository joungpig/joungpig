<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "joungpig");
$wechatObj = new wechatCallbackapiTest();
// 注释掉验证的方法
//$wechatObj->valid();
// 开启回复消息的方法
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	//验证
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }
	
	// 回复消息
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; // 可理解为获取post过来的数据，相当于$_POST

		//extract post data
		if (!empty($postStr)){
			/* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
			   the best way is to check the validity of xml by yourself */
			//读取并解释消息
			libxml_disable_entity_loader(true);
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);// 将XML字符串转成XML对象
			
			$fromUsername = $postObj->FromUserName; // 开发者微信号
			$toUsername = $postObj->ToUserName; // 开发者微信号(公众号设置->原始ID->gh_4b8638c6808e)
			$keyword = trim($postObj->Content); // 用户输入的内容
			
			//组装并回复消息	
			$time = time();
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";			
							
			/*if(!empty( $keyword ))
			{
				$msgType = "text";
				$contentStr = "Welcome to wechat world!";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $postStr);
				echo $resultStr;
			}else{
				echo "Input something..."; // 直接输出文本是不成功的
			}*/
			$msgType = "text";
			if(!empty( $keyword ))
			{
				$contentStr = "Welcome to wechat world!";
			}else{
				$contentStr = "Input something...";
			}
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;	
			
			if($postObj->MsgType == 'text')
			{
				if($keyword == '?')
				{
					$contentStr = "回复1 特种服务号码\n回复2 通讯服务号码\n回复3 银行服务号码\n回复4 用户反馈";
				}elseif($keyword == '1')
				{
					$contentStr = "匪警 110； 火警120"; //
				}
				else{
					// 接入图灵机器人
					$url = "http://www.tuling123.com/openapi/api?key=fb7cf7c7136b46fea4db80154b05df47&info=$keyword";
					$contentStr = file_get_contents($url);
					// {"code":100000,"text":"静静漂亮吗"}
					// 转成数组
					$arr = json_decode($contentStr, true);
					$contentStr = $arr['text'];
				}
			}
			elseif($postObj->MsgType == 'image')
			{
				$contentStr = "您发的是图片，很漂亮";
			}
			
			elseif($postObj->MsgType == 'link')
			{
				$contentStr = "您发的是链接，不会是病毒吧？？";
			}
				
			

        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>