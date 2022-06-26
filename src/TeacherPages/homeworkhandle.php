<?php

include '../teacher.php';
session_start();

$Teacher = $_SESSION['teacher'];

$Course =  $_POST["course"];
$Content = $_POST["content"];


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());


$sql = "INSERT INTO homework (course,content)" .
    "VALUES ('$Course','$Content')";
mysqli_query($con, $sql);

echo "<script> alert(\"发布成功！\"); </script>";
echo "<script> location.replace(\"homework.php\");</script> ";
