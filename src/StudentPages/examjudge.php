<?php

include '../student.php';
session_start();
$student = $_SESSION['student'];

$id = $_GET['id'];
// echo $id;

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());





$sql = "SELECT COUNT(*) AS count FROM exam_question WHERE exam_id = $id";
$res = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($res);
$count = $arr['count'];
// echo $count . "<br>";
$nowDate = time();


$sql = "INSERT INTO exam_record (exam_id,student_id,date,score)" .
    " VALUES ('$id','$student->StudentID','$nowDate',-1)";
mysqli_query($con, $sql);

$sql = "SELECT max(id) as id FROM exam_record";
$res = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($res);
$recordID = $arr['id'];

echo $recordID;

$sql = "SELECT * FROM exam_question WHERE exam_id = $id";
$res = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($res);

$scr = 0;
for ($i = 1; $i <= $count; $i = $i + 1) {
    $answeri = $_POST['answer' . $i];

    $innerSql = "INSERT INTO exam_detail (record_id,question_id,student_option)" .
        " VALUES ('$recordID','$i','$answeri')";
    mysqli_query($con, $innerSql);

    $innerSql = "SELECT * FROM exam_content WHERE exam_id = $id AND question_id = $i AND is_correct = 1";
    $innerRes = mysqli_query($con, $innerSql);
    $innerArr = mysqli_fetch_array($innerRes);
    if ($answeri == $innerArr['optionX']) {
        $scr = $scr + 1;
    }
    // echo $answeri . '<br>';
}

$sql = "UPDATE exam_record set score = $scr WHERE id = $recordID";
mysqli_query($con, $sql);



echo "<script> alert(\"提交成功！按确认跳转到试卷详情.\"); </script>";
echo "<script> location.replace(\"examdetail.php?id=$recordID\");</script>";