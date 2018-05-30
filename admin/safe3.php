<?php
include 'config/admin.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="后台管理">
<meta name="keywords" content="后台管理">
<meta name="author" content="code by vic.tang">
<title>后台管理</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="css/h5style.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>
<table class=" text-center table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td>
<a href="safe3.php"><span class="btn btn-info">管理员添加</span></a> <a href="safe4.php"><span class="btn btn-info">管理员列表</span></a> <a href="safe2.php"><span class="btn btn-info">密码更新</span></a>
</td></tr>
</table>
<?php
@ $action=$_REQUEST["add"];
if ($action!="ok"){
?>
<table class="width98 table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form action=safe3.php method=post>
<tr class=backs><td colspan=2 class=td height=18>添加管理员</td></tr>
<tr><td width=20% align=right height="18">管理员名称</td>
<td><input type="text" name="Username" size="20" value="" maxlength=16>
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="用户名长度：6-16位，可使用中文和字母"> </td></TR>
<tr><td width=20% align=right height="18">请输入密码</td>
<td><input type="password" name="Pass1" size="20"  maxlength=16>
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="密码长度：8-16位<br>建议使用数字和字母组合"> </td></TR>
<tr><td width=20% align=right height="18">请确认密码</td>
<td><input type="password" name="Pass2" size="20"  maxlength=16>
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="请确认密码"> </td></TR>
<tr><td colspan=2><input type="submit" name="Submit" value="确认添加">
<input type="hidden" name="add" value="ok"></td></tr>
</form>
</table>
<?php
}
else
{
if (!$_REQUEST["Username"] or !$_REQUEST["Pass1"] or !$_REQUEST["Pass2"])
{
echo "<script language='javascript'>";
echo "alert('出错了，填写不完整，请检查后重新输入！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
exit();
}
if (strlen($_REQUEST["Username"])<5 or strlen($_REQUEST["Username"])>16){
echo  "<script language='javascript'>";
echo  "alert('出错了，您输入的管理员名称不合要求，要求长度5-16位');";
echo  "location.href='javascript:history.go(-1)';";
echo  "</script>";
exit();
}
if (strlen($_REQUEST["Pass1"])<5 or strlen($_REQUEST["Pass1"])>16) {
echo  "<script language='javascript'>";
echo  "alert('出错了，您输入的密码长度不合要求，要求长度5-16位');";
echo  "location.href='javascript:history.go(-1)';";
echo  "</script>";
exit();
}
if ($_REQUEST["Pass1"]!=$_REQUEST["Pass2"]) {
echo  "<script language='javascript'>";
echo  "alert('出错了，两次输入的密码不符，请检查后重新输入！');";
echo  "location.href='javascript:history.go(-1)';";
echo  "</script>";
exit();
}
$edit_data=mysqli_query("select * from manage where username='".$_REQUEST["Username"]."'");
if($rs=mysql_fetch_array($edit_data))
{
echo "<script language='javascript'>";
echo "alert('出错了，该管理员已经存在，请选择其它名称！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
exit();
}else{
$insert_data="insert into  manage (username,password,manage) values ('".$_REQUEST["Username"]."','".md5($_REQUEST["Pass1"])."','2|4|6')";
$insert_result=$lnk -> query($insert_data) or die(mysql_error());
echo "<script language='javascript'>";
echo  "alert('操作成功，您已经成功添加一个管理员。接下来，请为该管理员设置权限！');";
echo  "location.href='safe4.php?admin=".$_REQUEST["Username"]."';";
echo  "</script>";
}
}
?>
