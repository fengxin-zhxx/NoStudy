<?php
$Method = $_POST["LoginMethod"];
$Contact = $_POST["LoginContact"];
$Password = $_POST["LoginPassword"];

//echo '联系方式为' . $Contact . '<br/>';
//echo '密码为' . $Password . '<br/>';

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
	die("连接错误: " . mysqli_connect_error());
// echo '数据库连接成功！！';

$sql = "SELECT COUNT(*) FROM teachers";
$result = mysqli_query($con, $sql);


$Contact = str_replace("@", "\@", $Contact);
$sql = "SELECT * FROM teachers where teacher_school = \"$Method\" and teacher_id = \"$Contact\"";

$qry = mysqli_query($con, $sql);

if (mysqli_num_rows($qry) < 1) {
	echo "<script> alert(\"该用户不存在！！请重新输入！！\");</script>";
	echo "<script> location.replace(\"TeacherSignin.html\");</script> ";
	exit();
}

$row = mysqli_fetch_row($qry);


if ($row[4] == $Password) {
	session_start();
	include 'teacher.php';
	$_SESSION['teacher'] = new teacher($row);
	echo "<script> alert(\"登录成功，正在跳转...\"); </script>";
	echo "<script> location.replace(\"TeacherMain.php\");</script> ";
} else {
	echo "<script> alert(\"登录失败，密码错误. 请重新输入！\"); </script>";
	echo "<script> location.replace(\"TeacherSignin.html\");</script> ";
}
