<?php
$course = $_POST['course'];
$count  = $_POST['count'];
$name = $_POST['name'];
// echo $cours . "<br>";
// echo $count . "<br>";


$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
    die("连接错误: " . mysqli_connect_error());


$nowDate = time();
$sql = "INSERT INTO exam (course,name,date) VALUES('$course','$name',$nowDate)";
mysqli_query($con, $sql);
$sql = "SELECT max(id) as m_id from exam";
$res = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($res);
print_r($arr);
$id = $arr['m_id'];









for ($i = 1; $i <= $count; $i = $i + 1) {
    // echo $_POST['describe' . $i];
    $content = $_POST['describe' . $i];
    $sql = "INSERT INTO exam_question (exam_id,question_id,content) " .
        "VALUES('$id','$i','$content')";
    mysqli_query($con, $sql);
    for ($j = 0; $j < 4; $j = $j + 1) {
        // echo chr(65 + $j) . ":" . $_POST['option' . $i . $j];
        $content = $_POST['option' . $i . $j];
        $is_correct = 0;
        if (chr(65 + $j) == $_POST['correctOption' . $i]) $is_correct = 1;
        $sql = "INSERT INTO exam_content (exam_id,question_id,optionX,is_correct,content) " .
            "VALUES('$id','$i','$j','$is_correct','$content')";
        //echo $sql . "<br>";
        mysqli_query($con, $sql);
    }
    // echo $_POST['correctOption'.$i];
    // echo "<br>";
}


echo "<script> alert(\"发布成功！\"); </script>";
echo "<script> location.replace(\"exam.php\");</script> ";
