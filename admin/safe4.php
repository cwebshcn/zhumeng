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
@$admin=$_REQUEST["admin"];
if ($admin==""){$admin=$_SESSION['uname_admin'];}
if (@$_REQUEST["edit"]!="ok"){
?>
<table class=" text-center table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">	<tr class=backs><td colspan=2 class=td height=18>管理员权限设置</td></tr>
<tr><td width=30% align=right height="100" align=center>
<table border=0 width=90%>
<tr><td>现有管理员：</td></tr>
<?php
$edit_data=$lnk->query("select * from manage");
while($rs=mysqli_fetch_assoc($edit_data))
{
echo "<tr><td><img border=0 src=../images/admin/small_left.gif> ";
if ($admin==$rs["username"])
echo  "<a href=?admin=".$rs["username"]."><font color=red><b>".$rs["username"]."</b></font></a>";
else
echo "<a href=?admin=".$rs["username"].">".$rs["username"]."</a>";
?>
</td><td><img border=0 src=../images/admin/delete.gif alt="删除此管理员" style="cursor:hand" onClick="{if(confirm('该操作不可恢复！\n\n确实要删除这个管理员吗？ ')){location.href='?deladm=<?php echo $rs["username"];?>';}}"></td></tr>
<?php }?>
</table>
</td>
<td align=center>
<table border=0 width=60%>
<form action="" method=post name=manage>
<tr><td><font color=red><b><?php echo $admin;?></b></font> 的管理权限：</td></tr>
<?php
$edit_data=$lnk->query("select * from manage where username='".$admin."'");
if($rs=mysqli_fetch_assoc($edit_data))
$manage=$rs["manage"];
?>
<tr><td>
<?php
$edit_data=$lnk->query("select * from mainbt1 order by px");
while($rs=mysqli_fetch_assoc($edit_data)){
echo "<br><input name='num[]' type=checkbox value=".$rs["id"]." ";
echo yn($rs["id"],$admin);
echo  ">".$rs["leftname"];
}
?></td>
</tr>
</table>
</td>
</tr>
<tr><td colspan=2>
<input type="submit" name="Submit" value="保存设置">
<input type="hidden" name="edit" value="ok">
<input type="hidden" name="admin" value="<?php echo $admin;?>">
</td></tr>
</table>
</form>
<?php
}else{
$rednum=$_REQUEST["num"];
//$renum=implode(",",$rednum);
foreach($rednum as $v){
if (!$setnum){$ifund="";}else{$ifund="|";}
$setnum.=$ifund.$v;
}
//conn.execute("update manage set manage='"&setnum&"' where username='"&admin&"'")
if ($_SESSION['uname_admin']!="admin"){
alert("您没有权限设置,请与高级管理员联系！");
go("safe4.php");
exit();
}
$lnk -> query("update manage set manage='".$setnum."' where username='".$admin."'") or die (mysql_error());
echo "<script language='javascript'>";
echo "alert('管理权限设置成功！');";
echo "location.href='?admin=".$admin."';";
echo"</script>";
}
if (@$_REQUEST["deladm"]!="")
{
$deladm=$_REQUEST["deladm"];
$edit_data=$lnk->query("select * from manage where username='".$deladm."'");
if($rs=mysqli_fetch_assoc($edit_data))
{
if ($deladm==$_SESSION['uname_admin'] or $_SESSION['uname_admin']!="admin")
{
echo "<script language='javascript'>";
echo "alert('您不能删除自己！或没有权限！');";
echo "location.href='?admin=".$admin."';";
echo "</script>";
}else{
$lnk -> query("delete from manage where username='".$deladm."'") or die(mysql_error());
echo "<script language='javascript'>";
echo "alert('您已成功删除管理员".$deladm."');";
echo "location.href='?admin=".$admin."';";
echo "</script>";
}
}else{
echo "<script language='javascript'>";
echo "alert('操作失败，没有此管理员$deladm！');";
echo "location.href='?admin=".$admin."';";
echo "</script>";
}
}
?>