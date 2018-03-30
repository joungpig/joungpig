<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>表格页面 Bootstrap响应式后台管理系统模版Mac - 代码家园-www.daimajiayuan.com</title> 
  <meta name="keywords" content="Bootstrap模版,Bootstrap模版下载,Bootstrap教程,Bootstrap中文,后台管理系统模版,后台模版下载,后台管理系统,后台管理模版" />
  <meta name="description" content="代码家园-www.daimajiayuan.com提供Bootstrap模版,后台管理系统模版,后台管理界面,Bootstrap教程,Bootstrap中文翻译等相关Bootstrap插件下载" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <meta name="author" content="">
  <!--样式-->
  <!-- Stylesheets -->
<link href="/Public/monkey/style/bootstrap.css" rel="stylesheet">
<!-- Font awesome icon -->
<link rel="stylesheet" href="/Public/monkey/style/font-awesome.css">
<!-- jQuery UI -->
<link rel="stylesheet" href="/Public/monkey/style/jquery-ui.css">
<!-- Calendar -->
<link rel="stylesheet" href="/Public/monkey/style/fullcalendar.css">
<!-- prettyPhoto -->
<link rel="stylesheet" href="/Public/monkey/style/prettyPhoto.css">
<!-- Star rating -->
<link rel="stylesheet" href="/Public/monkey/style/rateit.css">
<!-- Date picker -->
<link rel="stylesheet" href="/Public/monkey/style/bootstrap-datetimepicker.min.css">
<!-- CLEditor -->
<link rel="stylesheet" href="/Public/monkey/style/jquery.cleditor.css">
<!-- Bootstrap toggle -->
<link rel="stylesheet" href="/Public/monkey/style/bootstrap-switch.css">
<!-- Main stylesheet -->
<link href="/Public/monkey/style/style.css" rel="stylesheet">
<!-- Widgets stylesheet -->
<link href="/Public/monkey/style/widgets.css" rel="stylesheet">

<link rel="shortcut icon " type="images/x-icon" href="/Public/monkey/img/icons/timg.jpg">
<link href="/Public/monkey/style/bootstrap-multiselect.css" rel="stylesheet">

  <!--样式end-->
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon/favicon.png">
</head>

<body>

<!--导航-->
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">

    <div class="conjtainer">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span>菜单</span>
            </button>
            <!-- Site name for smallar screens -->
            <a href="<?php echo U('Index/Index');?>" class="navbar-brand hidden-lg">首页</a>
        </div>
        <!-- Navigation starts -->
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">

            <ul class="nav navbar-nav">




            </ul>

            <!-- Search form -->

            <!-- Links -->
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown pull-right">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-user"></i><?php echo ($user['username']); ?><b class="caret"></b>
                    </a>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo U('Iogin/modify');?>"><i class="icon-user"></i> 修改密码</a></li>
                        <li><a href="<?php echo U('login/dologout');?>"><i class="icon-off"></i> 退出</a></li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</div>
<!--导航end-->

<!--头部-->
<!-- Header starts -->
<header>
    <div class="container">
        <div class="row">

            <!-- Logo section -->
            <div class="col-md-4">
                <!-- Logo. -->
                <div class="logo">
                    <h1><a href="#">joungpig<span class="bold"></span></a></h1>
                </div>
                <!-- Logo ends -->
            </div>

            <!-- Button section -->


            <!-- Data section -->

            <div class="col-md-8" style="text-align: right">
                <div class="header-data">

                    <!-- Members data -->
                    <div class="hdata">
                        <div class="mcol-left">
                            <!-- Icon with blue background -->
                            <i class="icon-user bblue"></i>
                        </div>
                        <div class="mcol-right">
                            <!-- Number of visitors -->
                            <p><em>登录次数</em><a href="#"><?php echo ($user['count']); ?></a> </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- Traffic data -->
                    <div class="hdata">
                        <div class="mcol-left">
                            <!-- Icon with red background -->
                            <i class="icon-signal bred"></i>
                        </div>
                        <div class="mcol-right">
                            <!-- Number of visitors -->
                            <p><em>上传登录时间</em><a href="#"><?php echo ($logintime); ?></a> </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- revenue data -->
                    <div class="hdata">
                        <div class="mcol-left">
                            <!-- Icon with green background -->
                            <i class="icon-money bgreen"></i>
                        </div>
                        <div class="mcol-right">
                            <!-- Number of visitors -->
                            <p><em>发表文章</em><a href="#"><?php echo ($wcount); ?>篇</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Header ends -->
