<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
	<title>workspace</title>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
	<script src="../layui/layui.js" charset="UTF-8"></script>
</head>

<?php
include '../student.php';
session_start();
$student = $_SESSION['student'];

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
	die("连接错误: " . mysqli_connect_error());


?>

<body>
	<div id="container" class="layui-layout layui-layout-admin">
		<div class="layui-header">
			<div id="logo" class="layui-logo layui-hide-xs layui-bg-black">
				<a style = "color:white"href= "../StudentMain.php">StudentWorkSpace</a>
			</div>
		</div>

		<div class="layui-side-scroll">
			<div id="student" class="navlist layui-side">
				<ul class="layui-nav layui-layout-left layui-nav-tree layui-nav-side">
					<li class="layui-nav-item"><a href="message.php"><i class="layui-icon layui-icon-notice"> 通知</i> </a></li>
					<li class="layui-nav-item"><a href="homework.php"><i class="layui-icon layui-icon-face-cry"> 作业</i></a></li>
					<li class="layui-nav-item"><a href="checkin.php"><i class="layui-icon layui-icon-release"> 签到</i></a></li>
					<li class="layui-nav-item"><a href="material.php"><i class="layui-icon layui-icon-list"> 资料</i></a></li>
					<li class="layui-nav-item"><a href="discuss.php"><i class="layui-icon layui-icon-dialogue"> 讨论</i></a></li>
					<li class="layui-nav-item"><a href="exam.php"><i class="layui-icon layui-icon-face-surprised"> 考试</i></a></li>
					<span class="layui-nav-bar" style="top: 55px; height: 0px; opacity: 0;"></span>
				</ul>
			</div>
		</div>

		<div id="content" class="layui-body">
			<div style="padding: 30px;">
				<form action="examhandle.php" method="post" style="overflow-y:scroll;width:80%">
					<div class="layui-form layui-col-md3" style="width:50%">
						<div>
							<h5>
								进行中的考试
							</h5>
							<select name="exam">
								<?php
								$student_id = $student->StudentID;
								$sql = "SELECT * FROM exam WHERE id NOT IN (SELECT exam_id FROM exam_record WHERE student_id = $student_id) ORDER BY id DESC";
								$qry = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($qry)) {
									$id = $row['id'];
									echo "<option value = \"$id\">" . $row['course'] . "-" . $row['name'] . '-' . date("Y-m-d h:i:s", $row['date']) . "</option>";
								}
								?>
							</select>
						</div>
						<br /><br />
						<button type="submit" class="layui-btn">进入考试</button>
					</div>
				</form>
				<br /><br /><br />
				<form action="examdetail.php" method="post" style="overflow-y:scroll;height:670px;width:80%">
					<div class="layui-form layui-col-md3" style="width:50%">
						<div>
							<h5>
								已完成的考试
							</h5>
							<select name="exam">
								<?php
								$sql = "SELECT * FROM exam WHERE id IN (SELECT exam_id FROM exam_record WHERE student_id = $student_id) ORDER BY id DESC";
								$qry = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($qry)) {
									$id = $row['id'];
									$innerSql = "SELECT * FROM exam_record WHERE exam_id = $id AND student_id = $student_id";
									$innerQry = mysqli_query($con, $innerSql);
									$arr = mysqli_fetch_array($innerQry);
									$recordID = $arr['id'];
									echo "<option value = \"$recordID\">" . $row['course'] . "-" . $row['name'] . '-' . date("Y-m-d h:i:s", $row['date']) . "</option>";
								}
								?>
							</select>
						</div>
						<br /><br />
						<button type="submit" class="layui-btn">查看详情</button>
					</div>
				</form>
			</div>
		</div>

		<div id="footer" class="layui-footer">
			<p class="center">
				"Copyright © 2022 | design by XiXiFu"
			</p><br />
		</div>
	</div>
</body>

</html>

<script type="text/javascript">
</script>