<?php include 'config/admin.php';
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
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script language=javascript>
//删除子目录确认
function   confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="data_use.php?act=del&pid="+id;
}
}
</script>
</head><body>
<?php
@$act=$_GET["act"];
@$pid=$_GET["pid"];
@$menu_id=$_GET["menuid"];
function showh5($key){
global $lnk;
$result=$lnk -> query("select * from pagepart where indexcode='".$key."'");
if ($result)
while ($kind=mysqli_fetch_assoc($result)){
return $kind["content"];
}
}
?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="data_use.php">您的位置：数据调用</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="data_use.php?act=add"><span class="glyphicon glyphicon-plus"></span>添加模块数据</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<?php
if($act==""){ ?>
<div class="menu_admin">
<?php
$mainbt=$lnk->query("select * from mainbt order by px");
while($row=mysqli_fetch_assoc($mainbt)){
echo "<li class='text-center floatleft back-f8 border-solid-1px well'><img src='".$row["ico"]."'><br>".$row["leftname_main"]."<br>";
$edit_data=$lnk->query("select * from mainbt1 where left_id=".$row["id"]." order by px");
while($rs=mysqli_fetch_assoc($edit_data)){
echo "<a href='?list_id=".$rs["id"]."'><span class='btn btn-info'>".$rs["leftname"]."</span></a>&nbsp;";
}
echo "</li>";
}
?>
</div>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk2">
<form name="myform">
<tr>
<td width="6%">ID</td>
<td width="12%"><strong>所属页面</strong></td>
<td width="23%"><strong>数据调用串</strong></td>
<td width="26%"><strong>内容</strong></td>
<td width="9%"><strong>排序</strong></td>
<td width="12%"><strong>类型</strong></td>
<td width="12%"><strong>操作</strong></td>
</tr>
<?php
@$list_id=$_GET["list_id"];
$where= $list_id? " where list_id=$list_id ":"";
$result=$lnk -> query("select * from pagepart $where order by list_id,px,id");
$i=1;
while ($kind=mysqli_fetch_assoc($result)){
?>
<tr>
<td ><?php echo $kind["id"]?></td>
<td class="text-center"><?php echo getIdMainTitle(getIdMianId($kind["list_id"]))."<br><span class='text-info'>". getIdTitle($kind["list_id"])."</span>"?></td>
<td><span class="text-info"><?php echo $kind["indexcode"]?></span></td>
<td><?php echo $kind["content"]?></td>
<td> <input type="text" name="px<?php echo $i?>"  id="px<?php echo $i?>" onBlur="ajax_edit_txt(this.value,<?php echo $kind["id"];?>);this.style.border='0px';"  value="<?php echo $kind["px"]?>" onFocus="this.style.border='1px solid #ff3300'" style="border:0PX;"></td>
<td><?php
$imgpath = strpos($kind["content"],"/") ? "../".$kind["content"]:"temp/".$kind["content"];
echo $kind["type"]==1|$kind["type"]==2 ? "<img src='".$imgpath."' width=100 height=100>":"文字"?></td>
<td><a href="data_use.php?act=add"><span class="glyphicon glyphicon-plus"></span></a>&nbsp;&nbsp;&nbsp;<a href='data_use.php?act=edita&pid=<?php echo $kind["id"];?>'><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(<?php echo $kind["id"];?>)'><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>
<?php
$i++;
}?>
</form>
</table>
<?php
}
if($act=="add"){
?>
<table class="width98 table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk3">
<form name="myform" method="post" action="data_use.php?act=addnew1">
<tr class=backs>
<td height=18 colspan="2" class=td>添加数据块</td>
</tr>
<tr>
<td width="16%" height="33" >数据名称：</td>
<td width="84%" ><input name="name" type="text" id="name" value="请输入内容" size="35">
<em>中文或英文2-20字符</em></td>
</tr>
<tr>
<td height="33" >标识串号：</td>
<td ><input name="indexcode" type="text" id="indexcode" value="" size="35">
<em>英文开头2-20字符</em></td>
</tr>
<tr>
<td height="33" >所属页面：</td>
<td >
<?php
$mainbt=$lnk->query("select * from mainbt order by px");
while($row=mysqli_fetch_assoc($mainbt)){
echo "<li class='text-center floatleft   well'><img src='".$row["ico"]."'><br>".$row["leftname_main"]."<br>";
$edit_data=$lnk->query("select * from mainbt1 where left_id=".$row["id"]." order by px");
while($rs=mysqli_fetch_assoc($edit_data)){
echo "<input name='list_id' type='radio' value='".$rs["id"]."' id='list_id'> <span class='btn btn-info btn-xs'>".$rs["leftname"]."</span>";
}
echo "</li>";
}
?>
</td>
</tr>
<tr>
<td height="33">排序：</td>
<td height="33"><input name="px" type="text" id="px" value="0" size="10">
<em>越小排在越前</em></td>
</tr>
<tr>
<td height="33">类型：</td>
<td height="33"><input name="typea" type="radio" value="0" checked="CHECKED"> 文本  <input name="typea" type="radio" value="1"> 图片
</td>
</tr>
<tr>
<td height="33">图片上传：</td>
<td height="33"><input name="pic" type="text" id="photo" value=""  size="30">
<input type="button" name="Submit11" value="上传缩略图" onClick="window.open('./upload.php?formname=myform&editname=photo&uppath=pic&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"><em>仅限图片功能</em>
</td>
</tr>
<tr>
<td height="33">文本：</td>
<td height="33"><label for="textarea"><textarea name="content" cols="100" rows="5" id="content" ></textarea></label></td>
</tr>
<tr>
<td height="33" colspan="2"><input type="submit" name="Submit22" value="确认添加"></td>
</tr>
</form>
</table>
<?php }
if ($act=="addnew1")
{
@$name=$_POST['name'];
@$px=$_POST['px'];
@$pic=$_POST['pic'];
@$typea=$_POST['typea'];
$content= $typea=="1" ? $pic:@$_POST['content'];
@$indexcode=$_POST['indexcode'];
@$list_id=$_POST['list_id'];
$myquery="insert into pagepart (list_id,name,indexcode,content,px,type) values ('$list_id','$name','$indexcode','$content','$px','$typea')";
$result= $lnk -> query($myquery) or die("失败了" . mysql_error());
//查记录
echo $myquery;
echo "<script language='javascript'>";
echo "alert('操作成功，页面已添加');";
echo "location.href='data_use.php';";
echo "</script>";
}
?>
<?php
if($act=="del" and $pid>0){
$lnk -> query("delete  from pagepart  where id=$pid");
alert("删除成功！");
go("data_use.php?menuid=$menu_id");
}
if($act=="epx" and @$_REQUEST["pid"]>0 and @$_REQUEST["px"]>0){
alert("yes");
$lnk -> query("update pagepart set px='".$_REQUEST["px"]."'  where id=".$_REQUEST["pid"]);
echo ("update pagepart set px='".$_REQUEST["px"]."'  where id=".$_REQUEST["pid"]);
}
?>
<script>
function ajax_edit_txt(content,id){
$.post("data_use.php?act=epx",{pid:id,px:content});
}
</script>
</body>
</html>
