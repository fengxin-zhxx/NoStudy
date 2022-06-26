<?php
$RegisterMethod = $_POST["RegisterMethod"];
$RegisterSchool = $_POST["RegisterSchool"];
$StudentID = $_POST["StudentID"];
$StudentName = $_POST["StudentName"];
$Contact = $_POST["RegisterContact"];
$Password = $_POST["RegisterPassword"];

// echo '注册方式为 ' . $RegisterMethod . '<br/>';
// echo '学校为' . $RegisterSchool . '<br/>';
// echo '学号为 ' . $StudentID . '<br/>';
// echo '姓名为' . $StudentName . '<br/>';
// echo '联系方式为' . $Contact . '<br/>';
// echo '密码为' . $Password . '<br/>';

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
	die("连接错误: " . mysqli_connect_error());
// echo '数据库连接成功！！';



$sql = "SELECT * FROM user WHERE student_id = $StudentID";
$qry = mysqli_query($con, $sql);
$res = mysqli_num_rows($qry);
if (mysqli_num_rows($qry) > 0) {
	echo "<script> alert(\"该学号已经注册！！请重新输入\");</script>";
	echo "<script> location.replace(\"StudentSign.html\");</script> ";
	exit();
}
$Contact = str_replace("@", "\@", $Contact);

$sql = "SELECT * FROM user WHERE contact = \"$Contact\"";

$qry = mysqli_query($con, $sql);
$res = mysqli_num_rows($qry);
if (mysqli_num_rows($qry) > 0) {
	echo "<script> alert(\"该手机/邮箱已经注册！！请重新输入\");</script>";
	echo "<script> location.replace(\"StudentSign.html\");</script> ";
	exit();
}

$sql = "INSERT INTO user (register_method,register_school,student_id,student_name,contact,Password)" .
	"VALUES ('$RegisterMethod','$RegisterSchool','$StudentID','$StudentName','$Contact','$Password')";
mysqli_query($con, $sql);


echo "<script> alert(\"注册成功！！正在返回登录页面...\");</script>";
echo "<script> location.replace(\"StudentSign.html\");</script> ";

$qry = "SELECT * FROM user";
$result = mysqli_query($con, $qry);
