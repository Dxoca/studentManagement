<?php
require_once 'model.php';
if(!isLogin())
    header('refresh:0.1; url=index.php');

session_start();//开启会话存储数据
//print_r($_SESSION['KIDSelect']);//数据调试
$KidSelect = $_SESSION['KIDSelect'];
$_SESSION['KIDSelect']=null;
//session_destroy();//获取完数据后就删除 意味着刷新界面就没有已查询的数据(加入了登录功能 所以不能直接删除)

?>
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th><a href="index.php?action=browse">浏览学生信息</a></th>
            <th><a href="index.php?action=addStudent">添加学生信息</a></th>
            <th>简单查询</th>
            <!--            <th><a href="index.php?action=simplenessSelect' ?>">简单查询</a></th>-->
            <th><a href="index.php?action=groupCount">分组统计查询</a></th>
            <th><a href="logout.php">退出登录</a></th>

        </tr>
    </table>
</nav>
<!--添加学生信息-->
<div class="content">
    <form action="action.php" method="post">
        <table align="center" class="tables" border="1" cellspacing="0" width="400">
            <tr style="background-color: #e6e6e6;">
                <td>考生号</td>
                <td>
                    <input type="text" name="考生号" value="" style="background-color: #ffffff4a;">
                </td>
                <td><input type="submit" name="submit" value="KIDSelect"></td>
            </tr>
        </table>
    </form>
    <?php
    if ($KidSelect) {
//        echo "true";
        //查询成功 成功返回数据后才显示下列内容！！！
        ?>
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
                <?php
                ///遍历查到的数据数组 输出
                foreach ($KidSelect as $value) {//遍历每一行的每个数据[遍历row数组]
                    echo "<td >{$value}</td>";
                }
                ?>
            </tr>
        </table>
    <?php } ?>
</div>
