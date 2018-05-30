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
@$menuid=$_GET['menuid']+0; #得到当前ID
?>
<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="kindsadmin.php?menuid=<?php echo $menuid?>&act=delsort&sortid="+id;
}
}
</script>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：分类管理 >><?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="?menuid=<?php echo $menuid?>&act=addroot"><span class='glyphicon glyphicon-plus'></span> 添加根目录</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<div class="text-center">
<?php
$result=$lnk -> query("select * from mainbt1 where typea=2");
if ($result)
while ($kind=mysqli_fetch_assoc($result)){
echo "<a href='?menuid=".$kind["id"]."'><span class='btn btn-info'>".$kind['leftname']."</span></a> &nbsp;&nbsp;&nbsp;";
}
?>
</div>
</div>
<?php
//rem 产品种类删除
if ($action=="delsort" and @$_GET['sortid']!=""){
$num=$_GET['sortid'];
$delsoid="delete from sort where id in (".sqlsortid($num,"start").")";
//echo $delsoid;
$resultdel=$lnk -> query($delsoid) or die ( mysql_error());
$delsoid2="delete from products where sort_id in (".sqlsortid($num,"start").")";
//echo $delsoid2;
$resultdel2=$lnk -> query($delsoid) or die ( mysql_error());
alert('操作成功，种类成功删除,并删除所有此类产品');
goback();
}
if ($action=="addmenu"){
$px=$_POST['px']+0;
$sortname=$_POST['sortname'];
$pic=@$_POST['photo'];
$list_id=$_POST['listid']+0;
$main_id=getIdMianId($list_id);
if ($sortname==""){
alert('不能为空!');
goback();
}
else
{
$insert_data="insert into sort (px,sort_name,type_id,list_id,main_id,pic) values ('$px','$sortname','0','$list_id','$main_id','$pic')";
//echo $insert_data;
$insert_result=$lnk -> query($insert_data) or die(mysql_error());
alert('插入成功!');
go("?menuid=$menuid");
}
}
if ($action=="addminmenu"){
$px=$_POST['px']+0;
$sortname=$_POST['sortname'];
$pic=@$_POST['photo'];
$area=@$_POST['area_id']+0;
$sortid=$_POST['sortid']+0;
$list_id=$_POST['listid']+0;
$main_id=getIdMianId($list_id);
if ($sortname==""){
alert('不能为空!');
goback();
}
else
{
$insert_data="insert into sort (px,sort_name,type_id,list_id,main_id,pic) values ('$px','$sortname','$sortid','$list_id','$main_id','$pic')";
//echo $insert_data;
$insert_result=$lnk -> query($insert_data) or die(mysql_error());
alert('插入成功!');
go("?menuid=$menuid");
}
}
?>
<?php
//rem 种类修改
if ($action=="editsort"){
$px=$_POST['px'];
$sortname=$_POST['sortname'];
$pic=$_POST['pic'];
$sortid=$_POST['sortid'];
//$sex=$_POST['sex']+0;
if ($sortname==""){
alert('名称不能为空!');
goback();
}
else
{
$update_edit="update sort set px='$px', pic='$pic',sort_name='$sortname' where id=$sortid";
//echo $update_edit;
$update_result=$lnk -> query($update_edit);
alert('修改成功!');
goback();
}
}?>
<?php
if($menuid and $action==""){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?></strong> 分类管理</td>
</tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td width="5%"><strong>ID</strong></td>
<td width="50%"><strong>名称</strong></td>
<td width="10%"><strong>排序</strong></td>
<td width="35%"><strong>操作</strong></td>
</tr>
<?php
$sql="select * from sort where type_id=0 and list_id=".$menuid." order by px";
$rsmain1=$lnk -> query($sql);
while($rsmain=mysqli_fetch_assoc($rsmain1)){
echo  "<tr><td>".$rsmain['id']."</td><td class='font18 text-info'>".$rsmain['sort_name']."</td><td>".$rsmain['px']."</td><td><a href='?act=addsubmenu&menuid=$menuid&sortcid=".$rsmain["id"]."'><span class='glyphicon glyphicon-plus'></span></a>&nbsp;&nbsp;&nbsp;<a href='?act=editmenu&menuid=$menuid&sortcid=".$rsmain["id"]."'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(".$rsmain["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
echo menu_num ($rsmain['id'],0);
$i="";
if (MenuDown($rsmain['id'])){
//二级目录
$sql="select * from sort where type_id=".$rsmain['id']."  order by px";
$rsmaina1=$lnk -> query($sql);
while($rsmaina=mysqli_fetch_assoc($rsmaina1)){
echo  "<tr><td>".$rsmaina['id']."</td><td>".menu_num ($rsmaina['id'],0).$rsmaina['sort_name']."</td><td>".$rsmaina['px']."</td><td><a href='?act=addsubmenu&menuid=$menuid&sortcid=".$rsmaina["id"]."'><span class='glyphicon glyphicon-plus'></span></a>&nbsp;&nbsp;&nbsp;<a href='?act=editmenu&menuid=$menuid&sortcid=".$rsmaina["id"]."'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(".$rsmaina["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
$i="";
if (MenuDown($rsmaina['id'])){
//三级目录
$sql="select * from sort where type_id=".$rsmaina['id']." order by px";
$rsmainb1=$lnk -> query($sql);
while($rsmainb=mysqli_fetch_assoc($rsmainb1)){
echo  "<tr><td>".$rsmainb['id']."</td><td>".menu_num ($rsmainb['id'],0).$rsmainb['sort_name']."</td><td>".$rsmainb['px']."</td><td><a href='?act=addsubmenu&menuid=$menuid&sortcid=".$rsmainb["id"]."'><span class='glyphicon glyphicon-plus'></span></a>&nbsp;&nbsp;&nbsp;<a href='?act=editmenu&menuid=$menuid&sortcid=".$rsmainb["id"]."'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(".$rsmainb["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
$i="";
if (MenuDown($rsmainb['id'])){
//四级分类
$sql="select * from sort where type_id=".$rsmainb['id']."  order by px";
$rsmainc1=$lnk -> query($sql);
while($rsmainc=mysqli_fetch_assoc($rsmainc1)){
echo  "<tr><td>".$rsmainc['id']."</td><td>".menu_num ($rsmainc['id'],0).$rsmainc['sort_name']."</td><td>".$rsmainc['px']."</td><td><a href='?act=addsubmenu&menuid=$menuid&sortcid=".$rsmainc["id"]."'><span class='glyphicon glyphicon-plus'></span></a>&nbsp;&nbsp;&nbsp;<a href='?act=editmenu&menuid=$menuid&sortcid=".$rsmainc["id"]."'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(".$rsmainc["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
$i="";
//if (MenuDown($rsmainc['id'])){}
}
//四级分类结束
}}
//三级目录结束
}}
//二级目录结束
}}
?>
</table>
<?php }?>
<?php
///添加根目录
if ($action=="addroot"){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td class=td height=18><strong><?php echo getIdTitle($menuid)?></strong> 根目录添加</td>
</tr>
<tr>
<td height=25> <form name="form1" method="post" action="?act=addmenu&menuid=<?php echo $menuid?>">
<select name='listid' size='1' id='listid' style="border:1px solid  #8FB9CB;height:21px;">
<option value="0">未选择</option>
<?php
$sql="select * from mainbt1 where typea=2 order by px";
$rsmain1=$lnk -> query($sql);
while($rsmain=mysqli_fetch_assoc($rsmain1)){
echo  "<option value=".$rsmain['id']." style='font-size:12px;font-weight:bold'";
if ($menuid==$rsmain['id']){echo (" selected");}
echo ">".$rsmain['leftname']."</option>";
}?>
</select>
<input name="sortname" type="text" id="sortname" size="20" style="border:1px solid  #8FB9CB;height:21px;">
<label></label>
<input name="px" type="text" id="px" value="0" size="5" style="border:1px solid  #8FB9CB;height:21px;">
<label>
<input type="submit" name="Submit" value="添加根目录" style="border:1px solid  #8FB9CB;height:21px;">
</label><i class="text-success">数字越小排名越前</i></form></td>
</tr>
</table>
<?php }?>
<?php
///添加根目录
if ($action=="addsubmenu" and @$_GET["sortcid"]!=""){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td class=td height=18>添加子目录: <strong><?php echo getIdTitle(sortid_listid($_GET["sortcid"]))?> >> <?php echo (sortid_sortname($_GET["sortcid"]))?> </strong> </td>
</tr>
<tr>
<td height=25> <form name="form2" method="post" action="?act=addminmenu&menuid=<?php echo $menuid?>"><?php
$sql="select * from sort where id=".$_GET["sortcid"]."";
$rsmain1=$lnk -> query($sql);
while($rsmain=mysqli_fetch_assoc($rsmain1)){
echo $rsmain["sort_name"];
echo "<input name='sortid'  id='sortid' type='hidden' value='".$_GET["sortcid"]."' />";
echo "<input name='listid'  id='sortid' type='hidden' value='".sortid_listid($_GET["sortcid"])."' />";
}
?>
<input name="sortname" type="text" id="sortname" size="20" style="border:1px solid  #8FB9CB;height:21px;">
<label></label>
<input name="px" type="text" id="px" value="0" size="5" style="border:1px solid  #8FB9CB;height:21px;">
<label>
<input type="submit" name="Submit" value="添加子目录" style="border:1px solid  #8FB9CB;height:21px;">
</label><i class="text-success">数字越小排名越前</i></form></td>
</tr>
</table>
<?php }?>
<?php
///添加根目录
if ($action=="editmenu" and @$_GET["sortcid"]!=""){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td class=td height=18>目录编辑: <strong><?php echo getIdTitle(sortid_listid($_GET["sortcid"]))?> >> <?php echo (sortid_sortname($_GET["sortcid"]))?> </strong> </td>
</tr>
<tr>
<td height=25> <form name="myform" method="post" action="?act=editsort"><select name='sortid' size='1' id='sortid' style="border:1px solid  #8FB9CB;height:21px;" onChange="javascript:document.forms('form334').sortname.value=this.options[this.options.selectedIndex].text;document.forms('form334').px.value=this.options[this.options.selectedIndex].px;document.forms('form334').photo.value=this.options[this.options.selectedIndex].pic;if(this.options[this.options.selectedIndex].sex==2){document.forms('form334').sex[1].checked=true;}else{document.forms('form334').sex[0].checked=true;}"><?php
$sql="select * from sort where type_id=0 and list_id=".$menuid." order by px";
$rsmain1=$lnk -> query($sql);
while($rsmain=mysqli_fetch_assoc($rsmain1)){
echo  "<option value=".$rsmain['id'];
if ($_GET['sortcid']==$rsmain['id']){echo (" selected");}
echo " px='".$rsmain['px']."'  pic='".$rsmain['pic']."'  style='font-size:12px;font-weight:bold'>";
echo menu_num ($rsmain['id'],0);
$i="";
echo $rsmain['sort_name']."</option>";
if (MenuDown($rsmain['id'])){
//二级目录
$sql="select * from sort where type_id=".$rsmain['id']." order by px";
$rsmaina1=$lnk -> query($sql);
while($rsmaina=mysqli_fetch_assoc($rsmaina1)){
echo  "<option value=".$rsmaina['id'];
if ($_GET['sortcid']==$rsmaina['id']){echo (" selected");}
echo " px='".$rsmaina['px']."'     pic='".$rsmaina['pic']."'  style='font-size:12px;font-weight:bold'>";
echo menu_num ($rsmaina['id'],0);
$i="";
echo $rsmaina['sort_name']."</option>";
if (MenuDown($rsmaina['id'])){
//三级目录
$sql="select * from sort where type_id=".$rsmaina['id']." order by px";
$rsmainb1=$lnk -> query($sql);
while($rsmainb=mysqli_fetch_assoc($rsmainb1)){
echo  "<option value=".$rsmainb['id'];
if ($_GET['sortcid']==$rsmainb['id']){echo (" selected");}
echo " px='".$rsmainb['px']."'   pic='".$rsmainb['pic']."'  style='font-size:12px;font-weight:bold'>";
echo menu_num ($rsmainb['id'],0);
$i="";
echo $rsmainb['sort_name']."</option>";
if (MenuDown($rsmainb['id'])){
//四级分类
$sql="select * from sort where type_id=".$rsmainb['id']." order by px";
$rsmainc1=$lnk -> query($sql);
while($rsmainc=mysqli_fetch_assoc($rsmainc1)){
echo  "<option value=".$rsmainc['id'];
if ($_GET['sortcid']==$rsmainc['id']){echo (" selected");}
echo " px='".$rsmainc['px']."'   pic='".$rsmainc['pic']."' style='font-size:12px;font-weight:bold'>";
echo menu_num ($rsmainc['id'],0);
$i="";
echo $rsmainc['sort_name']."</option>";
if (MenuDown($rsmainc['id'])){
}}
//四级分类结束
}}
//三级目录结束
}}
//二级目录结束
}}
?></select>
<div class="padding-top-25" >名称：<input name="sortname" type="text" id="sortname" value="<?php echo sortid_sortname($_GET["sortcid"]);?>" size="25"></div>
<div class="padding-top-25" >排序：<input name="px" type="text" id="px" value="<?php echo sortid_sortpx($_GET['sortcid']);?>" size="5" ></div>
<div class="padding-top-25" >缩略图：<input name="pic" type="text" id="pic" value="<?php echo sortid_pic($_GET['sortcid']);?>" size="15" ><input type="button" name="Submit11" value="上传图片" onClick="window.open('./upload.php?formname=myform&editname=pic&uppath=pic&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> <img src='temp/<?php echo sortid_pic($_GET['sortcid']);?>' height='100'></div>
<div class="padding-top-25" ><input class=" btn btn-info"type="submit" name="Submit" value="保存设置"></div>
<script>
function shuaimg(){
document.getElementById("minpic2_c").src="../admin/temp/"+document.form334.photo.value;
}
var d1=window.setInterval("shuaimg()",1000);
</script></form>
</td>
</tr>
</table>
<?php }?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>