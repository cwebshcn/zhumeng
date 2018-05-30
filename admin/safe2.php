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
$admin=$_SESSION['uname_admin'];
@$action=$_REQUEST['edit'];
if ($action!="ok")
{
?>
<table class=" text-center table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form action=safe2.php method=post>
<tr class=backs><td colspan=2 class=td height=18>管理员密码修改</td></tr>
<tr>
<td width=20% align=right height="18">管理员名称</td>
<td class="text-left"><input type="text" readonly name="Username" size="20" value="<?php echo $admin;?>">
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="管理员名称不能修改<br>可添加新管理员后删除老管理员">
</td>
</TR>
<tr>
<td width=20% align=right height="18">请您输入旧密码</td>
<td class="text-left"><input type="password" name="Pass0" size="20"  maxlength=16> </td>
</tr>
<tr><td width=20% align=right height="18">请您输入新密码</td>
<td class="text-left"><input type="password" name="Pass1" size="20"  maxlength=16>
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="密码长度：8-16位<br>建议使用数字和字母组合"> </td></TR>
<tr><td width=20% align=right height="18">请您确认新密码</td>
<td class="text-left"><input type="password" name="Pass2" size="20"  maxlength=16>
&nbsp;&nbsp; <img src=../images/admin/memo.gif alt="确认新密码"> </td></TR>
<tr><td colspan=2><input type="submit" name="Submit" value="确认修改">
<input type="hidden" name="edit" value="ok"></td></tr>
</form>
</table>
<?php
}
else
{
if (trim($_REQUEST['Pass1'])!=trim($_REQUEST['Pass2'])) {
echo "<script language='javascript'>";
echo "alert('出错了，两次输入的新密码不符，请检查后重新输入！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
}
if (strlen(trim($_REQUEST['Pass1']))<8) {
echo "<script language='javascript'>";
echo "alert('出错了，您输入的新密码太短了，要求长度为8-16位，建议使用数字和字母组合！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
}
//表查询
$edit_data=mysqli_query("select * from manage where username='".$admin."'");
while($row_edit=mysql_fetch_array($edit_data))
{
$md5pass=md5($_REQUEST['Pass1']);
if ($row_edit['password']!=md5($_REQUEST['Pass0']))
{
echo "<script language='javascript'>";
echo "alert('出错了，旧密码不正确，请检查后重新输入！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
}else{
$update_edit="update manage set password='$md5pass' where username='".$admin."'";
$update_result=mysqli_query($update_edit);
echo "<script language='javascript'>";
echo "alert('密码更新成功，请牢牢记住您的新密码！！现在将退出管理中心，请用新密码重新登录！');";
echo "location.href='admin.php';"	;
echo "</script>";
}
}
}
?>