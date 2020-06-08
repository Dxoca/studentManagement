<?php
require_once 'model.php';
if(!isLogin())
    header('refresh:0.1; url=index.php');
?>
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th><a href="index.php?action=browse">浏览学生信息</a></th>
            <th>添加学生信息</th>
            <th><a href="index.php?action=simplenessSelect">简单查询</a></th>
            <th><a href="index.php?action=groupCount">分组统计查询</a></th>
            <th><a href="logout.php">退出登录</a></th>
        </tr>
    </table>
</nav>
<!--添加学生信息-->
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
                    <input type="text" name="考生号" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="姓名" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="性别" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="出生日期" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="专业" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="班级代号" value="" style="background-color: #ffffff4a;">
                </td>
                <td>
                    <input type="text" name="总成绩" value="" style="background-color: #ffffff4a;">
                </td>
            </tr>
            <tr>
                <td colspan="9" align="center">
                <input type="submit" name="submit" value="AddStudent">
                </td>
            </tr>
        </table>
    </form>
</div>
