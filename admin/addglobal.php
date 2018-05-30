<?php include 'config/admin.php'; ?>
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
<!--------UE------->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>
<?php
//=------------动作说明-------------------
@$action=$_GET['act']; #获取动作
@$pid=$_GET['pid']+0; #得到当前ID
?>
<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?act=del&pid="+id;
}
}
</script>
<?php
//rem 删除全局变量
if ($action=="del" and $pid!=""){
$num=$_GET['pid'];
$result=$lnk -> query("delete  from global_data where id=$pid");
alert('操作成功，字段成功删除');
goback();
}
//添加新全局变量
if ($action=="addnew"){
$name=$_POST['name'];
$type=$_POST['typea'];
$content=$_POST['content'];
$contentdata="请编辑";
$ico=$_POST['ico'];
if ($name==""){
alert('不能为空!');
goback();
}
else
{
$insert_data="insert into global_data (name,type,content,contentdata,ico) values ('$name','$type','$content','$contentdata','$ico')";
//echo $insert_data;
$insert_result=$lnk -> query($insert_data) or die(mysql_error());
alert('插入成功!');
echo "<script>parent.location.href='home.php';</script>";
}
}
?>
<?php
if($action==""){
?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">您的位置：全局数据管理 >> </a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="?act=addroot"><span class='glyphicon glyphicon-plus'></span> 添加全局数据</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24"><strong>全局数据</strong>  管理</td>
</tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td width="5%"><strong>序号</strong></td>
<td width="15%"><strong>全局名称</strong></td>
<td width="49%"><strong>说明</strong></td>
<td width="16%"><strong>图标</strong></td>
<td width="16%"><strong>操作</strong></td>
</tr>
<?php
function typename($id){
switch ($id)
{
case 0:
$tyea="文本";
break;
case 1:
$tyea="图片";
break;
case 2:
$tyea="介绍";
break;
case 3:
$tyea="编辑器";
break;
default:
$tyea="其它";
break;
}
return $tyea;
}
//更新字段
$sql="select * from global_data order by id";
$result=$lnk -> query($sql);
$i=1;
while($row=mysqli_fetch_assoc($result)){
echo "<tr><td>$i</td><td>".$row["name"]."</td><td class='text-info'><em>".$row["content"]." &nbsp; &nbsp; <span class='text-success'>[".typename($row["type"])."]</span></em></td><td><img src=".$row["ico"]."></td><td><a href='javascript:void(0)' onClick='confirmLink(".$row["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
$i++;
}
?>
</table>
<?php }?>
<?php
///添加根目录
if ($action=="addroot"){
?>
<form name="form1" method="post" action="?act=addnew">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td height=18 colspan="2" class=td><strong>全局数据</strong> 添加</td>
</tr>
<tr>
<td width="18%" height=25><label>全局数据名称*</label></td>
<td width="82%"><input name="name" type="text" id="name" size="40" ></td>
</tr>
<tr>
<td height=25>类型</td>
<td><input name="typea" type="radio" id="radio" value="0" checked="CHECKED">
文本
<input name="typea" type="radio" id="radio2" value="1">
图片
<input name="typea" type="radio" id="radio3" value="2" >
介绍
<input name="typea" type="radio" id="radio4" value="3" >
编辑器
<input name="typea" type="radio" id="radio5" value="4" disabled>
单选
<input name="typea" type="radio" id="radio6" value="5" disabled>
多选
<input name="typea" type="radio" id="radio7" value="6" disabled>
下拉列表</td>
</tr>
<tr>
<td >全局说明</td>
<td><textarea name="content" cols="100" rows="4" id="content" style="border:1px solid  #8FB9CB;height:60px;"></textarea></td>
</tr>
<tr>
<td colspan="2" >
<div>
<ul class="layout-icon">
<li><label title="about.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/about.png" /></td>
<td><img src="images/ico/about.png" alt="about.png" /></td>
</tr>
</table>
</label></li>
<li><label title="about2.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/about2.png" /></td>
<td><img src="images/ico/about2.png" alt="about2.png" /></td>
</tr>
</table>
</label></li>
<li><label title="activities.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/activities.png" /></td>
<td><img src="images/ico/activities.png" alt="activities.png" /></td>
</tr>
</table>
</label></li>
<li><label title="alias.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/alias.png" /></td>
<td><img src="images/ico/alias.png" alt="alias.png" /></td>
</tr>
</table>
</label></li>
<li><label title="android.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/android.png" /></td>
<td><img src="images/ico/android.png" alt="android.png" /></td>
</tr>
</table>
</label></li>
<li><label title="announcement.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/announcement.png" /></td>
<td><img src="images/ico/announcement.png" alt="announcement.png" /></td>
</tr>
</table>
</label></li>
<li><label title="applications.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/applications.png" /></td>
<td><img src="images/ico/applications.png" alt="applications.png" /></td>
</tr>
</table>
</label></li>
<li><label title="article.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/article.png" /></td>
<td><img src="images/ico/article.png" alt="article.png" /></td>
</tr>
</table>
</label></li>
<li><label title="banner.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/banner.png" /></td>
<td><img src="images/ico/banner.png" alt="banner.png" /></td>
</tr>
</table>
</label></li>
<li><label title="card.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/card.png" /></td>
<td><img src="images/ico/card.png" alt="card.png" /></td>
</tr>
</table>
</label></li>
<li><label title="city.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/city.png" /></td>
<td><img src="images/ico/city.png" alt="city.png" /></td>
</tr>
</table>
</label></li>
<li><label title="cloud.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/cloud.png" /></td>
<td><img src="images/ico/cloud.png" alt="cloud.png" /></td>
</tr>
</table>
</label></li>
<li><label title="color.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/color.png" /></td>
<td><img src="images/ico/color.png" alt="color.png" /></td>
</tr>
</table>
</label></li>
<li><label title="comment.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/comment.png" /></td>
<td><img src="images/ico/comment.png" alt="comment.png" /></td>
</tr>
</table>
</label></li>
<li><label title="company.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/company.png" /></td>
<td><img src="images/ico/company.png" alt="company.png" /></td>
</tr>
</table>
</label></li>
<li><label title="control.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/control.png" /></td>
<td><img src="images/ico/control.png" alt="control.png" /></td>
</tr>
</table>
</label></li>
<li><label title="copyright.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/copyright.png" /></td>
<td><img src="images/ico/copyright.png" alt="copyright.png" /></td>
</tr>
</table>
</label></li>
<li><label title="credit.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/credit.png" /></td>
<td><img src="images/ico/credit.png" alt="credit.png" /></td>
</tr>
</table>
</label></li>
<li><label title="default.gif">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/default.gif" /></td>
<td><img src="images/ico/default.gif" alt="default.gif" /></td>
</tr>
</table>
</label></li>
<li><label title="default.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/default.png" checked /></td>
<td><img src="images/ico/default.png" alt="default.png" /></td>
</tr>
</table>
</label></li>
<li><label title="download.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/download.png" /></td>
<td><img src="images/ico/download.png" alt="download.png" /></td>
</tr>
</table>
</label></li>
<li><label title="download2.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/download2.png" /></td>
<td><img src="images/ico/download2.png" alt="download2.png" /></td>
</tr>
</table>
</label></li>
<li><label title="download3.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/download3.png" /></td>
<td><img src="images/ico/download3.png" alt="download3.png" /></td>
</tr>
</table>
</label></li>
<li><label title="email.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/email.png" /></td>
<td><img src="images/ico/email.png" alt="email.png" /></td>
</tr>
</table>
</label></li>
<li><label title="email2.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/email2.png" /></td>
<td><img src="images/ico/email2.png" alt="email2.png" /></td>
</tr>
</table>
</label></li>
<li><label title="extension.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/extension.png" /></td>
<td><img src="images/ico/extension.png" alt="extension.png" /></td>
</tr>
</table>
</label></li>
<li><label title="find.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/find.png" /></td>
<td><img src="images/ico/find.png" alt="find.png" /></td>
</tr>
</table>
</label></li>
<li><label title="folder.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/folder.png" /></td>
<td><img src="images/ico/folder.png" alt="folder.png" /></td>
</tr>
</table>
</label></li>
<li><label title="forum.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/forum.png" /></td>
<td><img src="images/ico/forum.png" alt="forum.png" /></td>
</tr>
</table>
</label></li>
<li><label title="ftpupdate.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/ftpupdate.png" /></td>
<td><img src="images/ico/ftpupdate.png" alt="ftpupdate.png" /></td>
</tr>
</table>
</label></li>
<li><label title="help.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/help.png" /></td>
<td><img src="images/ico/help.png" alt="help.png" /></td>
</tr>
</table>
</label></li>
<li><label title="home.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/home.png" /></td>
<td><img src="images/ico/home.png" alt="home.png" /></td>
</tr>
</table>
</label></li>
<li><label title="link.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/link.png" /></td>
<td><img src="images/ico/link.png" alt="link.png" /></td>
</tr>
</table>
</label></li>
<li><label title="love.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/love.png" /></td>
<td><img src="images/ico/love.png" alt="love.png" /></td>
</tr>
</table>
</label></li>
<li><label title="menu.png">
<table>
<tr>
<td><input name="ico" type="radio" value="images/ico/menu.png" checked="CHECKED" /></td>
<td><img src="images/ico/menu.png" alt="menu.png" /></td>
</tr>
</table>
</label></li>
<li><label title="news.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/news.png" /></td>
<td><img src="images/ico/news.png" alt="news.png" /></td>
</tr>
</table>
</label></li>
<li><label title="news2.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/news2.png" /></td>
<td><img src="images/ico/news2.png" alt="news2.png" /></td>
</tr>
</table>
</label></li>
<li><label title="paper.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/paper.png" /></td>
<td><img src="images/ico/paper.png" alt="paper.png" /></td>
</tr>
</table>
</label></li>
<li><label title="photo.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/photo.png" /></td>
<td><img src="images/ico/photo.png" alt="photo.png" /></td>
</tr>
</table>
</label></li>
<li><label title="picplayer.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/picplayer.png" /></td>
<td><img src="images/ico/picplayer.png" alt="picplayer.png" /></td>
</tr>
</table>
</label></li>
<li><label title="product.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/product.png" /></td>
<td><img src="images/ico/product.png" alt="product.png" /></td>
</tr>
</table>
</label></li>
<li><label title="qq.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/qq.png" /></td>
<td><img src="images/ico/qq.png" alt="qq.png" /></td>
</tr>
</table>
</label></li>
<li><label title="seo.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/seo.png" /></td>
<td><img src="images/ico/seo.png" alt="seo.png" /></td>
</tr>
</table>
</label></li>
<li><label title="setting.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/setting.png" /></td>
<td><img src="images/ico/setting.png" alt="setting.png" /></td>
</tr>
</table>
</label></li>
<li><label title="setting2.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/setting2.png" /></td>
<td><img src="images/ico/setting2.png" alt="setting2.png" /></td>
</tr>
</table>
</label></li>
<li><label title="share.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/share.png" /></td>
<td><img src="images/ico/share.png" alt="share.png" /></td>
</tr>
</table>
</label></li>
<li><label title="taobao.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/taobao.png" /></td>
<td><img src="images/ico/taobao.png" alt="taobao.png" /></td>
</tr>
</table>
</label></li>
<li><label title="tel.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/tel.png" /></td>
<td><img src="images/ico/tel.png" alt="tel.png" /></td>
</tr>
</table>
</label></li>
<li><label title="time.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/time.png" /></td>
<td><img src="images/ico/time.png" alt="time.png" /></td>
</tr>
</table>
</label></li>
<li><label title="update.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/update.png" /></td>
<td><img src="images/ico/update.png" alt="update.png" /></td>
</tr>
</table>
</label></li>
<li><label title="user.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/user.png" /></td>
<td><img src="images/ico/user.png" alt="user.png" /></td>
</tr>
</table>
</label></li>
<li><label title="zip.png">
<table>
<tr>
<td><input type="radio" name="ico" value="images/ico/zip.png" /></td>
<td><img src="images/ico/zip.png" alt="zip.png" /></td>
</tr>
</table>
</label></li>
<div class="clear"></div>
</ul>
</div>
</td></tr>
<tr>
<td height=25 colspan="2"> <label>
<input type="submit" name="Submit" value=" 保存添加 " class="btn btn-success">
</label></td>
</tr>
</table>
</form>
<?php }?>
<?php
//编辑内容下面的为表单
if ($action=="editb" and $pid>0){
$contentdata=$_POST["contentdata"];
$lnk -> query("update global_data set contentdata='$contentdata' where id=$pid");
alert("保存成功！");
go("?act=showdata&pid=$pid");
}
///添加根目录
if ($action=="showdata" and $pid>0){
$sql="select * from global_data where id=$pid";
$result=$lnk -> query($sql);
while($rs=mysqli_fetch_assoc($result)){
?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">您的位置：全局数据管理 >> <?php echo $rs["name"]?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<form name="myform" method="post" action="?act=editb&pid=<?php echo $pid?>">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td height=18 class=td><strong><?php echo $rs["name"]?></strong> </td>
</tr>
<tr>
<td>
<?php
switch ($rs["type"])
{
case 1:
$typea="<input name='contentdata' type='text' id='contentdata' value='".$rs["contentdata"]."' size='30'>
<input type='button' name='Submit11' value='上传图片' onClick=\"window.open('./upload.php?formname=myform&editname=contentdata&uppath=contentdata&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')\">";
if($rs["contentdata"]=='请编辑' or $rs["contentdata"]==""){}else{$typea.="<img src='temp/".$rs["contentdata"]."' height=100>";}
break;
case 2:
$typea="<textarea name='contentdata' cols='40' rows='3'>".$rs["contentdata"]."</textarea>";
break;
case 3:
$typea="<textarea name='contentdata'  id='contentdata'  style='width:100%;height:300px;'>".$rs["contentdata"]."</textarea><script> var data_contentdata = UE.getEditor('contentdata');</script>";
break;
default: //文本框  0
$typea="<input name='contentdata' type='text'  value='".$rs["contentdata"]."' size='40'>";
break;
}
echo $typea;
?>
</td>
</tr>
<tr>
<td height=25> <label>
<input type="submit" name="Submit" value=" 保存设置 " class="btn btn-success">
</label></td>
</tr>
</table>
</form>
<?php
}
}?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>