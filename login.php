<!--登录界面 -->
<?php
/**
 * @package user
 * 用户登录，注册界面
 */

require_once 'model.php';//加载常量
header('Content-type:text/html; charset=utf-8');
//判断是否登录
if (isLogin()) {
    echo "<script>alert('你已登录！')</script>";
    header('refresh:0.1; url=index.php');
}
?>
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th><a href="index.php?action=browse">浏览学生信息</a></th>
            <th><a href="index.php?action=addStudent">添加学生信息</a></th>
            <th><a href="index.php?action=simplenessSelect">简单查询</a></th>
            <th><a href="index.php?action=groupCount">分组统计查询</a></th>
        </tr>
    </table>
</nav>
<form action="action.php" method="post" style="
    width: 320px;
    margin: 200px auto;
">
    <fieldset>
        <legend>用户登录</legend>
        <ul style="list-style-type: none;">
            <li>
                <label>用 户 名:</label>
                <input type="text" name="username" style="background-color: #ffffff30;">
            </li>
            <li>
                <label>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:</label>
                <input type="password" name="password" style="background-color: #ffffff30;">
            </li>
            <li>
                <input type="checkbox" name="remember" value="yes">7天内自动登录
            </li>
            <li>
                <label></label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="submit" value="Login">&nbsp;&nbsp;&nbsp;
<!--                <input type="submit" name="register" value="注册">-->
            </li>
        </ul>
    </fieldset>
</form>
</body>
</html>
