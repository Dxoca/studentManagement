<?php
require_once 'model.php';
if(!isLogin())
    header('refresh:0.1; url=index.php');
?>
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th>浏览学生信息</th>
            <th><a href="index.php?action=addStudent">添加学生信息</a></th>
            <th><a href="index.php?action=simplenessSelect">简单查询</a></th>
            <th><a href="index.php?action=groupCount">分组统计查询</a></th>
            <th><a href="logout.php">退出登录</a></th>
        </tr>
    </table>
</nav>
<!--浏览学生信息-->
<div class="content">
    <table align="center" class="tables" border="1" cellspacing="0" width="800">
        <tr style="background-color: #e6e6e6;">
            <th>考生号</th>
            <th>姓名</th>
            <th>性别</th>
            <th>出生日期</th>
            <th>专业</th>
            <th>班级代号</th>
            <th>总成绩</th>
            <th>操作</th>
        </tr>
        <?php
        $result = $mysqli->query("select * from xsb");//获取学生表的数据

        ## 分页部分
        $page = $_GET['page'];
        //获取当前页码
        if ($page == 0) $page = 1; //默认值
        //设置每页最大能显示的数量
        $pageSize = 10;
        $recordCount = mysqli_num_rows($result);//总数据量
        //计算总页数
        if ($recordCount == 0)
            $pageCount = 0;
        else if ($recordCount < $pageSize || $recordCount == $pageSize) {
            $pageCount = 1;
            //如果记录总数量小于每页显示的记录数量，则只有一页
        } else if ($recordCount % $pageSize == 0) {
            $pageCount = $recordCount / $pageSize;
            //如果没有余数，则页数等于总记录数量除以每页显示记录的数量
        } else
            $pageCount = (int)($recordCount / $pageSize) + 1;
        //取记录总数量不能整除每页显示记录的数量，
        //则页数等于总记录数量除以每页显示记录数量的结果取整再加 1
        $thisPage = ($page - 1) * $pageSize;
        $content_sql_page = "select * from xsb limit {$thisPage},{$pageSize}";
        $result_page = $mysqli->query($content_sql_page);//计算当前页的内容

        ## 打印当前页的数据
        if ($result_page) {//数据表信息获取成功
            //fetch_row()函数每执行一次，指针向后自动移动一位，直到最后没有数据记录返回false
            while ($row = $result_page->fetch_row()) {
                echo '<tr align ="center">';
                //        print_r($row[0] .'<br>'); //调试数据
                foreach ($row as $value) {//遍历每一行的每个数据[遍历row数组]
                    echo "<td >{$value}</td>";
                }
                echo "<td><a href='editStudent.php?editKid=$row[0]'>修改</a>/";
                echo "<a href='action.php?action=delete&deleteKid=$row[0]'>删除</a></td></tr>";
            }
        } else {//输出错误信息
            echo $mysqli->error;
        }
        ?>
        <tr>
            <td colspan="9">
                <div class="pageChange" align="center">
                    <?php
                    echo "共 $recordCount 条记录 ";
                    echo("第" . $page . "页/共" . $pageCount . "页&nbsp");
                    //显示分页链接
                    if ($page == 1) echo("首页 ");
                    else echo("<a href=index.php?page=1>首页</a>&nbsp");
                    //设置上一页连接
                    if ($page == 1) echo("上一页 ");
                    else echo("<a href=index.php?page=" . ($page - 1) . ">上一页 </a>&nbsp");
                    //设置下一页链接
                    if ($page == $pageCount) echo("下一页 ");
                    else echo("<a href=index.php?page=" . ($page + 1) . ">下一页 </a>&nbsp");
                    //设置最后一页
                    if ($page == $pageCount) echo("尾页 ");
                    else echo("<a href=index.php?page=" . $pageCount . ">尾页 </a>&nbsp");
                    ?>
                </div>
            </td>
        </tr>
    </table>
</div>
