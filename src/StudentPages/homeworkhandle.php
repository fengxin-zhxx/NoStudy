<?php
$id = $_GET["id"];
$content = $_POST["content"];
include '../student.php';
session_start();
$student = $_SESSION['student'];


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());




if (file_exists($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
    //如果上传了文件
    $file_name = $id . "-" . $student->StudentID . "-" . $_FILES["file"]["name"];
    $upload = "../upload/";
    if (file_exists($upload . $_FILES["file"]["name"])) {
    } else {
        // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
        move_uploaded_file($_FILES["file"]["tmp_name"], $upload . $file_name);
        //echo "文件存储在: " . "upload/" . $file_name;
    }
    $sql = "INSERT INTO homework_record (homework_id,student_id,content,existfile,filename)" .
        "VALUES ('$id','$student->StudentID','$content',1,'$file_name')";
} else {
    $sql = "INSERT INTO homework_record (homework_id,student_id,content,existfile,filename)" .
        "VALUES ('$id','$student->StudentID','$content',0,'$file_name')";
}

mysqli_query($con, $sql);


echo "
<script> 
alert(\"提交成功!!\");
location.replace(\"homework.php\");
</script> 
";
