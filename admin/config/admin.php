<?php
session_start();
ini_set('display_errors',1);            //错误信息  
ini_set('display_startup_errors',1);    //php启动错误信息  
error_reporting(-1);                    //打印出所有的 错误信息  
include 'config/config.php';
include 'function/function.php';
@$TRecord=$lnk->query("select * from manage where password='".md5($_SESSION['pswd'])."' and username='".$_SESSION['uname_admin']."'");
$RecordCount = $TRecord-> fetch_row();
if (!$RecordCount){
echo "<script language='javascript'>";
echo "alert('非法登录！');";
echo "location.href='login.php';";
echo "</script>";
}
?>