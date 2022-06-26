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
				<h2>&rsaquo;发布作业
				</h2>
				<br><br>
				<!-- TO DO -->

				<div class="layui-col-md3">
					<form action="homeworkhandle.php" method="post">
						<div>
							<h5><?php
								echo "<h4 style=\"display:inline;\">" . $teacher->Name . "</h4>";
								?>老师，您好<br><br>
								请在您教授的课程中选择发布作业的课程</h5>
							<br /><br />
							<select name="course" lay-verify="" style="width:420px;height:40px;border-color:#eee">
								<?php
								while ($row = mysqli_fetch_array($qry)) {
									echo "<option>" . $row['course'] . "</option>";
								}
								?>
							</select>
						</div>
						<br>
						<h5>请填写作业要求详情:</h5>
						<br />
						<div>
							<input type="text" name="content" class="layui-input" placeholder="请输入详细要求">
						</div>
						<br /><br />
						<button class="layui-btn layui-btn-radius layui-btn-normal" type="submit">发布作业</button>
					</form>
				</div>



				<div class="layui-col-md8 layui-form" style="padding-top: 35px;padding-left: 200px;">
					<div class="layui-panel">
						<div style="margin:15px">
							<h4>查看已提交作业的学生</h4>
							<br />
							<select id="query" lay-verify="">
								<option>选择要查看的作业</option>
								<?php
								
								$sql = "SELECT * FROM homework WHERE course in (SELECT course FROM courses WHERE teacher = \"$teacher->Name\")";
								$qry = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($qry)) {
									$content = $row['course'] . "-" . $row['content'];
									if (strlen($content) >= 40) $content = mb_substr($content, 0, 40) . "...";
									echo "<option value = " . $row['id'] . ">" . $content . "</option>";
								}
								?>
							</select>
							<br />
							<button class="layui-btn layui-btn-radius layui-btn-normal" onclick="handleQuery()">确定</button>
							<br><br />
							<div style="overflow-y:scroll;height:350px">
								<table class="layui-table ">
									<thead class="layui-table-header">
										<th>序号</th>
										<th>学号</th>
										<th>姓名</th>
										<th>提交文件(点击下载)</th>
									</thead>
									<tbody id="studentList">

									</tbody>
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
			</p>
			<br />
		</div>
	</div>
</body>

</html>
<script type="text/javascript">
	function handleQuery() {
		var queryItem = document.getElementById("query");

		var studentListTable = document.getElementById('studentList');
		studentListTable.innerHTML = "";
		if (queryItem == null) {
			//console.log("null");]
		}
		var queryItemindex = queryItem.selectedIndex;
		if (queryItemindex == 0) {
			alert("请选择要查看的作业");
		} else {
			// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
			xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					//console.log(xmlhttp.responseText);
					var studentList = JSON.parse(xmlhttp.responseText);
					for (var index in studentList) {
						//console.log(index);
						var tr = document.createElement('tr');
						var innerHTML = "<tr>";

						// for (var item in studentList[index]) {
						// 	console.log(item);
						// 	//console.log(studentList[index][item]);
						// 	innerHTML += `<td>${studentList[index][item]}</td>`;
						// }
						innerHTML += `<td rowspan = "2">${studentList[index]['id']}</td>`;
						innerHTML += `<td>${studentList[index]['student_id']}</td>`;
						innerHTML += `<td>${studentList[index]['student_name']}</td>`;
						if (studentList[index]['existfile'] == 1) {
							var filename = studentList[index]['filename'];
							filename = filename.split("-");
							filename = filename[filename.length - 1];

							innerHTML += `<td><a style = "color:red"; href = "../upload/${studentList[index]['filename']}" download = "">${filename}</a></td>`
						} else {
							innerHTML += `<td>没有提交文件</td>`;

						}

						tr.innerHTML = innerHTML + "</tr>";


						studentListTable.appendChild(tr);

						var tr2 = document.createElement('tr');
						innerHTML = `<tr><td>内容</td><td colspan = "2">${studentList[index]['content']}</td></tr>`;
						tr2.innerHTML = innerHTML;
						studentListTable.appendChild(tr2);


					}
					//alert(studentList);
					// var studentListElement = document.getElementById("studentList");
					// studentListElement.innerHTML = studentList;
				}
			}
			var id = queryItem.options[queryItemindex].value;
			xmlhttp.open("GET", "homeworkquery.php?id=" + id, true);
			xmlhttp.send();
		}
	}
</script>
<script src="../layui/layui.js" charset="UTF-8"></script>