<!--头部end-->

<!-- Main content starts -->

<div class="content">

     <!--菜单-->
  <!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">导航</a></div>
    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <!--<li class="has_sub"><a href="#"><i class="icon-list-alt"></i>网页数据<span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('Data/data');?>">访问数据</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('Data/data');?>"><i class="icon-home"></i> 网页数据</a></li>
        <!--<li class="has_sub"><a href="#"><i class=" icon-share-alt"></i>引导页<span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
              <!--<li><a href="<?php echo U('Start/index');?>">管理</a></li>-->
              <!--<li><a href="<?php echo U('Start/add');?>">添加</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <!--<li class="has_sub"><a href="#"><i class="icon-book"></i>栏目<span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('columu/index');?>">管理栏目</a></li>-->
                <!--<li><a href="<?php echo U('columu/add');?>">增加栏目</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('columu/index');?>" ><i class="icon-book"></i> 栏目</a></li>
        <li class="has_sub"><a href="#"><i class="icon-home"></i>联系方式<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
            <ul>
                <li><a href="<?php echo U('fuli/index');?>">福利</a></li>
                <li><a href="<?php echo U('link/index');?>">联系方式</a></li>
                <li><a href="<?php echo U('weixing/index');?>">微信公众号图片</a></li>
            </ul>
        </li>

        <!--<li class="has_sub"><a href="#"><i class="icon-circle-arrow-down"></i> 脚部 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('foot/index');?>">友情管理</a></li>-->
                <!--<li><a href="statement.html">网站备案</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('foot/index');?>" ><i class="icon-circle-arrow-down"></i>脚部</a></li>
        <!--<li class="has_sub"><a href="#"><i class="icon-calendar"></i> 文章管理  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('article/index');?>">文章管理</a></li>-->
                <!--&lt;!&ndash;<li><a href="<?php echo U('article/add');?>">增加文章</a></li>&ndash;&gt;-->
                <!--<li><a href="<?php echo U('article/type');?>">文章类型</a></li>-->
                <!--<li><a href="<?php echo U('article/tag');?>">文章标签</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('article/index');?>" ><i class="icon-calendar"></i>文章</a></li>
        <!--<li class="has_sub"><a href="#"><i class="icon-user"></i> 用户 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('user/index');?>">用户管理</a></li>-->
                <!--<li><a href="<?php echo U('user/add');?>">增加用户</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('user/index');?>" ><i class="icon-user"></i>用户</a></li>
        <!--<li class="has_sub"><a href="#"><i class="icon-wrench"></i> 网站SEO<span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="media.html">用户管理</a></li>-->
                <!--<li><a href="media.html">增加用户</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('columu/index');?>" ><i class="icon-wrench"></i>网站SEO</a></li>
    </ul>
</div>

<!-- Sidebar ends -->
  <!--菜单end-->

  	<!-- Main bar -->
  	<div class="mainbar">

      <!--面包屑导航-->

      <div class="page-head">
    <a href="<?php echo U('Index/Index');?>" style="text-decoration:none;color: black"><h2 class="pull-left"><i class="icon-home"></i> 首页</h2></a>

    <!-- Breadcrumb -->
    <div class="bread-crumb pull-right">
        <a href="<?php echo U('Index/Index');?>"><i class="icon-home"></i> 首页</a>
        <!-- Divider -->
        <span class="divider">/</span>
        <a href="#" class="bread-current"><?php echo ($bread); ?></a>
    </div>
    <div class="clearfix"></div>

