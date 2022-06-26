<?php
include '../teacher.php';
session_start();
$Teacher = $_SESSION['teacher'];
$Course = $_POST["course"];
$Source = $Course . "——" . $Teacher->Name;
$Topic = $_POST["topic"];
$Content = $_POST["content"];
$Date = date("Y-m-d");


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());
// echo '数据库连接成功！！';


$sql = "INSERT INTO notice (source,topic,date,content)" .
    "VALUES ('$Source','$Topic','$Date','$Content')";
mysqli_query($con, $sql);

echo "<script> alert(\"发布成功！\"); </script>";
echo "<script> location.replace(\"message.php\");</script> ";
