<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
	<title>workspace</title>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css" />
</head>

<body>
	<div id="container" class="layui-layout layui-layout-admin">
		<div class="layui-header">
			<div id="logo" class="layui-logo layui-hide-xs layui-bg-black">
				<a style = "color:white"href= "TeacherMain.php">TeacherWorkSpace</a>
			</div>
		</div>

		<div class="layui-side-scroll">
			<div id="teacher" class="navlist layui-side">
				<ul class="layui-nav layui-layout-left layui-nav-tree layui-nav-side">
					<li class="layui-nav-item"><a href="TeacherPages/message.php"><i class="layui-icon layui-icon-notice">  通知</i> </a></li>
					<li class="layui-nav-item"><a href="TeacherPages/homework.php"><i class="layui-icon layui-icon-face-smile">  作业</i></a></li>
					<li class="layui-nav-item"><a href="TeacherPages/checkin.php"><i class="layui-icon layui-icon-release">  签到</i></a></li>
					<li class="layui-nav-item"><a href="TeacherPages/material.php"><i class="layui-icon layui-icon-list">  资料</i></a></li>
					<li class="layui-nav-item"><a href="TeacherPages/discuss.php"><i class="layui-icon layui-icon-dialogue">  讨论</i></a></li>
					<li class="layui-nav-item"><a href="TeacherPages/exam.php"><i class="layui-icon layui-icon-face-smile-b">  考试</i></a></li>
					<span class="layui-nav-bar" style="top: 55px; height: 0px; opacity: 0;"></span>
				</ul>
			</div>
		</div>

		<div id="content" class="layui-body">
			<div style="padding: 25px;">
				<blockquote class="layui-elem-quote layui-text">
					<h3>&rsaquo;
						Welcome&nbsp;&nbsp;&nbsp;
						你好，
						<?php
						include 'teacher.php';
						session_start();
						$teacher = $_SESSION['teacher'];
						echo $teacher->Name;
						?>
						老师
					</h3>
					<!-- TO DO -->
					<div style="margin: 50px 40px">
						<h4>&bull;个人信息<br><br></h4>
						<?php
						echo '学校:&nbsp;' . $teacher->School . '</br> 教学号:' . $teacher->TeacherID;
						?>
					</div>
					</blockquote>
					<div class="layui-card layui-panel">
					        <div class="layui-card-header">
								欢迎使用由xixi & fufu联手设计完成的学习不通
					        </div>
					        <div class="layui-card-body">
								我们承诺不会泄露您的任何个人信息，请放心使用！<br /><br/>
								我们的设计理念是： 让签到、作业与考试变得更便捷！<br />
								我们的奋斗目标是： 超越学习通！<br /><br />
								我们的功能有：<br />
								①教师端发布通知，学生端接收通知<br />
								②教师端发布作业及批改学生作业，学生端接收作业并完成作业<br />
								③教师端发布签到，学生端接收签到<br />
								④教师端发布资料，学生端接收资料<br />
								⑤教师端发布讨论及关注学生讨论情况，学生端接收讨论并参与讨论<br />
								⑥教师端发布考试，学生端接收考试并参与考试<br />
					        </div>
					</div>
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