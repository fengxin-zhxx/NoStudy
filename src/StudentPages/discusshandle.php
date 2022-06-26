<?php
include '../student.php';
session_start();
$student = $_SESSION['student'];
// echo $student->Name;
// echo $student->StudentID;

$Content = $_POST['content'];
// echo $Content;

$id = $_GET['id'];
// echo $id;

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());


$sql = "INSERT INTO discuss_record (discuss_id,source,content)" .
    "VALUES ('$id','$student->Name','$Content')";
mysqli_query($con, $sql);


echo "
<script> 
alert(\"提交成功!!\");
location.replace(\"discusscontent.php?id=$id\");
</script> 
";
