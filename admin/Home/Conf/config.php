<?php
return array(
    //'配置项'=>'配置值'
    //'配置项'=>'配置值'
    //模板常量定义
    'TMPL_PARSE_STRING'=>array(
        '__ADMIN__'=>"Public/Admin",
        '__Knowledge__'=>"Public/Knowledge",
        '__Backstage__'=>"Public/Admin/Backstage",
        '__Common__'=>"Public/common",
    ),
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '120.76.47.170', // 服务器地址
    'DB_NAME'               =>  'joungpig',  // 数据库名
    'DB_USER'               =>  'root',    // 用户名
    'DB_PWD'                =>  'jpjiudian!@#',   // 密码
    'DB_PORT'               =>  '3306',      // 端口
    'DB_PREFIX'             =>  'joung_',    // 数据库表前缀
    //'SHOW_PAGE_TRACE'       =>  true,

    'DEFAULT_MODULE'        =>  'Home',     // 默认模块
    'DEFAULT_CONTROLLER'    =>  'login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称

    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES' => array(
        //'Index/:name'    => 'News/read',
        'content/:id\d'    => 'Admin/Content/content',
    ),

    //微信变量配置
    'APPID'      => 'wxe975188924ef4120', //appid
    'APPSECRET' => 'f75d9d585dd44c29c6828d84ee87675e',//appsecret

    //支付宝设置
    'AliPayconfig' => array (
        //应用ID,您的APPID。
        'app_id' => "2016091200496342",

        //商户私钥
        'merchant_private_key' => "MIIEpAIBAAKCAQEAzgj/mjAj6AxxkaZZpp5qYaENbRP5OA0bA8rJokN0ilWalrfw993aVe72eG2mQem0wkKPkxuT6nvoYi5S0sTxRKxhQwSFEHAw/uvHWGkS0FPVktek9wWgkhjQP8laBFHX1KaOwixrQ9CPhHobkRsimhyYkbc6WfniZdHrJZHkZZoRWBashH+udOWGSzwmOLjMPrlAlsh3pYQwJAWTi2mSpMq1EP6f/4PSyqzJ1mYxlNSs04ce6KpGvCk3nImS8vhUq0R8OmuUDcRMznHJ2dCmgTM9RbeAUAu21YfHH41nv8gtBkTKuj9hkDqFPGGWrylZxIm5AmwqYhacvlqQRxWyIwIDAQABAoIBAQCvMC2OQHK3g6UpkEXYjAiunM+auQoG4/XdgpdyNmMooONCVoM5b1WQDhFakvl0QDDnoMsN7bwW/Ga63OKlvrnbh6tn3bb7JDo09+xXu3g41Z/bLStis1E2CI1CP4Yf+CtJ8Jmgdz55uiPeJCm+d1Ezsy7zb9XY3cXoh9am6mdHD3QlUV8s1bZBsnG3RlqKGOHd5sPW6ikZoZoM+ibzJsvrIZo5Zi3PPpWeMiu32vk8sDOEvUtEq9q5nzvIMz4nm0r4mwaGVQ63Us05Zx8XbSOQXVDkUk2kzP6WeHyLFmdq6ALKEW6Wjt3cLYr9+MgrsYhT3JzXQi9nGO3O7zf8JBixAoGBAOlVFzlYy62XxDEg8vXClhgYJ9N1Ibq+35y/pSYifJ6gDAEYAo4iqk8s3fwpZyVLL3nj0Y0m09S4sPMUZCnCz5KMHrVYwMz5+X68K16tiKjxdhCaGi9j45p8IuDpGWZZ/TkX7wjPvZaf77PlhLLO8aUK5JiD517eebAkxky5XY8bAoGBAOINCIjW8KJo1bMv4Yy+UaeJW+AXx2H5HLEOsqaiwq7/sGxbXh5JmMRf0nXr2RnqPWymoi/yXQibXZkFwBDdYyQAbEjpp0NVcUizzqtinitNL7hGLtXfPXPfKVtE/R/faqoM1DCyDdH2b+nVA8qXy3P/qF33iups/skpmuvCxTGZAoGASUSJ5V0Hn/vvBEpHYHp4rRowr0qxi7VR/COFlULxBNJW0qUacE1cUz5QelT56ZEBWHH8JCmUDNDt53Z4uVBN48OSBPnYmMTJ3kzyBWnSZtJjc3UgUc848hKW1S785dHOHPZx/b9V1g1ktIWWtJsc7+lKvMV2iqirZ280wXTXdw8CgYBstzX2keETSvYUAqAoT1P4DlC4etcyYFuTL+1txPN6tJAF3P9r85tcPnV6rx4vn39BJPb1tktWG1qtgJ15vu+yXd22R2FhOdOM0qU/ueM2Eh40MtTNmVr1wksikRBn5sxm0lquvMN2yl3SiNcU9WIs/LTd1HLkAd2bo73VS0wJaQKBgQCnPtc3+7q3er4x8YKMtqNaskMFldXu3pbqGXOXwseszeEXNIaiRGD9M9yaRsV4SMatP5M/p+CU9FLwfOwJOLfzFsQut72wQrB91YtNV7DpNA2iK1l1+vpayKbyHDz03Pdbd58cIcg+j/rli2sCvW+iXdoLrS9GJ++4Ee8YAbsTPg==",

        //异步通知地址
        'notify_url' => "http://www.joungpig.com/ComAlipay/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

        //同步跳转
        'return_url' => "http://www.joungpig.com/ComAlipay/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4UOuZ4EKfv1jNhd5XZVsNIhjTKaJEARHE8fj+NUxvGGoq+UAVvkljHQ9kRv3BjuOlaniMmc2qohMSAuhR0golEEvOWvD1q9i+gs7BR+s2+z4/HnKxLXILhk1h3K8mv00wnavBn4puiPg87cftgbnKrmIPB7JzDxYvFNSby5zo7EphT5k/pL8MvsPhWBCUbrCnsGUknMnRtiMtOq+8hXDemAg341y1G7d15NjFr7gMZrK7bESS4yU42QhXadVxwXoymyFg1jmV8fG5R/poGpz3oBp4muhce8EI7zv6ALoYl+6JcTisVUrOo4XRAiNkWsAXI+KxS4ZLFalqD2CCE4MrwIDAQAB",
    ),

    //微信
    'WEIXIN' => array(
        'APPID'=>'wx56c193d095bc3c3a',//公众账号ID
        'APPSECRET'=>'ebe32e9078c4a30da6ccbaa210d17fcd',//公众账号识别
        'URL'=>'http://www.91csy.com/mobile.php/Weixin/index',//第一次访问公众号的地址
        'TOKEN'=>'csy2088',//第一次访问公众号的地址
        'MCHID'=>'1461551502',//微信商户号
        'KEY'=>'CSY2016010120161231csy1234567890',//微信支付key
        'TEMPLATEID'=>'kVB9C9Pu_L7wm729G3KLm3QsjdP2bh8ndLbUkLWOK24',//模板消息ID(订单)
        'TEMPLATEIDB'=>'nTTXsui2ujBKQAAH_hyBhw3r_PPvlb1mFjq7pbBjO88',//模版ID(服务)
        'TEMPLATEIDC'=>'sowDEbyZDO7SfV-LCOOq09IwKOBfa_TDGEvS_S-cCCg',//模版ID(积分)
    ),

//    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
//    'URL_CASE_INSENSITIVE'  =>  true,
    'URL_MODEL'=>0,
);