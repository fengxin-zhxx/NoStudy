<?php
include '../student.php';
session_start();
$student = $_SESSION['student'];

// echo $student->Name;
// echo $student->StudentID;

$Content = $_POST['content'];
// echo $Content;

$Topic = $_POST['topic'];
// echo $Topic;

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());

$nowDate = time();

$sql = "INSERT INTO discuss (from_teacher,source,topic,date,content)" .
    " VALUES ('0','$student->Name','$Topic','$nowDate','$Content')";
// echo "<br>".$sql;
mysqli_query($con, $sql);


echo "
<script> 
alert(\"提交成功!!\");
location.replace(\"discuss.php?id=$id\");
</script> 
";
