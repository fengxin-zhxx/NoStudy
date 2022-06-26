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
                StudentWorkSpace
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
        include '../student.php';
        session_start();
        $student = $_SESSION['student'];
        echo $student->Name;

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
                <div style="font-size:25px">
                    <!-- 这里是讨论主题 -->
                    <?php
                    $sql = "SELECT * FROM discuss WHERE id = $id";
                    $qry = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($qry);
                    echo $row['topic'];
                    ?>
                </div>
                </br>
                <div>
                    <!-- 这里是讨论来源 -->
                    发起人：
                    <?php
                    echo $row['source'];
                    ?>
                </div>
                <div>
                    <!-- 这里是讨论内容 -->
                    讨论内容：
                    <?php
                    echo $row['content'];
                    ?>
                </div>
                <br><br><br>

                <?php
                $sql = "SELECT * FROM discuss_record WHERE discuss_id = $id";
                $qry = mysqli_query($con, $sql);
                if ($row = mysqli_fetch_array($qry)) {
                    echo "<h2>回复列表</h2>";
                    do {
                        echo "<div class=\"layui-panel\" style = \"width:40%\">
                                    <div style=\"margin:15px\">";
                        echo "<div style = \"font-size:18px\">" . $row['source'] . "</div>
                                <div>" . $row['content'] . "</div>";
                        echo " </div>  </div>";
                    } while ($row = mysqli_fetch_array($qry));
                } else {
                    echo "<div class=\"layui-panel\" style = \"width:40%\">
                                    <div style=\"margin:15px\">";
                    echo "<div>暂无回复</div>";

                    echo " </div>  </div>";
                }
                ?>

                <br><br><br>
                <form class="layui-form" action="discusshandle.php?id=<?php echo $id ?>" method="post">
                    <div style="font-size:20px">回复话题</div>
                    <div>
                        <textarea class="layui-textarea" autoheight="true" placeholder="回复内容" name="content" style="height:200px;width:40%"></textarea>
                    </div>
                    <button class="layui-btn">回复</button>
                </form>
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