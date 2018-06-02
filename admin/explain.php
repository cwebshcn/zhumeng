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
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<?php
//=------------动作说明-------------------
@$action=$_GET['act']; #获取动作
@$menuid=$_GET['menuid']+0; #得到当前ID
@$pid=$_GET['pid']+0; #分类ID
@$kind_id=$_GET['kind_id']+0; #项目ID
//排序
if ($action=="pxupdate"){
$px=$_GET["value"]+0;
$lnk->query("update tableattr set px='$px' where id=$pid");
}
?>
<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=delsort&sortid="+id;
}
}
function  confirmLink3(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=kinds_del&pid=<?php echo $pid;?>&kind_id="+id;
}
}
</script>

<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：列表及详情接口 >><?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>

</div><!-- /.navbar-collapse -->
</nav>
<div class="menu_admin">
<?php
$mainbt=$lnk->query("select * from mainbt order by px");
while($row=mysqli_fetch_assoc($mainbt)){
echo "<li class='text-center floatleft back-f8 border-solid-1px well'><img src='".$row["ico"]."'><br><br>";
$edit_data=$lnk->query("select * from mainbt1 where left_id=".$row["id"]." order by px limit 1");
while($rs=mysqli_fetch_assoc($edit_data)){
echo "<a href='?menuid=".$rs["id"]."'><span class='btn btn-success'>".$row["leftname_main"]."</span></a>&nbsp;";
}
echo "</li>";
}
?>
</div>
<div style="clear:both"></div>

<div class="text-center">
<?php
$left_id= getIdMianId($menuid)+0;
$result=$lnk -> query("select * from mainbt1 where left_id=$left_id");
if ($result)
while ($kind=mysqli_fetch_assoc($result)){
echo "<a href='?menuid=".$kind["id"]."'><span class='btn btn-info'>".$kind['leftname']."</span></a> &nbsp;&nbsp;&nbsp;";
}
?>
</div>
</div>

