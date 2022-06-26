<?php
$id = $_GET["id"];
include '../student.php';
session_start();
$student = $_SESSION['student'];


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");


if (!$con)
    die("连接错误: " . mysqli_connect_error());



// 序号
// 学号
// 姓名
// 操作

$sql = "SELECT * FROM homework_record WHERE homework_id = $id";
$qry = mysqli_query($con, $sql);
$res = array();
$id = 0;
while ($row = mysqli_fetch_array($qry)) {
    $id = $id + 1;
    //$row['student_id'];
    $innerSql = "SELECT * FROM user WHERE student_id = " . $row['student_id'];
    $innerQry = mysqli_query($con, $innerSql);
    $innerRow = mysqli_fetch_array($innerQry);
    //$innerRow['student_name'];

    $student = array("id" => $id, "student_id" => $row['student_id'], "student_name" => $innerRow['student_name'], "existfile" => $row["existfile"], "filename" => $row['filename'],"content" => $row['content']);
    array_push($res, $student);
}
$res = json_encode($res);
echo $res;
