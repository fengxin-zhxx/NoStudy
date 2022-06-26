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
				<h2>&rsaquo;发布考试
				</h2>
				<br><br>
				<!-- TO DO -->

				<form action="examhandle.php" method="post" style="overflow-y:scroll;height:670px;width:1200px">
					<div class="layui-form layui-col-md3">
						<div>
							<h5>
								<?php
								echo "<h4 style=\"display:inline;\">" . $teacher->Name . "</h4>";
								?>老师，您好<br><br>
								请在您教授的课程中选择发布考试的课程
							</h5>
							<br><br>
							<select name="course" lay-verify="">
								<?php
								while ($row = mysqli_fetch_array($qry)) {
									echo "<option>" . $row['course'] . "</option>";
								}
								?>
							</select>
						</div>
						<br /><br />
						<div class="layui-panel" style="width:550px">
							<label class="layui-form-label">考试名称</label>
							<input class="layui-input-block" name="name" placeholder="请输入考试名称" style="width:400px;margin-left:0">
						</div>
						<div>
							<div class="layui-panel" style="width:550px">
								<div style="padding:20px">
									<h4>&nbsp&nbsp&nbsp&nbsp&nbsp编辑试题</h4>
								</div>
								<div id="questions">
								</div>
								<button style="margin-left:150px;" class="layui-btn layui-btn-normal" type="button" onclick="handle()">添加试题</button>
								<button type="submit" class="layui-btn">发布考试</button>
							</div>
						</div>
						<input id="count" name="count" style="display:none" value="0"></input>
					</div>
				</form>
				<br>
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
<script src="../layui/layui.js" charset="UTF-8"></script>
<script>
	var questionCount = 0;

	function handle() {
		var count = document.getElementById("count");
		questionCount++;
		count.setAttribute("value", questionCount);
		var questionsList = document.getElementById("questions");
		var newQuestion = document.createElement("div");
		newQuestion.className = "layui-panel";
		newQuestion.style.width = "550px";

		newQuestion.style.marginBottom = "10px";
		var div = document.createElement("div");
		var X = document.createElement("label");
		X.className = "layui-form-label";
		X.innerHTML = `第${questionCount}题`;
		div.appendChild(X);
		var input = document.createElement("input");
		input.setAttribute("placeholder", "请输入题目描述:");
		input.setAttribute("name", `describe${questionCount}`);
		input.className = "layui-input-block";
		input.style.marginLeft = 0;
		input.style.width = "400px";
		div.appendChild(input);
		newQuestion.appendChild(div);
		//input.setAttribute('class','');
		// 用于添加class名
		var options = document.createElement("div");
		for (var i = 0; i < 4; i++) {
			var optionX = document.createElement("div");
			var X = document.createElement("label");
			X.className = "layui-form-label";
			// X.className = "layui-form-item";
			X.innerHTML = String.fromCharCode(65 + i);
			optionX.appendChild(X);
			var optionInput = document.createElement("input");
			optionInput.setAttribute("placeholder", "请输入选项内容");
			optionInput.setAttribute("name", `option${questionCount}${i}`);
			optionInput.className = "layui-input-block";
			optionInput.style.width = "400px";
			optionInput.style.marginTop = "5px";
			optionInput.style.marginLeft = 0;
			optionX.appendChild(optionInput);
			options.appendChild(optionX);
		}
		var correctOption = document.createElement("div");
		var label = document.createElement("label");
		label.innerHTML = "正确选项";
		label.className = "layui-form-label";
		correctOption.appendChild(label);
		var optionInput = document.createElement("input");
		optionInput.className = "layui-input-block";
		optionInput.style.marginLeft = 0;
		optionInput.setAttribute("placeholder", "请输入正确选项");
		optionInput.setAttribute("name", `correctOption${questionCount}`);
		optionInput.style.width = "400px";
		optionInput.style.marginTop = "5px";
		correctOption.appendChild(optionInput);

		newQuestion.appendChild(input);
		newQuestion.appendChild(options);
		newQuestion.appendChild(correctOption);
		questionsList.appendChild(newQuestion);
	}
</script>