<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
    <title>workspace</title>
    <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
    <script src="../layui/layui.js" charset="UTF-8"></script>
</head>

<body>
    <div id="container" class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div id="logo" class="layui-logo layui-hide-xs layui-bg-black">
                TeacherWorkSpace
            </div>
        </div>

        <div class="layui-side-scroll">
            <div id="student" class="navlist layui-side">
                <ul class="layui-nav layui-layout-left layui-nav-tree layui-nav-side">
                    <li class="layui-nav-item"><a href="message.php"><i class="layui-icon layui-icon-notice"> 通知</i> </a></li>
                    <li class="layui-nav-item"><a href="homework.php"><i class="layui-icon layui-icon-face-cry"> 作业</i></a></li>
                    <li class="layui-nav-item"><a href="checkin.php"><i class="layui-icon layui-icon-release"> 签到</i></a></li>
                    <li class="layui-nav-item"><a href="material.php"><i class="layui-icon layui-icon-list"> 资料</i></a></li>
                    <li class="layui-nav-item"><a href="discuss.php"><i class="layui-icon layui-icon-dialogue"> 讨论</i></a></li>
                    <li class="layui-nav-item"><a href="exam.php"><i class="layui-icon layui-icon-face-surprised"> 考试</i></a></li>
                    <span class="layui-nav-bar" style="top: 55px; height: 0px; opacity: 0;"></span>
                </ul>
            </div>
        </div>

        <?php
        $id = $_GET['id'];
        include '../teacher.php';
        session_start();
        $student = $_SESSION['teacher'];

        $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
        if (!$con)
            die("连接错误: " . mysqli_connect_error());
        

        $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
        if (!$con)
            die("连接错误: " . mysqli_connect_error());
        

        ?>

        <div id="content" class="layui-body">
            <div style="padding: 30px;">
                <h3>&rsaquo;讨论</h3>
                <br /><br />
                <div>
                    <h3>新建讨论</h3>
                </div>
                <br>
                <div> 发布者：<?php echo $student->Name ?> </div>
                <br>
                <div style="width:40%">
                    <form class="layui-form" action="discusscreatehandle.php" method="post" style="width:96%">
                        <div class="layui-panel">
                            <div style="margin:15px">
                                <label>讨论主题</label>
                                <input class="layui-input" placeholder="请输入讨论主题" name="topic">
                            </div>
                            <div style="margin:15px">
                                <label>讨论内容</label>
                                <textarea class="layui-textarea" autoheight="true" placeholder="请输入讨论内容" name="content" style = "height:300px"></textarea>
                            </div>
                        </div>
                        <button class="layui-btn" style = "margin:15px">发布讨论</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="footer" class="layui-footer">
            <p class="center">
                "Copyright © 2022 | design by XiXiFu"
            </p><br />
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
</script>