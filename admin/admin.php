<?php
include 'config/admin.php';
?>
<?php
@$c=$_GET["c"];
if($c=="logout"){
$_SESSION['uname_admin']="";
$_SESSION['pswd']="";	#设置session
alert("成功退出");
go("login.php");
}
?>