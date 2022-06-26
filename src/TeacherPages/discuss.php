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

$sql = "SELECT * FROM discuss ORDER BY id DESC";
$qry = mysqli_query($con, $sql);
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
			<div style="padding: 30px;">
				<h2>&rsaquo;讨论
				</h2>
				<br><br>

				<button class="layui-btn" onclick="handleCreate()">新建话题</button>
				<div style="overflow-y:scroll;height:350px">
					<table class="layui-table " id="ann_table">
						<thead class="layui-table-header">
							<tr class="layui-table-header">
								<th id="ann_src">来源</td>
								<th id="ann_main">主题</td>
								<th id="ann_detail">具体细节</td>
								<th id="ann_time">时间</td>
								<th id="ann_handle">操作</td>
							</tr>
						</thead>
						<!-- php from message.php-->
						<?php
						while ($row = mysqli_fetch_array($qry)) {
							echo "<tr>";
							if ($row['from_teacher'] == 0) {
								echo "<td>" . $row['source'] . "</td>";
							} else {
								echo "<td>" . $row['source'] . "<span style = \"border-radius:10px;color:white;background-color: purple\">老师</span></td>";
							}
							echo "<td><span>" . $row['topic'] . "</span></td>";
							$content = $row['content'];
							if (strlen($content) >= 40) $content = mb_substr($content, 0, 40) . "...........";
							echo "<td>" . $content . "</td>";
							echo "<td>" . date("Y-m-d h:i:s", $row['date']) . "</td>";
							echo "<td><button class = \"layui-btn\" style = \"background-color:#1E9FFF\"
										 onclick = \"handleQuery(" . $row['id'] . ")\">查看详情</button></td>";
							echo "</tr>";
						}
						?>
					</table>
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
<script type="text/javascript">
	function handleCreate() {
		location.replace("discusscreate.php");
	}

	function handleQuery(id) {
		var url = "discusscontent.php?id=" + id;
		location.replace(url);
	}
</script>