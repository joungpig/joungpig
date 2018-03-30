<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<style type="text/css">
    body{
        background-color:#fff;
        min-width:0;
    }
    .container{
        width:auto;
        margin:17px 6px;
    }
    .title{
        border-bottom:1px solid #eee;
        position:relative;
        margin:0 -20px;
        margin-bottom:17px;
    }
    .title h3{
        margin:0;
        padding:0 16px;
        padding-bottom:14px;
        line-height:32px;
    }
    .title .close{
        font-size:24px;
        width:32px;
        height:32px;
        line-height:34px;
        background-color:#ccc;
        border-radius:50%;
        text-align:center;
        margin-left:10px;
    }

    .col-form h4{
        border-bottom:1px solid #eee;
        margin-top:0;
        padding-bottom:4px;
        margin-bottom:17px;
    }
    .col-form .form-horizontal{
        margin-bottom:20px;
    }

    .col-btns, .col-contacts{
        margin-top:20px;
    }

    .col-btns .btn{
        width:100%;
    }

    .col-contacts .well{
        box-shadow:none;
        position:relative;
        cursor:pointer;
    }
    .col-contacts .well:hover{
        border-color:#1a7ab9;
    }
    .col-contacts dl{
        margin:6px 0;
    }
    .col-contacts dl dt, .col-contacts dl dd{
        line-height:2;
        font-weight:normal;
    }
    .col-contacts dl dt{
        width:70px;
        color:#999;
    }
    .col-contacts dl dd{
        margin-left:85px;
    }
    .col-contacts dl dt strong{
        color:#333;
        font-weight:bold;
    }
    .padding-12 li a{
        display:block;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
    .padding-none li{
        width:100%;
        text-align:left;
        cursor:pointer;
    }
    .padding-none li a{
        display:block;
        white-space:nowrap;
        /*text-align:left;
        overflow:hidden;
        text-overflow:ellipsis;
        width:100%;*/
    }
    .token-input-list-facebook{
        width:100%;
        height:30px;
    }
    .operation{
        border:1px red solid;
        height:150px;
        max-height:250px;
        width:155px;
        max-width:155px;
        overflow-y:auto;
        overflow-x:hidden;
    }
    .operation ul{
        margin:0px;
        padding:10px;
        list-style:none;
    }
    .record_install{
        color:#333354;
        text-decoration:none;
        padding:7px;
        float:left;
    }
    .return{
        background-color: #ccc;
        border-radius: 50%;
        font-size:16px;
        width:32px;
        height:32px;
        line-height:34px;
        text-align:center;
        color: #000;
        float: right;
        font-weight: bold;
        opacity: 0.2;
        text-shadow: 0 1px 0 #fff;
    }
    .installCorrelation{
        position:absolute;
        right:-18px;
        top:5px;
        padding:5px
    }
    .recordMenu_ul{
        max-height:350px;
        overflow-y:auto;
    }
    .min-size{
        position:relative;
        min-height:40px;
        min-width:80px;
    }
    #loadPage.relateItems{
        padding-left:0;
    }
    .form-group {
        margin-bottom: 0px;
    }
    .form-control-static {
        min-height: 42px;
    }
    .nav-tabs > li > a:hover {
        background-color: #F9F9F9;
    }
    #loadPage a{text-decoration: none!important;color:#f0c040!important;cursor:default;!important;}
    #nav a{text-decoration: none!important;color:black!important;cursor:default;!important;}
    label{
        text-align: right;padding-right: 9px;padding-left: 0px;font-weight: normal;color: #999;margin-top: 0px;margin-bottom: 0px;padding-top: 7px;font-family: Arial,sans-serif,"Microsoft YaHei","黑体";font-size: 12px;line-height: 1.42857143;
    }
    input{
        border-radius: 3px;height: 28px!important;
    }
    .fa{display:inline!important;}
    .bottomBar{
        position:fixed;
        bottom:0px;
        padding:8px 15px 8px 15px;
        width:100%;
        background:rgb(255, 255, 255);
        border-top:1px solid rgb(229,229,229);
    }
    .control-labelb{ text-align:left !important;}
    .bg{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color:rgba(0,0,0,0.5);
        display:none;
    }
    .bgcon{
        position:absolute;
        top:50%;
        left:50%;
        width:240px;
        float:left;
        height:240px;
        background-color:#FFF;
        margin-left:-120px;
        top:120px;
        border-radius:8px;
    }
    .bgconleft{
        width:240px; float:left;
    }
    .bgbtn{
        width:120px;
        float:left;
        border:none;
        height:35x;
        line-height:35px;
    }
