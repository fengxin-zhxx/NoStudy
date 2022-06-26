<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
    <title>workspace</title>
    <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
    <script src="../layui/layui.js" charset="UTF-8"></script>
</head>

<?php

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());

?>

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

        include '../student.php';
        session_start();
        $student = $_SESSION['student'];
        $id = $_POST['exam'];

        // print_r($student);
        // print_r($id);

        $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
        if (!$con)
            die("连接错误: " . mysqli_connect_error());
       
        
       

        ?>
        <div id="content" class="layui-body">
            <div style="padding: 30px;">
                <form class="layui-form" action="examjudge.php?id=<?php echo $id; ?>" method="post" style="overflow-y:scroll;height:750px;width:80%">
                    <div>
                        <div class="layui-panel" style="font-size:20px;display:inline-block;padding:10px">
                            <div style="width:auto">
                                考试名称：
                                <?php
                                $sql = "SELECT * FROM exam WHERE id = $id";
                                $res = mysqli_query($con, $sql);
                                $arr = mysqli_fetch_array($res);
                                echo $arr['course'] . "-" . $arr['name'] . "<br>";
                                echo "发布时间：" . date("Y-m-d H:i:s", $arr['date']);
                                ?>
                            </div>
                        </div>
                        <br /><br />
                        <div>
                            <?php
                            $sql = "SELECT COUNT(*) AS count FROM exam_question WHERE exam_id = $id";
                            $res = mysqli_query($con, $sql);
                            $arr = mysqli_fetch_array($res);
                            $count = $arr['count'];
                            echo "<div style = \"font-size:20px\">共" . $count . "道题目</div><br>";


                            for ($i = 1; $i <= $count; $i = $i + 1) {
                                $sql = "SELECT * FROM exam_question WHERE exam_id = $id AND question_id = $i";
                                $res = mysqli_query($con, $sql);
                                $arr = mysqli_fetch_array($res);
                                echo "<div class=\"layui-panel\" style=\"width:60%;font-size:20px;margin-bottom:30px;padding:14px\">";
                                echo "<div>第 $i 题:" . $arr['content'] . "</div>";
                                for ($j = 0; $j < 4; $j = $j + 1) {
                                    $innerSql = "SELECT * FROM exam_content WHERE exam_id = $id AND question_id = $i AND optionX = $j";
                                    $innerRes = mysqli_query($con, $innerSql);
                                    $innerArr = mysqli_fetch_array($innerRes);
                                    echo "<div style = \"margin:10px 0\">" . chr(65 + $j) . ":" . $innerArr['content'] . "</div>";
                                }
                                echo "<div style = \"width:100px\">";
                                echo "<select name = \"answer$i\" lay-verify=\"\">";
                                for ($j = 0; $j < 4; $j = $j + 1) echo "<option value = \"$j\">" . chr(65 + $j) . "</option>";
                                echo "</select>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>

                        <button type="submit" class="layui-btn">提交答案</button>
                    </div>
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