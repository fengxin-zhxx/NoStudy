<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root",  "1638547819", "website_xixifu");
    if (!$con)
        die("连接错误: " . mysqli_connect_error());
    
    $sql = "SELECT * FROM notice";
    $qry = mysqli_query($con, $sql);
    /*
        0 -> id
        1 -> source
        2 -> topic
        3 -> date
        */
    ?>
    <div id="content">
        <h3>&rsaquo;通知
        </h3>
        <table border="1" id="ann_table" style="font-size: 35px;">
            <tr>
                <td id="ann_src" style="width: 150px;text-align:center">来源</td>
                <td id="ann_main"style="width: 350px;text-align:center">主题</td>
                <td id="ann_time"style="width: 250px;text-align:center">时间</td>
            </tr>

            <?php
            while ($row = mysqli_fetch_array($qry)) {
                echo "<tr>";
                echo "<td style=\"text-align:center\">" . $row['source'] . "</td>";
                echo "<td><a href=\"\#\">" . $row['topic'] . "</a></td>";
                echo "<td style=\"text-align:center\">" . $row['date'] . "</td>";
                echo "</tr>";
            }
            ?>

        </table>
        <!-- TO DO -->
    </div>
</body>

</html>