</style>
<!--引入 head-->
<head>
    <meta charset="utf-8" />
    <title>joungpigh后台管理</title>
    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<link rel="shortcut icon" href="/Public/service/assets/img/icon9.png" type="image/x-icon">-->
    <link href="/Public/Admin/edit/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <!--<link id="beyond-link" href="/Public/service/assets/css/beyond.min.css" rel="stylesheet" type="text/css" />-->
    <link href="/Public/Admin/edit/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/Public/Admin/edit/css/select2.css" rel="stylesheet" />
    <!--引入 Js-->
    <script src="/Public/Admin/edit/js/jquery-1.7.2.min.js"></script>
    <script src="/Public/Admin/edit/js/bootstrap.min.js"></script>
    <script src="/Public/Admin/edit/js/jquery-1.10.2.min.js"></script>
    <script src="/Public/Admin/edit/js/layoutManager.js"></script>
    <script src="/Public/Admin/edit/js/form-verification.js"></script>
    <script src="/Public/Admin/edit/js/select2.js"></script>
    <!--layer-->
    <script src="/Public/common/layer/layer.js"></script>
    <!--layer END-->
    <!--引入 JS END-->
</head>
<!--引入 head END-->
<body style="overflow-y: auto;padding-top: 0%;outline: none">
<div class="container" style="width:auto">
    <div class="title">
        <h3>
            栏目
            <a class="close" id="closePanel" title="关闭">×</a>
        </h3>
    </div>
    <div class="col-xs-4">
        <ul class="nav nav-tabs padding-12">
            <li class="active"><a id="user">基本信息</a></li>
        </ul>
    </div>
    <div class="col-xs-5">
    </div>
    <div class="clearfix"></div>
    <div id="loadPage" style="margin-top:0px; margin-bottom:50px;" class="col-xs-9">
        <div class="col-xs-12 col-form"  style="min-height:300px;padding-right:0;padding-left:0;">
            <br>
            <input type="hidden" value="User" id="entityName">
            <input type="hidden" value="<?php echo ($_GET['id']); ?>" id="id">


            <a onclick="LM.toggleAreaTitle($(this),&#39;1482240675094&#39;)">
                <i class="fa fa-lg fa-caret-down"></i>
                导航信息</a>
            <div style="height:4px;border-bottom: 1px dotted #ccc"></div>
            <br>
            <div class="form-horizontal" id="1482240675094" style="clear:both;display:block">
                <div class="form-group">
                    <label class="control-label col-xs-2">
                        导航标题
                    </label>
                    <div class="col-xs-4" compute="false"  canupdate="true" type="text" name="title" rows="3" label="导航标题" table="columu" value="<?php echo ($columu_info['title']); ?>"  edit_url="<?php echo U('nav/edit');?>">
                        <p style="color:#707070;font-family:微软雅黑;font-size: 13px;" class="form-control-static" onclick="LM.editField(event,$(this))"><?php echo ($columu_info['title']); ?></p>
                    </div>
                    <label class="control-label col-xs-2">
                        导航图片
                    </label>
                    <div class="col-xs-4" compute="false"  canupdate="true" type="text" name="img" rows="3" label="导航图片" table="columu" value="<?php echo ($columu_info['img']); ?>"  edit_url="<?php echo U('nav/edit');?>">
                        <p style="color:#707070;font-family:微软雅黑;font-size: 13px;" class="form-control-static" onclick="LM.editField(event,$(this))"><?php echo ($columu_info['img']); ?></p>
                    </div>
            </div>
                <div class="form-group">
                    <label class="control-label col-xs-2">
                        导航链接
                    </label>
                    <div class="col-xs-4" compute="false"  canupdate="true" type="text" name="url" rows="3" label="导航链接" table="columu" value="<?php echo ($columu_info['url']); ?>"  edit_url="<?php echo U('nav/edit');?>">
                        <p style="color:#707070;font-family:微软雅黑;font-size: 13px;" class="form-control-static" onclick="LM.editField(event,$(this))"><?php echo ($columu_info['url']); ?></p>
                    </div>
                    <label class="control-label col-xs-2">
                        导航状态
                    </label>
                    <div class="col-xs-4" compute="false"  canupdate="true" type="picklist" name="state" rows="3" label="栏目状态" table="source" value="<?php echo ($columu_info['state']); ?>"  edit_url="<?php echo U('nav/edit');?>" get_url="<?php echo U('columu/edit');?>">

                        <p id="state" style="color:#707070;font-family:微软雅黑;font-size: 13px;" class="form-control-static" onclick="LM.editField(event,$(this))"><?php echo ($columu_info['state']); ?></p>
                    </div>
                    <!--<label class="control-label col-xs-2">-->
                    <!--客户名称-->
                    <!--</label>-->
                    <!--<div class="col-xs-4">-->
                    <!--<div class="control-label control-labelb" ><<?php echo ($content["customername"]); ?>></div>-->
                    <!--</div>-->
                </div>
        </div>
    </div>
