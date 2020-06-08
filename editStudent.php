<?php
include_once 'model.php';

if(!isLogin())
    header('refresh:0.1; url=index.php');
$editKid = $_GET['editKid'];
$mysqli = connect();
$result = $mysqli->query("select * from xsb where 考生号='$editKid'");
$item = $result->fetch_row();//项的所有字段取出
//print_r($ans);//测试字段
?>
<html>
<head>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
<!--头部-->
<header class="header">
    <div class="h_img">
        <div class="h_img_1">
            <div class="h_img_2">
                <img src="./images/logo1.png"/>
            </div>
            <div class="h_img_3">
                <img src="./images/xiaoxun.png"/>
            </div>
        </div>
    </div>
    <div class="h_img1"></div>
</header>
<!--头部结束-->
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th><a href="index.php?action=browse">浏览学生信息</a></th>
            <th><a href="index.php?action=addStudent">添加学生信息</a></th>
            <th><a href="index.php?action=simplenessSelect">简单查询</a></th>
            <th><a href="index.php?action=groupCount">分组统计查询</a></th>
            <th><a href="logout.php">退出登录</a></th>
        </tr>
    </table>
</nav>
<!--更新学生信息-->
<div class="content">
    <form action="action.php" method="post">
        <table align="center" class="tables" border="1" cellspacing="0" width="600">
            <tr style="background-color: #e6e6e6;">
                <th>考生号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>出生日期</th>
                <th>专业</th>
                <th>班级代号</th>
                <th>总成绩</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="考生号" value="<?php echo $item[0]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="姓名" value="<?php echo $item[1]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="性别" value="<?php echo $item[2]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="出生日期" value="<?php echo $item[3]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="专业" value="<?php echo $item[4]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="班级代号" value="<?php echo $item[5]?>" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="总成绩" value="<?php echo $item[6]?>" style="background-color: #ffffff4a;">
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                    <input type="submit" name="submit" value="editStudent">
                </td>
            </tr>
        </table>
    </form>
</div>
<!--foot底部-->
<footer class="footer">
    <div class="container">
        <div class="footer-top clearfix">
            <div class="four columns foot">

            </div>
            <div class="four columns foot">
                <h3><img src="./images/logofoot.png" alt=""></h3>
                <div class="twitter">
                    <ul>
                        <li>地址：武汉市阳逻经济开发区汉施路1号 <br>
                            联系电话：027-89649818 89649828 <br>
                            主办：武汉生物工程学院党委宣传部 鄂ICP备09018573号<br>
                            <div style="width:300px;margin:0 auto; padding:20px 0;">
                                <a target="_blank"
                                   href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=42011702000058"
                                   style="display:inline-block;text-decoration:none;height:20px;line-height:20px;"><img
                                            src="./images/batb.png" style="float:left;">
                                    <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#939393;">
                                        鄂公网安备 42011702000058号</p></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="four columns foot">
                <div class="latest-project">
                    <div class="w3">
                        <div class="weix"><img src="./images/wx.png" alt="" width="100" height="100">
                            <p>微信</p>
                        </div>
                        <div class="weix"><img src="./images/wb.png" alt="" width="100" height="100">
                            <p>微博</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-top -->
    </div>
    <div class="container">
        <!-- footer-bottom -->
    </div>
</footer>

</body>
</html>


