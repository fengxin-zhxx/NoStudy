<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
	<title>workspace</title>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
</head>
<?php
include '../teacher.php';
session_start();
$teacher = $_SESSION['teacher'];

$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
	die("连接错误: " . mysqli_connect_error());

$sql = "SELECT * FROM courses WHERE teacher = \"$teacher->Name\"";
$qry = mysqli_query($con, $sql);

/*
        0 -> id
        1 -> course
        2 -> teacher
        */
?>

<body>
	<div id="container" class="layui-layout layui-layout-admin">
		<div class="layui-header">
			<div id="logo" class="layui-logo layui-hide-xs layui-bg-black">
				<a style = "color:white"href= "../TeacherMain.php">TeacherWorkSpace</a>
			</div>
		</div>


		<div class="layui-side-scroll">
			<div id="teacher" class="navlist layui-side">
				<ul class="layui-nav layui-layout-left layui-nav-tree layui-nav-side">
					<li class="layui-nav-item"><a href="message.php"><i class="layui-icon layui-icon-notice"> 通知</i> </a></li>
					<li class="layui-nav-item"><a href="homework.php"><i class="layui-icon layui-icon-face-smile"> 作业</i></a></li>
					<li class="layui-nav-item"><a href="checkin.php"><i class="layui-icon layui-icon-release"> 签到</i></a></li>
					<li class="layui-nav-item"><a href="material.php"><i class="layui-icon layui-icon-list"> 资料</i></a></li>
					<li class="layui-nav-item"><a href="discuss.php"><i class="layui-icon layui-icon-dialogue"> 讨论</i></a></li>
					<li class="layui-nav-item"><a href="exam.php"><i class="layui-icon layui-icon-face-smile-b"> 考试</i></a></li>
					<span class="layui-nav-bar" style="top: 55px; height: 0px; opacity: 0;"></span>
				</ul>
			</div>
		</div>

		<div id="content" class="layui-body">
			<div style="padding-top: 25px;padding-left: 45px;">
				<h2>&rsaquo;发布通知
				</h2>
				<br><br><br><br>
				<!-- TO DO -->

				<div class="layui-col-md3">
					<form action="messagehandle.php" method="post">
						<div class="layui-panel" style = "width:800px">
							<div style="padding:15px">
								<div>
									<h5><?php
										echo "<h4 style=\"display:inline;\">" . $teacher->Name . "</h4>";
										?>老师，您好<br><br>
										请在您教授的课程中选择发布通知的课程</h5>
									<br /><br />
									<select name="course" lay-verify="" style="width:100%;height:40px;border-color:#eee">
										<?php
										while ($row = mysqli_fetch_array($qry)) {
											echo "<option>" . $row['course'] . "</option>";
										}
										?>
									</select>
								</div>
								<br>
								<div>
									<h3>主题</h3>
									<br />
									<input class="layui-input" type="text" id="ann_zhuti" name="topic" placeholder="请输入通知主题" />
								</div>
								<br /><br />
								<div>
									<h3>通知内容</h3>
									<br />
									<textarea class="layui-textarea" id="ann_nei" name="content" placeholder="请输入通知内容"></textarea>
									<!--<input class="layui-input" type="text" id="ann_nei" name="content" placeholder="请输入通知内容" />-->
								</div>
								<br /><br />
								<button type="submit" class="layui-btn">发布</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="footer" class="layui-footer">
			<p class="center">
				"Copyright © 2022 | design by XiXiFu"
			</p>
			<br />
		</div>
	</div>
</body>

</html>
<script type="text/javascript">

</script>
<script src="../layui/layui.js" charset="UTF-8"></script>