<?php
//查找该班级的人数、平均年龄和平均成绩并显示出来
//前端表单的下拉列表来选择要查看的班级名称
//
//类似 SimSelect
require_once 'model.php';
if(!isLogin())
    header('refresh:0.1; url=index.php');
$mysqli = connect();
session_start();//开启会话存储数据
//print_r($_SESSION['ClassSelect']);//数据调试
$ClassSelect = $_SESSION['ClassSelect'];//取出数据
$_SESSION['ClassSelect']=null;
//session_destroy();//获取完数据后就删除 意味着刷新界面就没有已查询的数据(加入了登录功能 所以不能直接删除)

?>
<nav class="main_menu">
    <table class="tables" align="center" border="1" cellspacing="0" width="800">
        <tr>
            <th>2020-6-7</th>
            <th><a href="index.php?action=browse">浏览学生信息</a></th>
            <th><a href="index.php?action=addStudent">添加学生信息</a></th>
            <th><a href="index.php?action=simplenessSelect">简单查询</a></th>
            <th>分组统计查询</th>
            <th><a href="logout.php">退出登录</a></th>
        </tr>
    </table>
</nav>
<!--添加学生信息-->
<div class="content">
    <form action="action.php" method="post">
        <table align="center" class="tables" border="1" cellspacing="0" width="300">
            <tr style="background-color: #e6e6e6;" align="center">
                <td>
                    <select name='select'>
                        <?php
                        $result = $mysqli->query("select * from bjb");//查编辑班级表数据
                        //                        print_r($result);
                        //查询成功
                        ///遍历查到的数据数组 输出
                        while ($row = $result->fetch_row()) {
                            //select post:value传班级id ,页面显示的是班级名称
                            echo "<option value='{$row[0]}'>{$row[1]}</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input type="submit" name="submit" value="ClassSelect"></td>
            </tr>
        </table>
    </form>
    <?php
    if ($ClassSelect) {
//        echo "true";
        //查询成功 成功返回数据后才显示下列内容！！！
        ?>
        <table align="center" class="tables" border="1" cellspacing="0" width="700">
            <tr>
                <th colspan="9"><?php echo "专业：" . $ClassSelect[0][4] ?></th>
            </tr>
            <tr style="background-color: #e6e6e6;">
                <th>考生号</th>
                <th>姓名</th>
                <th width="40px">性别</th>
                <th>出生日期</th>
                <th>专业</th>
                <th>班级代号</th>
                <th>总成绩</th>
            </tr>
            <tr>
                <?php
                ///遍历查到的数据数组 输出
                /// 求 人数 平均年龄 平均成绩
                $numberOfStudent = 0;//人数
                $nowYear = date("Y");//取现在年份 计算年龄
                //                echo $nowYear;//
                $age = 0;
                $score = 0;
                foreach ($ClassSelect as $item) {//遍历二维数组
                    $numberOfStudent++;
                    $timestamp = strtotime($item[3]);
                    //日期转换为UNIX时间戳用函数：strtotime 进行处理
                    $age += $nowYear - (int)date("Y", $timestamp);//年龄求和
                    $score += $item[6];
                    echo '<tr align ="center">';
                    foreach ($item as $value) {//遍历每一行的每个数据[遍历row数组]
                        echo "<td >{$value}</td>";
                    }
                    echo '</tr>';
                }
                $averageAge = (int)($age / $numberOfStudent);//整型输出
                $averageScore = round($score / $numberOfStudent,2);//保留小数点后两位
                ?>
            </tr>
            <!--统计数据-->
            <tr>
                <td colspan="2"><?php echo "班级人数：$numberOfStudent" ?></td>
                <td colspan="2"><?php echo "班级平均年龄：$averageAge" ?></td>
                <td colspan="3"><?php echo "班级平均分数：$averageScore" ?></td>
            </tr>
        </table>
    <?php } ?>
</div>
