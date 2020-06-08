<?php
/**
 * @return Mysqli|返回连接后的数据库对象
 */
function connect()
{
    $serve = 'localhost:3306';
    $username = 'root';
    $password = 'root';
    $dbname = 'pmlx';//数据库名字
    $mysqli = new Mysqli($serve, $username, $password, $dbname);//创建连接
    if ($mysqli->connect_error) {//判断是否链接成功
        die('connect error:' . $mysqli->connect_errno);//
    }
    $mysqli->set_charset('UTF-8'); // 设置数据库字符集
    return $mysqli;
}

/**
 * @return int
 * 判断是否已登录
 */
function isLogin()
{
    $email = null;
    // 开启Session
    session_start();
    //首先判断Cookie是否有记住了用户信息
    if (isset($_COOKIE['username'])) {
        # 若记住了用户信息,则直接传给Session
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['isLogin'] = 1;
    }
    //已登录
    if (isset($_SESSION['isLogin'])) {
        return 1;
    } else {// 若没有登录
        return 0;
    }
}