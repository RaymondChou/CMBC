<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properities -->
    <title>民生旅游年卡管理系统</title>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url()?>css/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url()?>css/main.css">
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>

</head>
<body>

<div class="ui grid">

    <div class="row">
        <div class="two wide column">
        </div>
        <div class="twelve wide column">

            <div class="ui secondary inverted segment">
                <div class="header">
                    <!-- banner bigin -->
                    <div class="ui grid">
                        <div class="row">
                            <div class="twelve wide column">
                                <a class="home" href="<?php echo site_url()?>admin"> <i class="large home icon"></i> </a><span class="welcome">欢迎使用民生旅游年卡管理系统</span>
                            </div>
                            <div class="four wide column">
                                <a class="logout" href="<?php echo site_url()?>admin/logout">欢迎您，<?=$admin_name?>&nbsp;<i class="sign out icon"></i>注销</a>
                            </div>
                        </div>
                    </div>
                    <!-- banner end -->
                </div>
            </div>

        </div>
        <div class="two wide column">
        </div>
    </div>
    <div class="row">
        <div class="two wide column">
        </div>
        <div class="three wide column">

            <div class="ui vertical menu">
             <?php if($type == 1 ):?>
                <div class="header item">
                    <i class="globe icon"></i>
                    景区管理
                </div>
                <a href="<?php echo site_url()?>spots/show" class="item">
                    查看景区
                </a>
                <a href="<?php echo site_url()?>spots/add" class="item">
                    增加景区
                </a>
            <?php endif; if($type == 1 | $type == 3):?>

                <div class="header item">
                    <i class="payment icon"></i>
                    卡资料管理
                </div>
                <a href="<?php echo site_url()?>cards/show" class="item">
                    查看年卡
                </a>
                <a href="<?php echo site_url()?>cards/add" class="item">
                    年卡充值
                </a>

            <?php endif; if($type == 1 | $type == 2):?>
                <div class="header item">
                    <i class="laptop icon"></i>
                    刷卡记录
                </div>
                <a href="<?php echo site_url()?>logs" class="item">
                    查看记录
                </a>
             <?php endif; if($type == 1):?>
                <div class="header item">
                    <i class="user icon"></i>
                    管理员
                </div>
                <a class="item" href="<?php echo site_url()?>admin/show">
                    查看管理员
                </a>
                <a class="item" href="<?php echo site_url()?>admin/add">
                    增加管理员
                </a>
             <?php endif;?>
            </div>


        </div>
        <div class="nine wide column">
