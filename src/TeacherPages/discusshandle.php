<?php
include '../teacher.php';
session_start();
$teacher = $_SESSION['teacher'];
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
    "VALUES ('$id','$teacher->Name','$Content')";
mysqli_query($con, $sql);


echo "
<script> 
alert(\"提交成功!!\");
location.replace(\"discusscontent.php?id=$id\");
</script> 
";
