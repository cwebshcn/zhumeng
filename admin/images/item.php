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
<link href="../css/datepicker.css" rel="stylesheet">
<!--UE-->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js" charset="UTF-8"></script>
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
@$pid=$_GET['pid']+0; #得到当前项目ID
@$menuid=$_GET['menuid']+0; #得到当前项目ID
if($menuid==""){alert("ID丢失，请重新选择！");}
?>
<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=del&pid="+id;
}
}
</script>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：<?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><?php if($menuid){?><a href="?menuid=<?php echo $menuid?>&act=addnew"><span class='glyphicon glyphicon-plus'></span> 新增</a><?php }?></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>

<div class="text-center margin-top-25">
<form action="list_all.php?menuid=<?php echo $menuid;?>&search=yes" method="post"><input name="key" value="<?php echo @$_POST["key"] ? $_POST["key"]:"请输入关键字";?>" class="text-info"><button class="btn btn-group btn-xs btn-info">查询</button></form>
</div>
<?php if($action==""){?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?>

	</strong> 数据管理</td>
	</tr>
	</table>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
	<tr>
	<td width="5%"><strong>ID</strong></td>
	<td><strong>logo标识</strong></td>
	<td width="20%"><strong>名称</strong></td>
	<td width="35%"><strong>宣传内容</strong></td>
	<td width="20%"><strong>操作</strong></td>
	</tr>
	<?php
	//数据列表
	$result = $lnk -> query("select * from spread_item order by item_id desc");
	while ($rs=mysqli_fetch_assoc($result)){
		echo "<tr><td>".$rs["item_id"]."</td>";  //ID
		echo "<td><img src='temp/".$rs["logo"]."' class='img-responsive'></td>";  //ID
		echo "<td>".$rs["title"]."</td>";  //标题
		echo "<td>".strip_tags($rs["content"])."</td>";  //内容
		echo "<td>
		<a href='?act=addnew&menuid=$menuid'><span class='glyphicon glyphicon-plus'></span> 查看人员</a><br>
		<a href='?act=edita&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-pencil'></span> 编辑项目</a><br>
		<a href='javascript:void(0)' onClick='confirmLink(".$rs["item_id"].")'><span class='glyphicon glyphicon-remove'></span> 删除项目</a> 
		</td>"; 
		echo "</tr>";
	
	}
	?>
	</table>
<?php } ?>
<?php if($action=="addnew"){?>
	<form name="myform" method="post" action="?act=addnewdata&menuid=<?php echo $menuid?>">
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
			<tr>
				<td height=18 colspan="2" class=td><strong><?php echo getIdTitle($menuid)?></strong> 数据添加</td>
			</tr>
			<tr>
				<td width="18%" height=25>logo标识*</td>
				<td width="82%"><input name='logo' type='text' id='logo' value='' size='30'>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=logo&uppath=logo&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
				</td>
			</tr>
			<tr>
			<td width="18%" height=25>项目标题*</td>
			<td width="82%"><input name="title" type="text" id="title" size="40"></td>
			</tr>
			<tr>
			<td width="18%" height=25>宣传内容*</td>
			<td width="82%"><textarea name='content'  id='content'  style='width:100%;height:300px;'></textarea><script> var data_content = UE.getEditor('content');</script></td>
			</tr>
			<tr>
				<td width="18%" height=25>公众号二维码*</td>
				<td width="82%"><input name='wx_img' type='text' id='wx_img' value='' size='30'>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=wx_img&uppath=wx_img&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
				</td>
			</tr>
			<tr>
			<td width="18%" height=25>需要转发数量*</td>
			<td width="82%"><input name="target_num" type="text" id="target_num" size="40"></td>
			</tr>
			<tr>
			<td height=25 colspan="2"> <label>
			<input type="submit" name="Submit" value=" 保存添加 " class="btn btn-success">
			</label></td>
			</tr>
		</table>
	</form>
<?php }?>
<?php
//数据编辑
if($action=="edita" and $pid>0){
$sql="select * from attr_list_$menuid where id=$pid";
$row=$lnk -> query($sql);
while($rs_edit=mysqli_fetch_assoc($row))
{
?>
<form name="myform" method="post" action="?act=editb&menuid=<?php echo $menuid?>&pid=<?php echo $pid?>">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
<tr>
<td height=18 colspan="2" class=td><strong><?php echo getIdTitle($menuid)?><?php
if($sortid)
echo " > ".sortid_sortname($sortid)?></strong> 数据编辑</td>
</tr>
<tr>
<td width="18%" height=25>排序</td>
<td width="82%"><input name="px" type="text" id="px"  value="<?php echo $rs_edit["px"]?>" size="40">		</td>
</tr>
<?php
$sql="select * from sort where type_id=0 and list_id=".$menuid." order by px";
$rsmain1=$lnk -> query($sql);
if($rsmain1->num_rows>0){
?>
<tr>
<td width="18%" height=25>分类*</td>
<td width="82%"><select name='sortid' id='sortid'  onChange="javascript:document.forms('form334').sortname.value=this.options[this.options.selectedIndex].text;document.forms('form334').px.value=this.options[this.options.selectedIndex].px;document.forms('form334').photo.value=this.options[this.options.selectedIndex].pic;if(this.options[this.options.selectedIndex].sex==2){document.forms('form334').sex[1].checked=true;}else{document.forms('form334').sex[0].checked=true;}"><?php
$sortid=$rs_edit["sort_id"];
while($rsmain=mysqli_fetch_assoc($rsmain1)){
echo  "<option value=".$rsmain['id'];
if ($sortid==$rsmain['id']){echo (" selected");}
echo " px='".$rsmain['px']."'  pic='".$rsmain['pic']."'  style='font-size:12px;font-weight:bold'>";
//echo menu_num ($rsmain['id'],0);
$i="";
echo $rsmain['sort_name']."</option>";
if (MenuDown($rsmain['id'])){
//二级目录
$sql="select * from sort where type_id=".$rsmain['id']." order by px";
$rsmaina1=$lnk -> query($sql);
while($rsmaina=mysqli_fetch_assoc($rsmaina1)){
echo  "<option value=".$rsmaina['id'];
if ($sortid==$rsmaina['id']){echo (" selected");}
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
if ($sortid==$rsmainb['id']){echo (" selected");}
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
if ($sortid==$rsmainc['id']){echo (" selected");}
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
?></select></td>
</tr>
<?php }?>
<tr>
<td width="18%" height=25>标题*</td>
<td width="82%"><input name="name" type="text" id="name" size="40" value="<?php echo $rs_edit["name"]?>"></td>
</tr>
<?php
$sql="select * from tableattr where list_id=".$menuid." order by px";
$rsdata=$lnk -> query($sql);
while($rs=mysqli_fetch_assoc($rsdata)){
echo "<tr><td>".$rs["content"]."</td>";
switch ($rs["type"])
{
case 1:
$typea="<input name='".$rs["name"]."' type='text' id='".$rs["name"]."' value='".$rs_edit[$rs["name"]]."' size='30'>
<input type='button' name='Submit11' value='上传' onClick=\"window.open('./upload.php?formname=myform&editname=".$rs["name"]."&uppath=".$rs["name"]."&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')\">";
break;
case 2:
$typea="<textarea name='".$rs["name"]."' cols='40' rows='3'>".$rs_edit[$rs["name"]]."</textarea>";
break;
case 3:
$typea="<textarea name='".$rs["name"]."'  id='".$rs["name"]."'  style='width:100%;height:300px;'>".$rs_edit[$rs["name"]]."</textarea><script> var data_".$rs["name"]." = UE.getEditor('".$rs["name"]."');</script>";
break;
case 4:
$typea="";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
while($rskinds=mysqli_fetch_assoc($kindssql)){
$radio=(($rskinds["id"]+0)==($rs_edit[$rs["name"]]+0))?" checked='checked'":"";
$typea.=" <input name='".$rs["name"]."' type='radio' value='".$rskinds["id"]."' $radio  />".$rskinds["name"];
}
break;
case 5:
$typea="";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
$checkboxarr=explode(",",$rs_edit[$rs["name"]]);
while($rskinds=mysqli_fetch_assoc($kindssql)){
$checkbox= in_array($rskinds["id"],$checkboxarr)?" checked='checked'":"";
$typea.=" <input name='".$rs["name"]."[]' type='checkbox' value='".$rskinds["id"]."' $checkbox />".$rskinds["name"];
}
break;
case 6:
$typea="<select name='".$rs["name"]."'>";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
while($rskinds=mysqli_fetch_assoc($kindssql)){
$select=(($rskinds["id"]+0)==($rs_edit[$rs["name"]]+0))?" selected='selected'":"";
$typea.="<option value='".$rskinds["id"]."' $select>".$rskinds["name"]."</option>";
}
$typea.="</select>";
break;
case 7:
$tagarr=explode(",",$rs_edit[$rs["name"]]);
@$typea="<input name='".$rs["name"]."[]' type='text'  value='".$tagarr[0]."' size='10'><input name='".$rs["name"]."[]' type='text'  value='".$tagarr[1]."' size='10'><input name='".$rs["name"]."[]' type='text'  value='".$tagarr[2]."' size='10'><input name='".$rs["name"]."[]' type='text'  value='".$tagarr[3]."' size='10'><input name='".$rs["name"]."[]' type='text'  value='".$tagarr[4]."' size='10'>";
break;
case 8:
$typea="<input name='".$rs["name"]."' id='".$rs["name"]."' type='text'  value='".$rs_edit[$rs["name"]]."' size='40' readonly><script>$('#".$rs["name"]."').datepicker({
format: 'yyyy-mm-dd',
autoclose: true,
minView: 'month',
maxView: 'decade',
todayBtn: true,
pickerPosition: 'bottom-left'
})</script>";
break;
default: //文本框  0
$typea="<input name='".$rs["name"]."' type='text'  value='".$rs_edit[$rs["name"]]."' size='40'>";
break;
}
echo "<td>$typea</td></tr>";
}
?>
<tr>
<td height=25 colspan="2"> <label>
<input type="submit" name="Submit" value=" 保存编辑 " class="btn btn-success">
</label></td>
</tr>
</table>
</form>
<?php }
}
?>
<?php
//写入数据库
if($action=="addnewdata"){
$manage_id = $_SESSION['uname_admin'];
$title = $_POST["title"];
$logo = $_POST["logo"];
$content = $_POST["content"];
$wx_img = $_POST["wx_img"];
$target_num = $_POST["target_num"];
$reg_time = time();

if(!$title or !$content){
	alert("请输入必填项目！");
	exit();
	GoBack();
}else{
$insert_sql="insert into  spread_item(manage_id,title,logo,content,wx_img,code_img,target_num,reg_time)values('$manage_id','$title','$logo','$content','$wx_img','','$target_num','$reg_time')";
//echo $insert_sql;
$insert_result=$lnk -> query($insert_sql) or die(mysql_error());
alert("您的数据已加入成功！");
go("?menuid=$menuid");
}
}
?>
<?php
//编辑数据库内容
if($action=="editb" and $pid>0){
$px=$_POST["px"]+0;
$list_id=$menuid;
$sort_id=$_POST["sortid"]+0;
$name=$_POST["name"];
//得到表字段
$sql="select * from tableattr where list_id=".$menuid." order by px";
$rsdata=$lnk -> query($sql);
$sqlcol="";$sqldata="";
while($rs=mysqli_fetch_assoc($rsdata)){
$namedata=@$_POST[$rs["name"]];
if(is_array($namedata))
$namedata=implode(",",$namedata);
$sqldata.=",".$rs["name"]."='".$namedata."'";
}
if ($name==""){ alert("请填写标题！");goback();}
else
{
$lnk -> query("update attr_list_".$menuid." set px='$px',name='$name',sort_id='$sort_id',date='".date("Y-m-d H:i:s")."' $sqldata  where id=$pid") or die(mysql_error());
alert("保存成功！");
go("?menuid=$menuid");
}
}
?>
<?php
if($action=="del" and $pid>0){
$lnk -> query("delete  from attr_list_".$menuid."  where id=$pid");
alert("删除成功！");
go("?menuid=$menuid");
}
?>
</body>
</html>