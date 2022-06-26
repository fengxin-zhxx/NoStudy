<?php

include '../teacher.php';
session_start();

$Teacher = $_SESSION['teacher'];

$Course =  $_POST["course"];
$LastTime = $_POST["time"];
$Date = date("Y-m-d H-i-s");


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());


$StartTime = time();
$EndTime = $StartTime + $LastTime * 60;

// $StartTime = date("Y-m-d H-i-s",$StartTime);
// $EndTime = date("Y-m-d H-i-s",$EndTime);


$sql = "INSERT INTO checkin (course,teacher,time,endtime)" .
    "VALUES ('$Course','$Teacher->Name','$StartTime','$EndTime')";
mysqli_query($con, $sql);

echo "<script> alert(\"发布成功！\"); </script>";
 echo "<script> location.replace(\"checkin.php\");</script> ";