</div>

      <!--面包屑导航end-->

	    <!-- Matter -->

	    <div class="matter">
        <div class="container">

          <!-- Table -->

            <div class="row">

              <div class="col-md-12">

                <div class="widget">

                <div class="widget-head">
                  <div class="pull-left">栏目</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>  
                  <div class="clearfix"></div>
                </div>

                  <div class="widget-content">

                    <table class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>栏目名称</th>
                          <th>登录次数</th>
                          <th>登录IP</th>
                          <th>上次登录时间</th>
                          <th>状态</th>
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                          <td><?php echo ($vo["id"]); ?></td>
                          <td><?php echo ($vo["username"]); ?></td>
                          <td><?php echo ($vo["count"]); ?></td>
                          <td><?php echo ($vo["ip"]); ?></td>
                          <td><?php echo ($_SESSION['logintime']); ?></td>
                          <td>
                            <?php if($vo['state'] == 1): ?><span class="label label-success">启用</span><?php endif; ?>
                          <?php if($vo['state'] == 0): ?><span class="label label-warning">未启用</span><?php endif; ?>
                          <?php if($vo['state'] == 2): ?><span class="label label-danger">删除</span><?php endif; ?>
                          <td>

                              <a  href="<?php echo U('user/put', array('id'=>$vo['id']));?>"  class="btn btn-xs btn-success"><i class="icon-ok"></i> </a>
                              <a  href="<?php echo U('user/down', array('id'=>$vo['id']));?>" class="btn btn-xs btn-info"><i class="icon-arrow-down"></i> </a>
                              <a  href="<?php echo U('user/del', array('id'=>$vo['id']));?>"  class="btn btn-xs btn-danger"><i class="icon-remove"></i> </a>
                              <a  href="<?php echo U('user/edit', array('id'=>$vo['id']));?>" class="btn btn-xs btn-warning"><i class="icon-pencil"></i> </a>
                          
                          </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                      </tbody>
                    </table>

                    <div class="widget-foot">

                     
                        <ul class="pagination pull-right">
                          <?php echo ($page); ?>
                        </ul>
                      <a href="<?php echo U('article/add');?>" class="btn btn-default">添加用户</a>
                      <div class="clearfix"></div> 

                    </div>

                  </div>

                </div>


              </div>

            </div>




        </div>
		  </div>

		<!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->	    	
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!--foot-->
<!-- Footer starts -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Copyright info -->
                <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
            </div>
        </div>
    </div>
</footer>
<!--foot end-->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

<!--js-->
<!-- JS -->
<script src="/Public/monkey/js/jquery.js"></script> <!-- jQuery -->
<script src="/Public/monkey/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="/Public/monkey/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="/Public/monkey/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="/Public/monkey/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="/Public/monkey/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="/Public/monkey/js/excanvas.min.js"></script>
<script src="/Public/monkey/js/jquery.flot.js"></script>
<script src="/Public/monkey/js/jquery.flot.resize.js"></script>
<script src="/Public/monkey/js/jquery.flot.pie.js"></script>
<script src="/Public/monkey/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="/Public/monkey/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="/Public/monkey/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="/Public/monkey/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="/Public/monkey/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="/Public/monkey/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="/Public/monkey/js/sparklines.js"></script> <!-- Sparklines -->
<script src="/Public/monkey/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="/Public/monkey/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="/Public/monkey/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="/Public/monkey/js/filter.js"></script> <!-- Filter for support page -->
<script src="/Public/monkey/js/custom.js"></script> <!-- Custom codes -->
<script src="/Public/monkey/js/charts.js"></script> <!-- Charts & Graphs -->
<script src="/Public/monkey/js/bootstrap-multiselect.js"></script>




<!-- Script for this page -->
<!--js end-->


</body>
</html>