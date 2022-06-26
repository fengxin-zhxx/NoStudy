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
        
        $sql = "SELECT * FROM notice ORDER BY id DESC";
        $qry = mysqli_query($con, $sql);
        /*
        0 -> id
        1 -> source
        2 -> topic
        3 -> date
        */
        ?>
		
        <div id="content"class="layui-body">
			<div style="padding: 30px;">
				<h3>&rsaquo;通知</h3>
				<br /><br />
				
				<div style="overflow-y:scroll;height:650px">
					<table class="layui-table " id="ann_table" style = "width:1200px">
						<tr class="layui-table-header">
							<td id="ann_src">来源</td>
							<td id="ann_main">主题</td>
							<td id="ann_time">时间</td>
							<td id="ann_time">操作</td>
						</tr>
						<?php
						while ($row = mysqli_fetch_array($qry)) {
							echo "<tr>";
							echo "<td style = \"width:30%\">" . $row['source'] . "</td>";
							echo "<td style = \"width:20%\"><span style = \"color:blue;\">" . $row['topic'] . "</span></td>";
							echo "<td style = \"width:20%\">" . $row['date'] . "</td>";
							echo "<td style = \"width:10%\"><button  onclick = \"handle(" . $row['id'] . ")\" class = \"layui-btn\">查看详情</button>";
							echo "</tr>";

							echo "<tr id = message".$row['id']." style=\"display:none;\">";
							echo "<td>内容:</td>";
							echo "<td colspan = \"3\">".$row['content']."</td>";
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
    function handle(id) {
        var messageId = "message" + id;
        var messageContent = document.getElementById(messageId);
        if(messageContent.style.display == "table-row"){
            messageContent.style.display = "none"
        }else messageContent.style.display = "table-row";
    }
</script>