<?php
//rem 字段删除
if ($action=="delsort" and @$_GET['sortid']!="" and $menuid!=""){
$num=$_GET['sortid'];
//删除字段
//字段名称导出
$result=$lnk -> query("select * from tableattr where id=".$_GET['sortid']);
while ($kind=mysqli_fetch_assoc($result)){$attrname=$kind['name'];}
//查字段名称存在
if($attrname!=""){
$attr = $lnk->query('DESCRIBE attr_list_'.$menuid);
$tables=array();
while($arr = $attr->fetch_assoc()){
$tables[]=$arr["Field"];
}
//存在删除字段
if(in_array($attrname,$tables))
{
$lnk-> query ("ALTER TABLE  `attr_list_".$menuid."` DROP COLUMN  $attrname");
}
}
//删除字段表
$delsoid="delete from tableattr where id = ".$_GET['sortid'];
//echo $delsoid;
$resultdel=$lnk -> query($delsoid) or die ( mysql_error());
alert('操作成功，字段成功删除');
goback();
}
//添加新字段
if ($action=="addmenu" and $menuid!=""){
$list_id=$menuid;
$type=$_POST['typea']+0;
$name=$_POST['name'];
$content=$_POST['content'];
if ($name==""){
alert('不能为空!');
goback();
}
else
{
$insert_data="insert into tableattr (list_id,type,name,content) values ('$list_id','$type','$name','$content')";
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
$area=@$_POST['area_id'];
$sortid=$_POST['sortid'];
$list_id=$_POST['listid'];
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
if($menuid and $action==""){
?>

<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?></strong> 数据结构</td>
</tr>
</table>

<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24">接入方法（get）</td>
</tr>
<tr>
	<td>
		<?php $s= getMenuInfo($menuid);?>

		<br><h4>API 调用接口</h4>
		http://www.sunshine-net.com/demo/zhumeng/api/<br>

		<br><h4>API 文件名</h4>
		get_list.php<br>

		<br><h4>API 参数说明</h4>
		s 动作 ［<?php echo $s["webpath"];?>］<br>
		t 分类 ［<?php echo get_sort_list($menuid);?>］<br>
		pn 当前记录 ［0］<br>	
		px 当前显示条数 ［10］<br>
		ob 排序字段 ［1］ 1第一个字段，2是第二个字段<br> 
		oa 排序方式 ［0］ 0升序 1降序<br>
		id 数据id   [1]  详情页的id号 有显示当条数据，没有显示例表<br>
		str 模糊搜索标题   [标题] <br>

		<br><h4>API 示例</h4>
		<a href="http://www.sunshine-net.com/demo/zhumeng/api/get_list.php?s=<?php echo $s["webpath"];?>" target="_blank">http://www.sunshine-net.com/demo/zhumeng/api/get_list.php?s=<?php echo $s["webpath"];?></a><br>
		

		<br><h4>API 插入/更新 示例</h4>
		<a href="http://www.sunshine-net.com/demo/zhumeng/api/push_data.php?s=<?php echo $s["webpath"];?>" target="_blank">http://www.sunshine-net.com/demo/zhumeng/api/push_data.php?s=<?php echo $s["webpath"];?></a><br>
		<b>参数说明</b><br>
		s 动作 ［<?php echo $s["webpath"];?>］<br>
		id 更新的id编号  不传则插入新的数据 <br>
		传参具体参数如下数据：（与获取数据相同）<br>

		

		<br><h4>API 获取和传值返回字段说明</h4>
		{"code":0,"data":array}<br>
		code 返回状态[0]  0 正常  大于0  data:错误原因<br>

		<br><h4>array 数据如下：</h4>
 	</td>
</tr>
</table>


<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td width="5%"><strong>序号</strong></td>
<td width="15%"><strong>字段</strong></td>
<td width="80%"><strong>说明</strong></td>

</tr>
<tr>
<td>1</td>
<td>ID</td>
<td class="text-info"><em>自动编号</em></td>
</tr>
<tr>
<td>2</td>
<td>list_id</td>
<td class="text-info"><em>栏目</em></td>

</tr>
<tr>
<td>3</td>
<td>sort_id</td>
<td class="text-info"><em>分类</em></td>

</tr>
<tr>
<td>4</td>
<td>px</td>
<td class="text-info"><em>排序</em></td>

</tr>
<tr>
<td>5</td>
<td>name</td>
<td class="text-info"><em>标题</em></td>

</tr>
<?php
function typename($id){
switch ($id)
{
case 0:
$tyea="文本";
break;
case 1:
$tyea="图片/文档";
break;
case 2:
$tyea="介绍";
break;
case 3:
$tyea="编辑器";
break;
case 4:
$tyea="单选";
break;
case 5:
$tyea="多选";
break;
case 6:
$tyea="下拉列表";
break;
case 7:
$tyea="标签（默认五个）";
break;
case 8:
$tyea="日期选择器";
break;
default:
$tyea="其它";
break;
}
return $tyea;
}

$sql="select * from tableattr where list_id=$menuid order by px,id";
$result=$lnk -> query($sql);
$i=7;
while($row=mysqli_fetch_assoc($result)){
$edit_kind =($row["type"]==4 or $row["type"]==5 or $row["type"]==6)?"<a href=\"?act=kinds_list&menuid=$menuid&pid=".$row["id"]."\"><span class=\"btn btn-info btn-xs\">多选/列表/单选管理</span></a>":"";
echo "<tr><td>$i</td><td>".$row["name"]."</td><td class='text-info'><em>".$row["content"]." &nbsp; &nbsp; <span class='text-success'>[".typename($row["type"])."]".$edit_kind."</span></em></td></tr>";
$i++;
$attr = $lnk->query('DESCRIBE attr_list_'.$menuid);
$tables=array();
while($arr = $attr->fetch_assoc()){
$tables[]=$arr["Field"];
}
if(in_array($row["name"],$tables)){}else
{
switch ($row["type"])
{
case 0:
case 1:
$tyea="char(255)";
break;
case 2:
case 3:
case 7:
$tyea="longtext";
break;
default:
$tyea="char(255)";
break;
}
$lnk->query("alter table `attr_list_".$menuid."` Add column ".$row["name"]." $tyea null; ");
}
}

?>

</table>
<?php }
?>

<?php
function get_sort_list($list_id){
	global $lnk;
	$sortlist="无";
	$sort_result = $lnk->query("SELECT * FROM sort where list_id=$list_id");
	$i=1;
	while($row=mysqli_fetch_assoc($sort_result)){
		if($sortlist=="无")
			$sortlist="<br>";
		$sortlist .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$i.".sort_id:".$row["id"]." sortname:".$row["sort_name"]."<br>";
		$i++;
	}
	return $sortlist;

}



function kindidtoname($id){
global $lnk;
$attr = $lnk->query("SELECT * FROM `tableattr` where id=$id");
$tables=array();
while($arr = $attr->fetch_assoc()){
return $arr["content"];
}
}
//分组列表
if ($action=="kinds_list"){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
<td height=18 colspan="2" class="td text-info"><strong><?php echo getIdTitle($menuid)?> > <?php kindidtoname($pid)?></strong> 多选/单选/下拉列表  管理列表</td>
</tr>
<tr>
<td width="18%" height=25><label>项目名称：</label></td>
<td width="82%">操作</td>
</tr>
<?php
$result = $lnk->query("SELECT * FROM `kinds` where kind_id=$pid");
$tables=array();
while($rs=mysqli_fetch_assoc($result)){
?>
<tr>
<td width="18%" height=25><label><?php echo $rs["name"];?></label></td>
<td width="82%"><a href='javascript:void(0)' onClick='confirmLink3(<?php echo $rs["id"];?>)'><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
<?php
}?>
</tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form name="form1" method="post" action="?act=kinds_add&menuid=<?php echo $menuid?>&pid=<?php echo $pid?>">
<tr>
<td height=18 colspan="2" class="td text-info"><strong><?php echo getIdTitle($menuid)?> > <?php kindidtoname($pid)?></strong> 多选/单选/下拉列表  添加</td>
</tr>
<tr>
<td width="18%" height=25><label>项目名称：</label></td>
<td width="82%"><input name="name" type="text" id="name" size="40" value="" > </td>
</tr>
<tr>
<td height=25 colspan="2"><input name="submitdata" type="submit" value="添加新项目" class="btn btn-info btn-xs"></td>
</tr>
</tr>
</form>
</table>
<?php
}?>
<?php
//添加分组
if ($action=="kinds_add"){
$name=$_POST["name"];
if($pid and $name){
$lnk->query("insert into kinds (name,kind_id)values('$name','$pid')");
alert("添加成功！");
go("?act=kinds_list&menuid=$menuid&pid=$pid");
}
}
//删除分组
if ($action=="kinds_del"){
if($pid and $kind_id and $menuid){
$lnk->query("delete from kinds where id=$kind_id");
alert("删除成功！");
go("?act=kinds_list&menuid=$menuid&pid=$pid");
}
}
if ($action=="rootedit2"){
$name=$_POST["name"];
$type=$_POST["typea"];
$content=$_POST["content"];
$tp= ($type==2 or $type==3)?" longtext null":" char(255) null";
$result=$lnk -> query("select * from tableattr where id=$pid");
while($row=mysqli_fetch_assoc($result)){$rs=$row;}
if($pid and $name and  $content){
$lnk->query("alter table attr_list_".$rs["list_id"]." change ".$rs["name"]." $name $tp");
$lnk->query("update tableattr set name='$name',type='$type',content='$content' where id=$pid");
alert("更新成功！");
go("?menuid=$menuid");
}
}
?>
</body>
</html>