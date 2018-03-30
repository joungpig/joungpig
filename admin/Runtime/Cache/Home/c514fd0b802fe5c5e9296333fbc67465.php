<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>www.joungpig.com后台管理系统</title> 
  <meta name="author" content="">

  <!--样式-->
  <!-- Stylesheets -->
<link href="Public/Admin/style/bootstrap.css" rel="stylesheet">
<!-- Font awesome icon -->
<link rel="stylesheet" href="Public/Admin/style/font-awesome.css">
<!-- jQuery UI -->
<link rel="stylesheet" href="Public/Admin/style/jquery-ui.css">
<!-- Calendar -->
<link rel="stylesheet" href="Public/Admin/style/fullcalendar.css">
<!-- prettyPhoto -->
<link rel="stylesheet" href="Public/Admin/style/prettyPhoto.css">
<!-- Star rating -->
<link rel="stylesheet" href="Public/Admin/style/rateit.css">
<!-- Date picker -->
<link rel="stylesheet" href="Public/Admin/style/bootstrap-datetimepicker.min.css">
<!-- CLEditor -->
<link rel="stylesheet" href="Public/Admin/style/jquery.cleditor.css">
<!-- Bootstrap toggle -->
<link rel="stylesheet" href="Public/Admin/style/bootstrap-switch.css">
<!-- Main stylesheet -->
<link href="Public/Admin/style/style.css" rel="stylesheet">
<!-- Widgets stylesheet -->
<link href="Public/Admin/style/widgets.css" rel="stylesheet">

<link rel="shortcut icon " type="images/x-icon" href="/Public/monkey/img/icons/timg.jpg">
<link href="Public/Admin/style/bootstrap-multiselect.css" rel="stylesheet">
<style>
    th{text-align: center;}
    td{text-align: center;}
    #editor_panel {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        z-index: 1001;
        border-left: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0px 0px 24px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    #editor_panel {
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        z-index: 1001;
        border-left: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0px 0px 24px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    #editor_panel_body {
        width: 900px;
        height: 100%;
        margin-right: -1000px;
        margin-top: 67px;
    }

    #editor_panel_body iframe {
        width: 100%;
        height: 100%;
    }
