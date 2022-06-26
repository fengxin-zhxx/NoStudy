<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU">

<head>
    <title>workspace</title>
    <meta http-equiv="content-type" content="application/xhtml; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../layui/css/layui.css" />
	<script src="../layui/layui.js" charset="UTF-8"></script>
</head>

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
       			<li class="layui-nav-item"><a href="message.php"><i class="layui-icon layui-icon-notice">   通知</i> </a></li>
       			<li class="layui-nav-item"><a href="homework.php"><i class="layui-icon layui-icon-face-cry">   作业</i></a></li>
       			<li class="layui-nav-item"><a href="checkin.php"><i class="layui-icon layui-icon-release">   签到</i></a></li>
       			<li class="layui-nav-item"><a href="material.php"><i class="layui-icon layui-icon-list">   资料</i></a></li>
       			<li class="layui-nav-item"><a href="discuss.php"><i class="layui-icon layui-icon-dialogue">   讨论</i></a></li>
       			<li class="layui-nav-item"><a href="exam.php"><i class="layui-icon layui-icon-face-surprised">   考试</i></a></li>
       			<span class="layui-nav-bar" style="top: 55px; height: 0px; opacity: 0;"></span>
       		</ul>
       	</div>
       </div>
	   
        <?php
        $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
        if (!$con)
            die("连接错误: " . mysqli_connect_error());
        

        
        /*
        0 -> id
        1 -> course
        2 -> teacher
        3 -> time
        */
        ?>
        <div id="content"class="layui-body">
			<div style="padding: 30px;">
				<h3>&rsaquo;签到系统</h3>
				<br />
				<!-- TO DO -->
				<h4 style="padding-top: 25px;">当前签到任务:</h4>
				<br />
				
				<div style="overflow-y:scroll;height:650px"> 
					<table class="layui-table " style = "width:1200px">
						<tr class="layui-table-header">
							<td>课程</td>
							<td>教师</td>
							<td>发起时间</td>
							<td>截止时间</td>
							<td>操作</td>
						</tr>
						<?php
						include '../student.php';
						session_start();
						$student = $_SESSION['student'];
						$sql = "SELECT * FROM checkin ORDER BY id DESC";
						$qry = mysqli_query($con, $sql);
						while ($row = mysqli_fetch_array($qry)) {
							echo "<tr>";
							echo "<td>" . $row['course'] . "</td>";
							echo "<td>" . $row['teacher'] . "</td>";
							echo "<td>" . date("Y-m-d H-i-s", $row['time']) . "</td>";
							echo "<td>" . date("Y-m-d H-i-s", $row['endtime']) . "</td>";
							$checkinId = $row['id'];
							$sql = "SELECT * FROM checkin_record WHERE checkin_id = $checkinId and student_id = $student->StudentID";
							$_qry = mysqli_query($con, $sql);
							if (mysqli_fetch_array($_qry))
								echo "<td style=\"color:red;\">" . "已签到" . "</td>";
							else if ($row['endtime'] >= time())
								echo "<td><button onclick=\"handle(this," . $row['id'] . ");\"style=\"width:100%;\">签到</button></td>";
							else
								echo "<td style=\"color:blue;\">" . "已过期" . "</td>";
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
        	</p><br />
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function handle(item, id) {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行的代码
        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var newStatus = xmlhttp.responseText;
                //alert(newStatus);
                var itemParent = item.parentNode;
                //alert(itemParent.innerHTML);
                if (newStatus == "已签到") {
                    alert("签到成功！！");
                    itemParent.innerHTML = newStatus;
                    itemParent.style.color = "red";
                } else {
                    alert("签到已过期，正在刷新页面");
                    //刷新
                    location.reload();
                }

            }
        }
        xmlhttp.open("GET", "checkinhandle.php?id=" + id, true);
        xmlhttp.send();
    }
</script>