<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properities -->
    <title>民生旅游年卡管理系统</title>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url()?>/css/semantic.min.css">
    <style type="text/css">
        .footer{
            font-family: "微软雅黑";
            font-size: 13px;
            text-align: center;
        }
        .logout{
            text-align: right;
            color: #FFF;
            text-decoration:none;
            font-size: 19px;
        }
        .welcome{
            font-size: 22px;
        }
    </style>

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
                            <div class="fourteen wide column">
                                <i class="large home icon"></i> <span class="welcome">欢迎使用民生旅游年卡管理系统</span>
                            </div>
                            <div class="two wide column">
                                <a class="logout" href="<?php echo site_url()?>admin/logout"><i class="large sign out icon"></i>注销</a>
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

                <div class="header item">
                    <i class="globe icon"></i>
                    景区管理
                </div>
                <a class="item">
                    查看景区
                </a>
                <a class="item">
                    增加景区
                </a>
                <div class="header item">
                    <i class="payment icon"></i>
                    卡资料管理
                </div>
                <a class="item">
                    查看年卡
                </a>
                <a class="item">
                    增加年卡
                </a>
                <div class="header item">
                    <i class="laptop icon"></i>
                    日志查询
                </div>
                <a class="item">
                    查看日志
                </a>
                <div class="header item">
                    <i class="user icon"></i>
                    管理员
                </div>
                <a class="item">
                    查看管理员
                </a>
                <a class="item">
                    增加管理员
                </a>
            </div>

        </div>
        <div class="nine wide column">
            <h4 class="ui black block header">
                添加管理员
            </h4>

            <table class="ui small table segment">
                <thead>
                <tr><th>姓名</th>
                    <th>用户组</th>
                    <th>操作</th>
                </tr></thead>
                <tbody>
                <tr>
                    <td>张三</td>
                    <td>系统管理员</td>
                    <td><div class="mini ui secondary button">修改
                        </div>&nbsp;<div class="mini ui primary button">删除
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>李四</td>
                    <td>旅游局</td>
                    <td><div class="mini ui secondary button">修改
                        </div>&nbsp;<div class="mini ui primary button">删除
                        </div>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr><th colspan="3">
                        <div class="ui blue labeled icon button"><i class="user icon"></i> 添加用户</div>
                    </th>
                </tr></tfoot>
            </table>

            <div class="ui pagination menu">
                <a class="icon item">
                    <i class="icon left arrow"></i>
                </a>
                <a class="active item">
                    1
                </a>
                <div class="disabled item">
                    ...
                </div>
                <a class="item">
                    10
                </a>
                <a class="item">
                    11
                </a>
                <a class="item">
                    12
                </a>
                <a class="icon item">
                    <i class="icon right arrow"></i>
                </a>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="six wide column">
        </div>
        <div class="four wide column">
            <p class="footer">&copy;2014 民生旅游年卡管理系统</p>
        </div>
    </div>
</div>
</body>
</html>