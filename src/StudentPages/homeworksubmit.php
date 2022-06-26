<?php
$id = $_GET["id"];
?>

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
        $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
        if (!$con)
            die("连接错误: " . mysqli_connect_error());

       

        
        ?>
        <div id="content" class="layui-body">
            <div style="padding: 30px;">
                <h3>&rsaquo;作业</h3>
                </br></br>
                <div class="layui-panel" style="width:30%">
                    <div style="margin:15px">
                        <h3>提交作业:</h3>
                        </br>
                        <h4>
                            <?php
                            $sql = "SELECT * FROM homework WHERE id = " . $id;
                            $qry = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_array($qry)) {
                                echo "课程名称：" . $row['course'] . "&nbsp;";
                                echo "作业内容：" . $row['content'];
                            }
                            ?>
                        </h4>
                        <br /><br />
                        <form action="homeworkhandle.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

                            <input type="file" name="file" id="file"><br><br />
                            <input type="text" name="content"><br><br />
                            <input type="submit" name="submit" value="提交" class="layui-btn">
                        </form>
                    </div>
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