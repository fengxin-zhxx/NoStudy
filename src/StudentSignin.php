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

$sql = "SELECT COUNT(*) FROM user";
$result = mysqli_query($con, $sql);

$Contact = str_replace("@", "\@", $Contact);
$sql = "SELECT * FROM user where contact = \"$Contact\"";
$qry = mysqli_query($con, $sql);
if (mysqli_num_rows($qry) < 1) {
	echo "<script> alert(\"该用户不存在！！请重新输入！！\");</script>";
	echo "<script> location.replace(\"StudentSign.html\");</script> ";
	exit();
}

$row = mysqli_fetch_row($qry);
/*
0 -> id
1 -> method
2 -> school
3 -> studentid
4 -> studentname
5 -> contact
6 -> password
*/
$flag = 0;
if (substr($row[1], 0, 3) != substr($Method, 0, 3)) {
	echo "<script> alert(\"登录方式错误!请重新选择!\"); </script>";
	$flag = 1;
} else if ($row[6] == $Password) {
	session_start();
	include 'Student.php';
	$_SESSION['student'] = new student($row);
	echo "<script> alert(\"登录成功，正在跳转...\"); </script>";
} else {
	echo "<script> alert(\"登录失败，密码错误. 请重新输入！\"); </script>";
	$flag = 1;
}
if ($flag == 1)
	echo "<script> location.replace(\"StudentSign.html\");</script> ";
else
	echo "<script> location.replace(\"StudentMain.php\");</script> ";
