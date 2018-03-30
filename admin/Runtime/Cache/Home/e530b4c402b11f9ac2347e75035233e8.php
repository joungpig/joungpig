<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
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

    <!--&lt;!&ndash; 上传样式 &ndash;&gt;-->
    <!--<link rel="stylesheet" href="/Public/monkey/uploadify/uploadify.css" />-->
    <!--&lt;!&ndash; 上传样式END &ndash;&gt;-->

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

          <div class="row">

            <div class="col-md-12">


              <div class="widget wgreen">
                
                <div class="widget-head">
                  <div class="pull-left">增加文章</div>
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
                     <form class="form-horizontal" role="form" action="<?php echo U('article/add');?>" method="post" id="addfrom">
                         <!--标题-->
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">标题</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" placeholder="请输入标题" name="title" required>
                                  </div>
                                </div>
                         <!--标题END-->
                         <!--&lt;!&ndash;作者&ndash;&gt;-->
                                 <!--<div class="form-group">-->
                                     <!--<label class="col-lg-4 control-label">作者</label>-->
                                     <!--<div class="col-lg-8">-->
                                         <!--<input type="text" class="form-control" placeholder="请输作者" name="author" required>-->
                                     <!--</div>-->
                                 <!--</div>-->
                         <!--&lt;!&ndash;作者END&ndash;&gt;-->
                         <!--文章-->
                                <div class="form-group">
                                  <label class="col-lg-4 control-label">文章内容</label>
                                  <div class="col-lg-8">
                                      <script id="article-content" name="content" type="text/plain"></script>
                                  </div>
                                </div>
                         <!--文章END-->
                         <!--标签选择-->
                         <div class="form-group">
                             <label class="col-lg-4 control-label">标签选择</label>
                             <div class="col-lg-8">
                                 <!--<?php if(is_array($tag)): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                                 <!--<label style="margin-top: 1%;margin-left:1%"><input  type="checkbox" value="<?php echo ($vo["id"]); ?>" name="tagid[]"/><?php echo ($vo["name"]); ?> </label>-->
                                 <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                                 <select id="example-getting-started" multiple="multiple" name="tagid[]">
                                     <?php if(is_array($tag)): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                 </select>
                             </div>

                         </div>
                         <!--封面-->
                                 <div class="form-group">
                                     <label class="col-lg-4 control-label">上传封面</label>
                                     <div class="col-lg-8">
                                         <!--<input type="file" class="upload" id="upload"  value="测试" >-->
                                         <label style="font-weight: bold; border: 1px dashed #d3d3d3;padding: 10px;color: #d3d3d3;" onclick="upload(1)" id="title1"><i class="fa fa-plus"></i>点击上传</label><p style="color: #c8c8c8;">[上传资料文件不能超过2M]</p>
                                         <input type="file" id="idcarda1" style="display: none;">
                                     </div>
                                 </div>
                         <!--封面END-->
                         <div class="form-group">
                             <label class="col-lg-4 control-label">封面预览</label>
                             <div class="col-lg-8">
                                 <a id="ashow" target="_blank"><img width="188px" height="124px" src="" style="display:none" id="showPic" alt=""/></a>
                             </div>
                         </div>
                         <!--标签选择END-->
                         <!--类型选择-->
                         <div class="form-group">
                             <label class="col-lg-4 control-label">类型选择</label>
                             <div class="col-lg-8">
                                 <div class="panel-heading" style="padding: 0%">
                                     <h4 class="panel-title" >
                                         <a data-toggle="collapse" data-parent="#accordion"
                                            href="#type" id="typecheck" >
                                             点击选择类型
                                         </a>
                                     </h4>
                                 </div>
                                 <div id="type" class="panel-collapse collapse  ">
                                     <div class="panel-body" id="typebody">
                                         <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a  type="button"  class="btn btn-primary" style="margin-top: 1%;margin-left:1%"  typeid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!--类型选择END-->

                         <!--栏目选择-->
                         <div class="form-group">
                             <label class="col-lg-4 control-label">栏目选择</label>
                             <div class="col-lg-8">
                                 <div class="panel-heading" style="padding: 0%">
                                     <h4 class="panel-title" >
                                         <a data-toggle="collapse" data-parent="#accordion"
                                            href="#columu" id="columucheck" >
                                             点击选择栏目
                                         </a>

                                     </h4>
                                 </div>
                                 <div id="columu" class="panel-collapse collapse  ">
                                     <div class="panel-body" id="columubody">
                                         <?php if(is_array($columu)): $i = 0; $__LIST__ = $columu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a  class="btn btn-primary" style="margin-top: 1%;margin-left:1%"  columuid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <!--栏目选择END-->
                                    <hr />
                                <div class="form-group">
                                  <div class="col-lg-offset-1 col-lg-9">
                                    <a  class="btn btn-primary" onclick="add()">提交</a>
                                  </div>
                                </div>

                         <!--隐藏域-->
                             <input type="hidden" id="columuid" name="columuid"/>
                             <input type="hidden" id="typeid" name="typeid"/>
                             <input type="hidden" id="small_path"  name="picture"/>
                         <!--隐藏域END-->

                              </form>
                  </div>
                </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
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


