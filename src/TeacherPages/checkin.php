<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
	<title>workspace</title>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
</head>

<body>
	<div id="container" class="layui-layout layui-layout-admin">
		<div class="layui-header">
			<div id="logo" class="layui-logo layui-hide-xs layui-bg-black">
				<a style = "color:white"href= "../TeacherMain.php">TeacherWorkSpace</a>
			</div>
		</div>

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
			<div style="padding: 25px;">
				<h2>&rsaquo;发起签到
				</h2>
				<br /><br />
				<!-- TO DO -->

				<div class="layui-col-md3">
					<form action="checkinhandle.php" method="post">
						<div>
							<h5><?php
								echo "<h4 style=\"display:inline;\">" . $teacher->Name . "</h4>";
								?>老师，您好<br /><br />
								请在您教授的课程中选择发起签到的课程</h5>
							<br /><br />
							<select name="course" style="width:420px;height:40px;border-color:#eee">
								<?php
								while ($row = mysqli_fetch_array($qry)) {
									echo "<option>" . $row['course'] . "</option>";
								}
								?>
							</select>
						</div>
						<br>
						<h5>选择签到持续时间</h5>
						<br />
						<div>
							<select name="time" style="width:420px;height:40px;border-color:#eee">
								<option>10分钟</option>
								<option>20分钟</option>
								<option>30分钟</option>
							</select>
						</div>
						<br /><br />
						<!--<input type="submit" value="发起签到"/>-->
						<button class="layui-btn layui-btn-radius layui-btn-normal" type="submit">发布签到</button>
					</form>
				</div>


				<div class="layui-col-md8 layui-form" style="padding-top: 35px;padding-left: 200px;">
					<div class="layui-panel">
						<div style = "margin:15px">
							<h4>查看学生签到情况</h4>
							<br />
							<select id="query">
								<option>选择要查看的签到</option>
								<?php
								
								$sql = "SELECT * FROM checkin WHERE teacher = \"$teacher->Name\"";
								$qry = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($qry)) {
									echo "<option value = " . $row['id'] . ">" . $row['course'] . date("Y-m-d H-i-s", $row['time']) . "</option>";
								}
								?>
							</select>
							<br />
							<button class="layui-btn layui-btn-radius layui-btn-normal" onclick="handleQuery()">确定</button>
							<br><br />

							<div style="overflow-y:scroll;height:350px">
								<table class="layui-table " id="studentList">
									<tr class="layui-table-header">
										<th>序号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>签到时间</th>
									</tr>
								</table>
							</div>
						</div>
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
	function handleQuery() {
		var queryItem = document.getElementById("query");

		var studentListTable = document.getElementById('studentList');
		studentListTable.innerHTML = `<tr class="layui-table-header">
								  <th>序号</th>
								  <th>学号</th>
								  <th>姓名</th>
								  <th>签到时间</th>
								</tr> `;
		if (queryItem == null) {
			//console.log("null");]
		}
		var queryItemindex = queryItem.selectedIndex;
		if (queryItemindex == 0) {
			alert("请选择要查看的签到");
		} else {
			// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
			xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					console.log(xmlhttp.responseText);
					var studentList = JSON.parse(xmlhttp.responseText);
					for (var index in studentList) {
						console.log(index);
						var tr = document.createElement('tr');
						var innerHTML = "";
						for (var item in studentList[index]) {
							console.log(item);
							console.log(studentList[index][item]);
							innerHTML += `<td>${studentList[index][item]}</td>`;
						}
						tr.innerHTML = innerHTML;

						studentListTable.appendChild(tr);
					}
					//alert(studentList);
					// var studentListElement = document.getElementById("studentList");
					// studentListElement.innerHTML = studentList;
				}
			}
			var id = queryItem.options[queryItemindex].value;
			xmlhttp.open("GET", "checkinquery.php?id=" + id, true);
			xmlhttp.send();
		}
	}
</script>
<script src="../layui/layui.js" charset="UTF-8"></script>