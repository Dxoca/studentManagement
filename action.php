<?php
require_once 'model.php';
$mysqli = connect();
session_start();//开启会话存储数据
//print_r($_POST);//数据调试

//数据操作
switch ($_POST['submit']) {
    ## addStudent
    case 'AddStudent'://添加学生
        $kid = $_POST['考生号'];
        $name = $_POST['姓名'];
        $data = $_POST['出生日期'];
        $sex = $_POST['性别'];
        $class = $_POST['专业'];
        $classID = $_POST['班级代号'];
        $grade = $_POST['总成绩'];
        $add_student_sql = "INSERT INTO `xsb` VALUES ('$kid','$name','$sex','$data','$class','$classID','$grade');";
        $result = $mysqli->query($add_student_sql);
        if ($result) {//数据表信息获取成功
            echo "<script>alert('添加成功');</script>";

        } else {//输出错误信息
            echo $mysqli->error;
        }
        header('refresh:0.5; url=index.php');
        break;
    ##simplenessSelect
    case 'KIDSelect'://简单查询 考生号
        $kid = $_POST['考生号'];
        $result = $mysqli->query("select * from xsb where 考生号='$kid'");
        $ans = $result->fetch_row();//项的所有字段取出
        if ($ans) {//数据表信息获取成功 （ans 空 为false）
            print_r($ans);
            $_SESSION['KIDSelect'] = $ans;
            echo "<script>alert('查询成功');</script>";
        } else {//输出错误信息
            echo $mysqli->error;
            echo "<script>alert('查询失败');</script>";
        }
        header('refresh:0.5; url=index.php?action=simplenessSelect');
        break;

    case 'editStudent'://修改学生信息s
        $kid = $_POST['考生号'];
        $name = $_POST['姓名'];
        $data = $_POST['出生日期'];
        $sex = $_POST['性别'];
        $class = $_POST['专业'];
        $classID = $_POST['班级代号'];
        $grade = $_POST['总成绩'];
        $sql_update = "UPDATE xsb SET 考生号 = '$kid' , 姓名 = '$name', 出生日期 = '$data', 性别 = '$sex', 专业 = '$class', 班级代号 = '$classID' , 总成绩 = '$grade' WHERE 考生号 = '$kid'";//更新数据
        $result = $mysqli->query($sql_update);
        if ($result) {//数据表信息获取成功
            echo "<script>alert('修改成功');</script>";
        } else {//输出错误信息
            echo $mysqli->error;
        }
        header('refresh:0.5; url=index.php');
        break;
    //分组统计
    case 'ClassSelect':
//        print_r($_POST['select']);//取出下拉菜单所选的班级的id value传的 对应 select的name
        $classID = $_POST['select'];
        $result = $mysqli->query("select * from xsb where 班级代号='$classID'");
        print_r($result);//调试数据
        if ($result) {//查询成功
            if (mysqli_num_rows($result)) {//有的专业可能没有同学 班级人数=0
                $_SESSION['ClassSelect'] = $result->fetch_all();//查到的数据数组 fetch_all 二维数组
                print_r($_SESSION['ClassSelect']);
                echo "<script>alert('查询成功');</script>";
            } else {
                echo "<script>alert('没有数据');</script>";
            }
        } else {//输出错误信息
            echo $mysqli->error;
            echo "<script>alert('查询失败');</script>";
        }
        header('refresh:0.5; url=index.php?action=groupCount');
        break;
    case 'Login'://登录
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (($username == '') || ($password == '')) {
            # 若为空,视为未填写,提示错误,并0.1秒后返回登录界面
            echo "<script>alert('用户名或密码不能为空,请重新填写登录信息!')</script>";
        } else if (($username != 'wzkc') || ($password != '666666')) {
            # 用户名或密码错误,同空的处理方式
//            header('refresh:0.1; url=login.php');
            echo "<script>alert('用户名或密码错误,系统将在3秒后跳转到登录界面,请重新填写登录信息! ')</script>";

        } else if (($username == 'wzkc') && ($password == '666666')) {
            # 用户名和密码都正确,将用户信息存到Session中
            $_SESSION['isLogin'] = 1;//1 已登录
            $_SESSION['username'] = $username;//用户名
            // 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天
            if ($_POST['remember'] == "yes") {
                setcookie('email', $username, time() + 7 * 24 * 60 * 60);
                setcookie('code', md5($username . md5($password)), time() + 7 * 24 * 60 * 60);
            } else {
                // 没有勾选则删除Cookie
                setcookie('email', '', time() - 999);
                setcookie('code', '', time() - 999);
            }
            // 处理完附加项后跳转到登录成功的首页
            echo "<script>alert('用户 $username 登录成功！')</script>";//显示用户名 并提示登录成功
//            header('refresh:0.1; url=index.php');
        }
        header('refresh:0.1; url=index.php');
        break;
}
//非post提交的数据判断
switch ($_GET['action']) {
    case 'delete':
        // echo "<td><a href='action.php?deleteKid=$row[0]'>删除</a></td></tr>";
        if (isset($_GET['deleteKid'])) {//删除参数有传递
            $Kid = $_GET['deleteKid'];
            $result = $mysqli->query("delete from xsb where 考生号='$Kid'");
            if ($result) {
                echo "<script>alert('删除成功');</script>";
            } else {
                echo $mysqli->error;
            }
        }
        header('refresh:0.5; url=index.php');
        break;
}