</div>
<div class="token-input-dropdown-facebook" style="display: none;"></div><div class="token-input-dropdown-facebook" style="display: none;"></div><div class="token-input-dropdown-facebook" style="display: none;"></div>

<div class="bottomBar" id="intro-save-customer" >
    <div class="row">
        <!-- <div class="col-xs-12" id="intro-save-customer">	 -->
        <!--<div class="col-xs-12">-->
        <!--<div class="pull-right">-->
        <!--&lt;!&ndash;<button class="btn-link" type="button" onclick="check(this)" id="btn_saveAndOpen"><i class="fa fa-fw fa-save"></i>保存并打开</button>&ndash;&gt;-->
        <!--&lt;!&ndash;&nbsp;&ndash;&gt;-->
        <!--&lt;!&ndash;<button class="btn btn-warning" type="button" id="btn_save"><i class="fa fa-fw fa-save"></i>保存</button>&ndash;&gt;-->
        <!--&nbsp;-->
        <!--<?php if($content['state_id'] == $workerid): ?>-->
        <!--<button class="btn btn-warning" id="shen" type="button">审核</button>-->
        <!--<?php endif; ?>-->

        <!--<?php if($content["is_cancel"] == 0): ?>-->
        <!--<a href="<<?php echo U('Agreement/cancel');?>>"><button class="btn btn-warning" id="zhuof" type="button">作废</button></a>-->
        <!--<?php endif; ?>-->
        <!--&nbsp;-->
        <!--&lt;!&ndash;<button class="btn btn-default" id="returnBtn" type="button"><i class="fa fa-fw fa-mail-reply"></i>取消</button>&ndash;&gt;-->
        <!--</div>-->
        <!--</div>-->
    </div>
</div>
<div class="bg">
    <div class="bgcon">
        <div class="bgconleft"><i class="bclose" style="float:right; font-size:28px; padding-right:10px; cursor:pointer;">×</i></div>
        <div class="bgconleft" style="text-align:center; font-size:20px; width:220px; margin-top:30px; padding:0px 10px;">请仔细查看合同信息在进行财务审核</div>
        <div class="bgconleft" style="position:absolute; bottom:0; left:0;">
            <a href="<<?php echo U('Agreement/finance',array('type'=>1,'agreementid'=>$content['id']));?>>">
                <button class="bgbtn" style="background-color:#f0c040; color:#FFF;">审核成功</button>
            </a>
            <a href="<<?php echo U('Agreement/finance',array('type'=>2,'agreementid'=>$content['id']));?>>">
                <button class="bgbtn" style="color:#000;">审核失败</button>
            </a>
        </div>
        <div>
        </div>
    </div>
</div>
    </div>
</body>
<input id="content_id" value="<<?php echo ($content['id']); ?>>" type="hidden">
<script>
    $('#closePanel').click(function(event) {
        if (!!window.parent && !!window.parent.closeEditorPanel) {
            window.parent.closeEditorPanel();
        }
        $(parent.document.body).removeClass('modal-open');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var type = "<?php echo ($columu_info["type"]); ?>"
        var state = "<?php echo ($columu_info["state"]); ?>"
        if(type==1){
            $("#type").text('文章');
        }else {
            $("#type").text('导航');
        }
        if(state==0){
            $("#state").text('未启用');
        }else if(state==1){
            $("#state").text('启用');
        }else if(state==2){
            $("#state").text('删除');
        }
    });
</script>

</html>