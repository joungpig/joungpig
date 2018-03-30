<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<style>
    a{text-decoration: none!important;color:#f0c040!important;cursor:default;!important;}
    label{
        text-align: right;padding-right: 9px;padding-left: 0px;font-weight: normal;color: #666;margin-top: 0px;margin-bottom: 0px;padding-top: 7px;font-family: Arial,sans-serif,"Microsoft YaHei","黑体";font-size: 12px;line-height: 1.42857143;
    }
    input{
        border-radius: 3px;height: 28px!important;
    }
</style>
<!--引入 head-->
<head>
    <meta charset="utf-8" />
    <title>joungpig后台</title>
    <meta name="description" content="Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="Public/Admin/add/img/icon9.png" type="image/x-icon">
    <link href="Public/Admin/add/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="" rel="stylesheet" />
    <!--<link id="beyond-link" href="/Public/add/css/beyond.min.css" rel="stylesheet" type="text/css" />-->
    <link href="Public/Admin/add/css/font-awesome.min.css" rel="stylesheet" />
    <link href="Public/Admin/add/css/weather-icons.min.css" rel="stylesheet" />
    <!--引入 Js-->
    <script src="Public/Admin/add/js/jquery-1.7.2.min.js"></script>
    <script src="Public/Admin/add/js/bootstrap.min.js"></script>
    <script src="Public/Admin/add/js/layoutManager.js"></script>
    <!--layer-->
    <script src="Public/common/layer/layer.js"></script>
    <!--layer END-->
    <!--layerdate-->
    <script src="Public/common/laydate/laydate.js"></script>
    <!--layerdate END-->
    <style>
        /* added by xhliu end */
        /**新建更新实体底部浮动保存栏*/
        .bottomBar{
            position:fixed;
            bottom:0px;
            padding:8px 15px 8px 15px;
            width:100%;
            background:rgb(255, 255, 255);
            border-top:1px solid rgb(229,229,229);
        }
        /*select{height: 30px;font-size: 14px;!important;}*/
        ul{border-radius: 4px;height: 30px;}
    </style>
</head>
<!--引入 head END-->
<body style="overflow-y: auto;padding-top: 0%;outline: none">
<div class="scrollbar mCustomScrollbar _mCS_1 mCS_no_scrollbar" style="height: 100%; width: 100%; position: relative; overflow: visible;background-color: #fff" >
    <div id="mCSB_1" class="mCustomScrollBox mCS-3d mCSB_vertical mCSB_outside" style="max-height: none;border: none;outline: none" tabindex="0">
        <div id="mCSB_1_container" class="mCSB_container mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
    <input type="hidden" value="Account" id="entityName">
    <input type="hidden" value="canCreate" id="action">
    <input type="hidden" id="owningUserChange" value="true">
    <form class="form-group" style="border: none" id="form">
        <div id="intro-create-customer" class="container">
            <input type="hidden" id="havaSetLayoutPrivileges" style="border-radius: 3px;">
            <input hidden="hidden" id="type" value="1" style="border-radius: 3px;">
            <div class="form-horizontal" style="clear:both;">
                <a onclick="LM.toggleAreaTitle($(this),&#39;1416981460149&#39;)">
                    <i class="fa fa-lg fa-caret-down"></i>
                    用户信息</a>
                <div name="under_line" class="under_line"></div>
                <br>
                <div id="1416981460149" style="display:block">
                    <div class="form-group">
                        <label class="control-label col-xs-2">
                            <font color="#EE7942">※</font>
                            手机号码
                        </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" placeholder="请输入手机号码" name="mobilephone" label="手机号码" id="mobilephone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">
                            <font color="#EE7942">※</font>
                            用户名称
                        </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" placeholder="请输入用户名称" name="name" label="用户名称" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">
                            <font color="#EE7942">※</font>
                           用户密码
                        </label>
                        <div class="col-xs-10">
                            <input type="password" class="form-control" placeholder="请输入用户密码" name="password" label="用户密码" id="password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

        </div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-3d mCSB_scrollTools_vertical"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 70px; display: none; height: 731px; max-height: 721px; top: 0px;" oncontextmenu="return false;"><div class="mCSB_dragger_bar" style="line-height: 70px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
<div style="display:none;" id="container"> </div>
<br><br><br>

<div class="bottomBar" id="intro-save-customer">
    <div class="row">
        <!-- <div class="col-xs-12" id="intro-save-customer">	 -->
        <div class="col-xs-12">
            <div class="pull-right">
                <!--<button class="btn-link" type="button" onclick="check(this)" id="btn_saveAndOpen"><i class="fa fa-fw fa-save"></i>保存并打开</button>-->
                <!--&nbsp;-->
                <button class="btn btn-warning" type="button" id="btn_save"><i class="fa fa-fw fa-save"></i>保存</button>
                &nbsp;
                <button class="btn btn-default" id="returnBtn" type="button"><i class="fa fa-fw fa-mail-reply"></i>取消</button>
            </div>
        </div>
    </div>
</div>
<!--
<input type="button" class="btn btn-success" value="保存" onclick="check()" id="btn_save" />
-->
<script type="text/javascript">
    $('#btn_save').on('click', function(){

        //点击后封禁提交按钮
        $('#btn_save').attr('disabled',"true");

        var data =  $('#form').serialize();
        $.ajax({
            cache: false,
            type: "POST",
            url: "<?php echo U('user/add');?>",
            data: data,
            async: false,
            success: function(msg){
                if (msg.error) {
                    layer.msg(msg.info);
                    $('#btn_save').removeAttr('disabled');
                } else if (msg.success) {
                    layer.msg(msg.info);
                    setTimeout(function(){
                        window.parent.location.reload();
                    },2000);
                }
            },
            error: function(msg){
            layer.msg('系统异常,请稍后再试!');
            $('#btn_save').removeAttr('disabled');
            }
        });
    });

    $(document).ready(function(){

        $('.close, #returnBtn').click(function(event){
            parent.layer.closeAll();
//            if (!!window.parent && !!window.parent.popDialog) {
//                window.parent.popDialog.modal('hide');
//            }
        });

        if (parent.window.addTab) {
            // 在呼叫中心界面打开新建客户
            $(".event-iframe:visible", parent.document).attr("src", "/event/createEvent?typeCode=1");
            $("#btn_saveAndOpen, #returnBtn").remove();
        }

    });

</script>
<div class="token-input-dropdown-facebook" style="display: none;"></div><div class="token-input-dropdown-facebook" style="display: none;"></div><div class="token-input-dropdown-facebook" style="display: none;"></div>
</body>

</html>