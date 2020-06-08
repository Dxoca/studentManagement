<?php
/**
 *
 * @author Dxoca.cn
 * @timd 2020年6月8日 15:22:07
 *
 * 首页 通过switch切换中间的页面
 * 若不登录 则不能对数据进行操作
 * username:wzkc
 * password:666666
 *
 */
require_once 'model.php';
$mysqli = connect();
$action = $_GET['action'];//获取 菜单功能分类参数 改变页面内容
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
<!--菜单-->

<?php
//根据action 选择页面的内容 头部和底部都保持不变
if(!isLogin()){
    $action='Login';
    echo "<script>alert('请先登录！ ')</script>";

}
switch ($action) {
    case 'addStudent'://添加学生
        include 'addStudent.php';
        break;
    case 'simplenessSelect'://简单查询
        include 'simplenessSelect.php';
        break;
    case 'Login'://登录
        include 'Login.php';
        break;
    case 'groupCount'://分组计算
        include 'groupCount.php';
        break;
    case 'browse'://浏览学生信息
        include 'browse.php';
        break;
    default:
        include 'browse.php';//默认浏览学生信息
        break;
}
?>
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