</style>
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
                    <h1><a href="#"><span class="bold" style="margin-right: 2%;"><img src="Public/Admin/logo.png" width="60" height="60"></span>圣云后台</a></h1>
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
                            <p><em>上次登录时间</em><a href="#"><?php echo ($logintime); ?></a> </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- revenue data -->
                    <!--<div class="hdata">-->
                        <!--<div class="mcol-left">-->
                            <!--&lt;!&ndash; Icon with green background &ndash;&gt;-->
                            <!--<i class="icon-money bgreen"></i>-->
                        <!--</div>-->
                        <!--<div class="mcol-right">-->
                            <!--&lt;!&ndash; Number of visitors &ndash;&gt;-->
                            <!--<p><em>发表文章</em><a href="#"><?php echo ($wcount); ?>篇</a></p>-->
                        <!--</div>-->
                        <!--<div class="clearfix"></div>-->
                    <!--</div>-->
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
        <li><a href="<?php echo U('Data/data');?>" ><i class="icon-home"></i> 网页数据</a></li>
        <li><a href="<?php echo U('user/index');?>" ><i class="icon-user"></i>用户</a></li>
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
        <li><a href="<?php echo U('nav/index');?>" ><i class="icon-search"></i> 导航</a></li>
        <li><a href="<?php echo U('article/index');?>" ><i class="icon-calendar"></i>文章</a></li>
        <li><a href="<?php echo U('fuli/index');?>"><i class="icon-home"></i>福利</a></li>
        <!--<li class="has_sub"><a href="#"><i class="icon-circle-arrow-down"></i> 脚部 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('foot/index');?>">友情管理</a></li>-->
                <!--<li><a href="statement.html">网站备案</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <li><a href="<?php echo U('foot/index');?>" ><i class="icon-circle-arrow-down"></i>友情连接</a></li>
        <!--<li class="has_sub"><a href="#"><i class="icon-calendar"></i> 文章管理  <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('article/index');?>">文章管理</a></li>-->
                <!--&lt;!&ndash;<li><a href="<?php echo U('article/add');?>">增加文章</a></li>&ndash;&gt;-->
                <!--<li><a href="<?php echo U('article/type');?>">文章类型</a></li>-->
                <!--<li><a href="<?php echo U('article/tag');?>">文章标签</a></li>-->
            <!--</ul>-->
        <!--</li>-->

        <!--<li class="has_sub"><a href="#"><i class="icon-user"></i> 用户 <span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="<?php echo U('user/index');?>">用户管理</a></li>-->
                <!--<li><a href="<?php echo U('user/add');?>">增加用户</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <!--<li class="has_sub"><a href="#"><i class="icon-wrench"></i> 网站SEO<span class="pull-right"><i class="icon-chevron-right"></i></span></a>-->
            <!--<ul>-->
                <!--<li><a href="media.html">用户管理</a></li>-->
                <!--<li><a href="media.html">增加用户</a></li>-->
            <!--</ul>-->
        <!--</li>-->
        <!--<li><a href="<?php echo U('columu/index');?>" ><i class="icon-wrench"></i>网站SEO</a></li>-->
        <li><a href="<?php echo U('wx/wxController');?>" ><i class="icon-comment"></i>微信公众号</a></li>
        <li><a href="<?php echo U('Alipay/index');?>" ><i class="icon-shopping-cart"></i>支付宝支付</a></li>
        <!--<li><a href="<?php echo U('WxAay/index');?>" ><i class="icon-shopping-cart"></i>微信支付</a></li>-->
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

          <div class="row">
            <div class="col-md-12">
              <div class="widget wgreen">
                <div class="widget-head">
                  <div class="pull-left">条件筛选</div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <hr />
                    <!-- Form starts.  -->
                    <!--form action="<<?php echo U('Consultancy/index');?>>" method="get" class="form-horizontal" role="form"-->
                    <form id="check"  method="get" class="form-horizontal"  action="<?php echo U('article/index');?>">
                      <!--类型-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">类型</label>
                          <div class="col-lg-8">
                            <select class="form-control" data-style="btn-inverse" name="type">
                              <option value=""  <?php if($_GET['type'] == '' ): ?>selected = "selected"<?php endif; ?>>类型查询</option>
                              <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $_GET['type']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">文章列表</label>
                          <div class="col-lg-8">
                            <select class="form-control" data-style="btn-inverse" name="columuid">
                              <option value="" <?php if($_GET['columuid'] == '' ): ?>selected = "selected"<?php endif; ?>>栏目查询</option>
                              <?php if(is_array($columuid)): $i = 0; $__LIST__ = $columuid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $_GET['columuid']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">作者</label>
                          <div class="col-lg-8">
                            <select class="form-control" data-style="btn-inverse" name="uid">
                              <option value="" <?php if($_GET['uid'] == '' ): ?>selected = "selected"<?php endif; ?>>作者查询</option>
                              <?php if(is_array($uid)): $i = 0; $__LIST__ = $uid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $_GET['uid']): ?>selected<?php endif; ?>><?php echo ($vo["username"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">状态</label>
                          <div class="col-lg-8">
                            <select class="form-control" data-style="btn-inverse" name="state">
                              <option value="" <?php if($_GET['state'] == ''): ?>selected = "selected"<?php endif; ?>>平台查询</option>
                                <option value="1" <?php if($_GET['state'] == 1): ?>selected = "selected"<?php endif; ?>>启用</option>
                                <option value="2" <?php if($_GET['state'] == 2): ?>selected = "selected"<?php endif; ?>>禁用</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <!--类型END-->
                      <div class="col-md-12">
                        <hr/>
                      </div>
                      <!--分配人员和接单人员-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">输入关键字</label>
                          <div class="col-lg-8">
                            <input placeholder="输入关键字" name="search" class="form-control"  value="<?php echo ($_GET['search']); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="clearfix"></div>

                      <div class="clearfix"></div>
                      <div class="col-md-12">
                        <hr/>
                      </div>
                      <!--分配人员和接单人员END-->


                      <!--时间-->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">开始日期</label>
                          <div class="col-lg-8">
                            <input placeholder="请选择开始日期" name="data1" class="form-control" onclick="laydate()" value="<?php echo ($_GET['data1']); ?>">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">结束日期</label>
                          <div class="col-lg-8">
                            <input placeholder="请选择结束日期" name="data2" class="form-control" onclick="laydate()" value="<?php echo ($_GET['data2']); ?>">
                          </div>
                        </div>
                      </div>
                      <!--时间END-->
                      <div class="form-group">
                      </div>
                  </div>
                </div>

                <div class="widget-foot">
                  <!--button type="submit" class="btn btn-success">提交</button-->
                  <input name="sub" type="submit" class="btn btn-default" value="提交">
                  <a id="add" class="btn btn-default">新增文章</a>
                  <a href="<?php echo U('article/type');?>" class="btn btn-default">类型</a>
                  <a href="<?php echo U('article/tag');?>" class="btn btn-default">标签</a>
                  <!--<input name="sub" type="submit" class="btn btn-default" value="批量启用">-->
                  <!--<input name="sub" type="submit" class="btn btn-default" value="批量禁用">-->
                </div>
              </div>
              </form>
          <!-- Table -->
            <div class="row">
              <div class="col-md-12">
                <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">文章（<?php echo ($count); ?>）</div>
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
                          <th class="col-lg-1">#</th>
                          <th class="col-lg-4">文章标题</th>
                          <th class="col-lg-1">作者</th>
                          <th class="col-lg-1">类型</th>
                          <th class="col-lg-1">栏目</th>
                          <th class="col-lg-1">访问量</th>
                          <th class="col-lg-1">添加时间</th>
                          <th class="col-lg-1">标签</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="<?php echo ($vo["class"]); ?>" id="<?php echo ($vo["id"]); ?>">
                          <td><?php echo ($vo["id"]); ?></td>
                          <td><a style="color:#ff9f00;" class="openRecord" url="<?php echo U('article/edit',array('id'=>'accountId'));?>"><?php echo ($vo["title"]); ?></a>
                          <?php echo ($vo["mark"]); ?>
                          </td>
                          <td><?php echo (getName($vo["uid"])); ?></td>
                          <td><?php echo (get_name(type,$vo["type"])); ?></td>
                          <td><?php echo (get_name(columu,$vo["columuid"])); ?></td>
                          <td><?php echo ($vo["view"]); ?></td>
                          <td><?php echo ($vo["time"]); ?></td>
                          <td><?php echo (tl($vo["tag"],1)); ?>,<?php echo (tl($vo["tag"],2)); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                      </tbody>
                    </table>

                    <div class="widget-foot">

                     
                        <ul class="pagination pull-right">
                          <?php echo ($page); ?>
                        </ul>
                     
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
      <script src="Public/Admin/js/laydate.js"></script> <!-- Charts & Graphs -->
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
<script src="Public/Admin/js/jquery.js"></script> <!-- jQuery -->
<script src="Public/Admin/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="Public/Admin/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="Public/Admin/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="Public/Admin/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="Public/Admin/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="Public/Admin/js/excanvas.min.js"></script>
<script src="Public/Admin/js/jquery.flot.js"></script>
<script src="Public/Admin/js/jquery.flot.resize.js"></script>
<script src="Public/Admin/js/jquery.flot.pie.js"></script>
<script src="Public/Admin/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="Public/Admin/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="Public/Admin/js/themes/default.js"></script> <!-- jQuery Notify -->
<script src="Public/Admin/js/layouts/bottom.js"></script> <!-- jQuery Notify -->
<script src="Public/Admin/js/layouts/topRight.js"></script> <!-- jQuery Notify -->
<script src="Public/Admin/js/layouts/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="Public/Admin/js/sparklines.js"></script> <!-- Sparklines -->
<script src="Public/Admin/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="Public/Admin/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="Public/Admin/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="Public/Admin/js/filter.js"></script> <!-- Filter for support page -->
<script src="Public/Admin/js/custom.js"></script> <!-- Custom codes -->
<script src="Public/Admin/js/charts.js"></script> <!-- Charts & Graphs -->
<script src="Public/Admin/js/bootstrap-multiselect.js"></script>

<script src="Public/common/layer/layer.js"></script>


<!-- Script for this page -->
<!--js end-->

</div></div>

<div id="editor_panel">
  <div id="editor_panel_body" style="margin-right: -1300px;width: 1300px;" >
    <iframe src="" frameborder="0" id="account-iframe"></iframe>
  </div>
</div>

<script>
  $("#add").click(function(){
    var url = "<?php echo U('article/add');?>";
    layer.open({
      type: 2,
      title: '添加文章',
      closeBtn: 0, //不显示关闭按钮
      //shadeClose: true,
      shade: [0],
      area: ['1700px', '700px'],
      //offset: 'rb', //右下角弹出
      //time: 2000, //2秒后自动关闭
      anim: 2,
      content: [url], //iframe的url，no代表不显示滚动条
    });
  });
</script>

<script>
  $('.openRecord').click(function(event){
    var index = layer.load(2, {
      content: '数据加载中',
      shade: [0.4, '#393D49'],
      // time: 10 * 1000,
      success: function(layero) {
        layero.css('padding-left', '30px');
        layero.find('.layui-layer-content').css({
          'padding-top': '40px',
          'width': '70px',
          'background-position-x': '16px'
        });
      }
    })
    var _iframe = $('#editor_panel_body iframe');
    //获取这个职工的id
    accountId = $(this).parents('tr').attr('id');
    //生成url链接
    var url=$(this ).attr('url');
    //替换参数
    str1 =  url.replace("accountId",accountId);
    openEditorPanel(_iframe, str1, event);
    layer.close(index);
  });

  function openEditorPanel(iframe, iframeSrc, event) {
    $('#editor_panel_body').animate({'margin-right':0});
    $(document.body).addClass('modal-open'); // 禁止显示垂直滚动条
    iframe.attr('src', iframeSrc);
    event.stopPropagation();
  }

  function closeEditorPanel() {
    $('#editor_panel_body').animate({'margin-right':-1300});
    $(document.body).removeClass('modal-open'); // 取消禁止显示垂直滚动条
  }

  $(document).click(function(event){
    var _con = $('#editor_panel_body iframe');   // 设置目标区域
    if(!_con.is(event.target) && _con.has(event.target).length === 0){ // Mark 1
      closeEditorPanel();         //淡出消失
    }
  });
</script>

</body>
</html>