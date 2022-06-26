<?php
$id = $_GET["id"];
include '../student.php';
session_start();
$student = $_SESSION['student'];


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");


if (!$con)
    die("连接错误: " . mysqli_connect_error());







$sql = "SELECT * FROM checkin WHERE id = $id";
$qry = mysqli_query($con, $sql);
if ($row = mysqli_fetch_array($qry)) {
    if (time() <= $row['endtime']) {
        $timenow = time();
        $sql = "INSERT INTO checkin_record (checkin_id,student_id,time)" .
            "VALUES ('$id','$student->StudentID','$timenow')";
        mysqli_query($con, $sql);
        echo "已签到";
    } else {
        echo "已过期";
    }
}
