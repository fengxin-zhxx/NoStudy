<?php


$course = $_POST['course'];

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());


if (file_exists($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
    //如果上传了文件
    $file_name = $course . "-" . $_FILES["file"]["name"];
    $material = "../material/";
    if (file_exists($material . $file_name)) {
        $namelist = explode('.',$file_name);
        $typename = array_pop($namelist);
        $file_name = "";
        foreach ($namelist as $part)
            $file_name = $file_name . $part; 
        $file_name = $file_name . "(2)." . $typename;
        //echo $file_name;
    }

    // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
    move_uploaded_file($_FILES["file"]["tmp_name"], $material . $file_name);
    //echo "文件存储在: " . "material/" . $file_name;

    $sql = "INSERT INTO material (course,name) " .
        "VALUES ('$course','$file_name')";
} else {
}

mysqli_query($con, $sql);


echo "
<script> 
alert(\"上传成功!!\");
location.replace(\"material.php\");
</script> 
";
