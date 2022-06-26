<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
	<title>workspace</title>
	<meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
	<script src="../layui/layui.js" charset="UTF-8"></script>
</head>

<?php
$con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
if (!$con)
	die("连接错误: " . mysqli_connect_error());

// print_r($FileArray);
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
				<h3>&rsaquo;资料</h3>
				</br></br>

				<?php
				include '../getDirFile.php';
				$Dir = '../material';

				$FileArray = getFile($Dir);
				// foreach ($FileArray as $file) {
				//     echo "<h5>" . $file . "</h5>";
				// }
				?>

				<div style="overflow-y:scroll;height:650px">
					<table class="layui-table " style="width:1200px">
						<tr class="layui-table-header">
							<td>课程</td>
							<td>名称</td>
							<td>操作</td>
						</tr>
						<?php
						if (empty($FileArray) == false) {
							foreach ($FileArray as $file) {
								// print_r($file);
								$sql = "SELECT * FROM material WHERE name = " . "\"$file\"";
								$arraylist = explode("-", $file);
								$filename = "";
								for ($i = 1; $i < count($arraylist); $i++){
									$filename = $filename . $arraylist[$i];
								}
								$res = mysqli_query($con, $sql);
								if ($row = mysqli_fetch_array($res)) {
									echo "<tr>";
									echo "<td style = \"width:20%\">" . $row['course'] . "</td>";
									echo "<td>" . $filename . "</td>";
									echo "<td style = \"width:20%\"><a style = \"color:red\"href = \"../material/" . $file . "\" download = \"$filename\">下载</a></td>";
									echo "</tr>";
								}
							}
						}

						?>

					</table>
					<!-- TO DO -->
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
	function handle(id) {
		location.replace("homeworksubmit.php?id=" + id);
	}
</script>