<!--编辑器-->
<script src="/Public/monkey/Backstage/lib/ueditor/ueditor.config.js"></script>
<script src="/Public/monkey/Backstage/lib/ueditor/ueditor.all.min.js"> </script>
<script src="/Public/monkey/Backstage/lib/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    var editor = UE.getEditor('article-content');
//    window.onresize=function(){
//        window.location.reload();
//    }
//    var _uploadEditor;
//    $(function () {
//        //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
//        _uploadEditor = UE.getEditor('uploadEditor');
//        _uploadEditor.ready(function () {
//            //设置编辑器不可用
//            //_uploadEditor.setDisabled();
//            //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
//            _uploadEditor.hide();
//            //侦听图片上传
//            _uploadEditor.addListener('beforeInsertImage', function (t, arg) {
//
//                //将地址赋值给相应的input,只去第一张图片的路径
//                $("#pictureUpload").attr("value", arg[0].src);
//                //图片预览
//                //$("#imgPreview").attr("src", arg[0].src);
//            })
//            //侦听文件上传，取上传文件列表中第一个上传的文件的路径
//            _uploadEditor.addListener('afterUpfile', function (t, arg) {
//                $("#fileUpload").attr("value", _uploadEditor.options.filePath + arg[0].url);
//            })
//        });
//    });
//    //弹出图片上传的对话框
//    $('#upImage').click(function () {
//        var myImage = _uploadEditor.getDialog("insertimage");
//        myImage.open();
//    });
//    //弹出文件上传的对话框
//    function upFiles() {
//        var myFiles = _uploadEditor.getDialog("attachment");
//        myFiles.open();
//    }
</script>
<!--编辑器END-->

<!--上传封面-->
<!--<script type="text/javascript" src="/Public/monkey/uploadify/jquery.uploadify.min.js"></script>-->
<script>
//    //无刷新文件上传
//    $("#upload" ).uploadify({
//        'swf':'/Public/Admin/uploadify/uploadify.swf',
//        'uploader':"<?php echo U('article/ajaxpicture');?>",
//        'auto':true,
//        'buttonText':'上传封面',
//        'onUploadSuccess':function(file,path,response){
//            var strs=path.split(",");
//            alert(strs);
//
//            //有文件路径返回
//            if(path){
//                $("#showPic").attr({'src':'/Public/Knowledge/'+path});
//                $("#showPic" ).css({'display':'block'});
//                //给id=small_path的表单项赋值
//                $('#small_path' ).val(path);
//                var result=$('#small_path' ).val();
//                alert(result);
//            }
//        }
//    });
</script>
<!--上传封面-->

<!--新增文章按钮-->
<script>
    function add(){
        $("#addfrom" ).submit();
    }
</script>
<!--新增文章按钮END-->

<!--增加类型-->
<script>
    $("#typebody a").click(function(){
       var id= $(this).attr('typeid');
       var tname= $(this).text();
        $("#typecheck" ).text(tname);
        $("#typeid" ).val(id);
        $('#type').collapse('hide')
    });
</script>
<!--增加标签END-->

<!--增加栏目-->
<script>
    $("#columubody a").click(function(){
        var id= $(this).attr('columuid');
        var cname= $(this).text();
        $("#columucheck" ).text(cname);
        $("#columuid" ).val(id);
        $('#columu').collapse('hide')
    });
</script>
<!--增加标签END-->

<!--上传封面-->
<script>
    $('#idcarda1').on('click',function(){
        var id= 1;//类型为1
        //选择文件
        $('#idcarda1').change(function(event) {
            var file;
            file=event.target.files[0];
            html5up(file);
            $("#idcarda1").unbind("change");//清除改变事件
        });
    });
    //点击图片上传
    function upload(id){
        var name='#idcarda'+id;
        return $(name).click();
    }
    //上传操作
    function html5up(file){
        var form_data=new FormData();
        form_data.append("Filedata",file);
        $('#idcardac').text('上传中');
        $.ajax({
                    url: '<?php echo U("article/ajaxpicture");?>',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    async:false,
                    data: form_data,
                })
                .success(function(data) {
                    console.log(data);
                    var strs=data.split(",");
                    if(data.status ==0){
                        alert(data.info);
                    }else{
                        //上传完后对输入框
                        $("#showPic").attr({'src':'/Public/Knowledge/'+data});
                        $("#ashow").attr({'href':'/Public/Knowledge/'+data});
                        $("#showPic" ).css({'display':'block'});
                        //给id=small_path的表单项赋值
                        $('#small_path' ).val(data);
                        var result=$('#small_path' ).val();
                        alert('上传完毕');
                    }
                })
    }
    //添加图片到img_box
</script>
<!--上传封面END-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
            maxHeight: 200
        });
//        $('.multiselect').multiselect({
//            maxHeight: 400
//        });
    });
</script>
</html>