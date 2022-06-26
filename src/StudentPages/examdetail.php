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

        <div id="content" class="layui-body">
            <div style="padding: 30px;">
                <div class="layui-col-md3">
                    <div style = "font-size:20px;width:1200px">
                        考试名称：
                        <?php
                        $id = 0;
                        if (empty($_POST['exam'])) $id = $_GET['id'];
                        else $id = $_POST['exam'];
                        // echo $id;
                        $sql = "SELECT * FROM exam_record WHERE id = $id";
                        $res = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($res);

                        $exam_id = $arr['exam_id'];
                        $student_id = $arr['student_id'];
                        $date = $arr['date'];

                        $sql = "SELECT * FROM exam WHERE id = $exam_id";
                        $res = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($res);

                        echo $arr['course'] . "-" . $arr['name'] . "<br>";
                        echo "发布时间：" . date("Y-m-d H:i:s", $arr['date']) . "<br>";
                        echo "完成时间：" . date("Y-m-d H:i:s", $date) . "<br>";


                        $sql = "SELECT * FROM user WHERE student_id = $student_id";
                        $res = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($res);
                        echo "完成者：" . $arr['student_name'] . "<br>";
                        ?>
                    </div>
                    <br /><br />
                    <div style = "width:800px">
                        <?php

                        $sql = "SELECT COUNT(*) AS count FROM exam_question WHERE exam_id = $exam_id";
                        $res = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($res);
                        $count = $arr['count'];

                        $sql = "SELECT * FROM exam_record WHERE exam_id = $exam_id";
                        $res = mysqli_query($con, $sql);
                        $arr = mysqli_fetch_array($res);


                        echo "<div style = \"font-size:20px\">共" . $count . "道题目," . "" . "你的得分是" . $arr['score'] . "/$count</div><br>";




                        for ($i = 1; $i <= $count; $i = $i + 1) {
                            $sql = "SELECT * FROM exam_question WHERE exam_id = $exam_id AND question_id = $i";
                            $res = mysqli_query($con, $sql);
                            $arr = mysqli_fetch_array($res);echo "<div class=\"layui-panel\" style=\"font-size:20px;margin-bottom:30px;padding:14px\">";
                            echo "<div>第 $i 题:" . $arr['content'] . "</div>";
                            for ($j = 0; $j < 4; $j = $j + 1) {
                                $innerSql = "SELECT * FROM exam_content WHERE exam_id = $exam_id AND question_id = $i AND optionX = $j";
                                $innerRes = mysqli_query($con, $innerSql);
                                $innerArr = mysqli_fetch_array($innerRes);
                                echo "<div>" . chr(65 + $j) . ":" . $innerArr['content'] . "</div>";
                            }
                            $sql = "SELECT * FROM exam_detail WHERE record_id = $id AND question_id = $i";
                            $res = mysqli_query($con, $sql);
                            $arr = mysqli_fetch_array($res);
                            $myans = $arr['student_option'];
                            echo "你的答案:" . chr(65 + $myans) . "<br>";

                            $sql = "SELECT * FROM exam_content WHERE exam_id = $exam_id AND question_id = $i AND is_correct = 1";
                            //echo $sql . "<br>";
                            $res = mysqli_query($con, $sql);
                            $arr = mysqli_fetch_array($res);
                            $ans = $arr['optionX'];
                            echo "正确答案:" . chr(65 + $ans) . "<br>";
                            echo "答案" . ($ans == $myans ? "正确，得1分" : "错误") . "<br>";
                            echo "</div>";
                            echo "<br>";
                        }
                        ?>
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

<script type="text/javascript">
</script>