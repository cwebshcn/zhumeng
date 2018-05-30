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
@$menuid=$_GET['menuid']+0; #得到当前目录ID
@$sortid=$_GET['sortid']+0; #得到当前分类ID
@$pid=$_GET['pid']+0; #得到当前ID
if($menuid==""){alert("ID丢失，请重新选择！");}
//是否有图片
$attr = $lnk->query('DESCRIBE attr_list_'.$menuid);
$tables=array();
if($attr){
while($arr = $attr->fetch_assoc()){
$tables[]=$arr["Field"];
}
}
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
<li><a href="?menuid=<?php echo $menuid?>">您的位置：数据管理 >><?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><?php if($menuid){?><a href="?menuid=<?php echo $menuid?>&act=addnew&sortid=<?php echo $sortid?>"><span class='glyphicon glyphicon-plus'></span> 添加新数据</a><?php }?></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<?php  include 'sub_menu.php'; ?>
</div>
<div class="text-center margin-top-25">
<?php
$left_id= getIdMianId($menuid)+0;
$result=$lnk -> query("select * from sort where list_id='".$menuid."' and type_id=0");
if ($result)
$i=0;
while ($kind=mysqli_fetch_assoc($result)){
if ($i==0){echo "<a href='#' class='btn btn-danger btn-xs'>子分类列表</a>  &nbsp;&nbsp;&nbsp;";}
//if($kind["id"]!=$menu_id)
echo "<a href='?menuid=$menuid&sortid=".$kind["id"]."'><span class='btn btn-success btn-xs'>".$kind['sort_name']."</span></a> &nbsp;&nbsp;&nbsp;";
$i++;
}
?>
</div>
<?php if($action==""){?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?>
<?php
if($sortid)
echo " > ".sortid_sortname($sortid)?>
</strong> 数据管理</td>
</tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
<tr>
<td width="10%"><strong>ID</strong></td>
<td><strong></strong></td>
<td width="60%"><strong>名称</strong></td>
<td width="10%"><strong>排序</strong></td>
<td width="20%"><strong>操作</strong></td>
</tr>
<?php
//数据列表
$where= $sortid!="" ? " where sort_id in (".sqlsortid($sortid,"start").")": "";
$result=$lnk -> query("select * from attr_list_".$menuid.$where." order by px,id desc");
if($result){
while ($rs=mysqli_fetch_assoc($result)){
echo "<tr><td>".$rs["id"]."</td>";  //ID
//数组中是否有照片，是否有"diy_pic"  照片
echo "<td>";
if(in_array("diy_pic",$tables)){
echo "<img src='temp/".$rs["diy_pic"]."' width='100' height='80'>";
}
echo "</td>";
echo "<td>".$rs["name"]."</td>";  //标题
echo "<td>".$rs["px"]."</td>";  //排序
echo "<td><a href='?act=addnew&menuid=$menuid'><span class='glyphicon glyphicon-plus'></span></a>&nbsp;&nbsp;&nbsp;<a href='?act=edita&sortid=$sortid&menuid=$menuid&pid=".$rs["id"]."'><span class='glyphicon glyphicon-pencil'></span></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' onClick='confirmLink(".$rs["id"].")'><span class='glyphicon glyphicon-remove'></span></a></td>";  //操作
echo "</tr>";
}
}
?>
</table>
<?php } ?>
<?php if($action=="addnew"){?>
<form name="myform" method="post" action="?act=addnewdata&menuid=<?php echo $menuid?>">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
<tr>
<td height=18 colspan="2" class=td><strong><?php echo getIdTitle($menuid)?><?php
if($sortid)
echo " > ".sortid_sortname($sortid)?></strong> 数据添加</td>
</tr>
<tr>
<td width="18%" height=25>排序</td>
<td width="82%"><input name="px" type="text" id="px"  value="0" size="40">		</td>
</tr>
<?php
$sql="select * from sort where type_id=0 and list_id=".$menuid." order by px";
$rsmain1=$lnk -> query($sql);
if($rsmain1->num_rows>0){
?>
<tr>
<td width="18%" height=25>分类*</td>
<td width="82%"><select name='sortid' id='sortid'  onChange="javascript:document.forms('form334').sortname.value=this.options[this.options.selectedIndex].text;document.forms('form334').px.value=this.options[this.options.selectedIndex].px;document.forms('form334').photo.value=this.options[this.options.selectedIndex].pic;if(this.options[this.options.selectedIndex].sex==2){document.forms('form334').sex[1].checked=true;}else{document.forms('form334').sex[0].checked=true;}"><?php
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
<td width="82%"><input name="name" type="text" id="name" size="40"></td>
</tr>
<?php
$sql="select * from tableattr where list_id=".$menuid." order by px";
$rsdata=$lnk -> query($sql);
while($rs=mysqli_fetch_assoc($rsdata)){
echo "<tr><td>".$rs["content"]."</td>";
switch ($rs["type"])
{
case 1:
$typea="<input name='".$rs["name"]."' type='text' id='".$rs["name"]."' value='' size='30'>
<input type='button' name='Submit11' value='上传' onClick=\"window.open('./upload.php?formname=myform&editname=".$rs["name"]."&uppath=".$rs["name"]."&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')\">";
break;
case 2:
$typea="<textarea name='".$rs["name"]."' cols='40' rows='3'></textarea>";
break;
case 3:
$typea="<textarea name='".$rs["name"]."'  id='".$rs["name"]."'  style='width:100%;height:300px;'></textarea><script> var data_".$rs["name"]." = UE.getEditor('".$rs["name"]."');</script>";
break;
case 4:
$typea="";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
while($rskinds=mysqli_fetch_assoc($kindssql)){
$typea.=" <input name='".$rs["name"]."' type='radio' value='".$rskinds["id"]."' />".$rskinds["name"];
}
break;
case 5:
$typea="";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
while($rskinds=mysqli_fetch_assoc($kindssql)){
$typea.=" <input name='".$rs["name"]."[]' type='checkbox' value='".$rskinds["id"]."' />".$rskinds["name"];
}
break;
case 6:
$typea="<select name='".$rs["name"]."'>";
$kindssql=$lnk -> query("select * from kinds where kind_id=".$rs["id"]." order by px");
while($rskinds=mysqli_fetch_assoc($kindssql)){
$typea.="<option value='".$rskinds["id"]."'>".$rskinds["name"]."</option>";
}
$typea.="</select>";
break;
default: //文本框  0
$typea="<input name='".$rs["name"]."' type='text'  value='' size='40'>";
break;
}
echo "<td>$typea</td></tr>";
}
?>
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
$px=$_POST["px"]+0;
$list_id=$menuid;
$sort_id=$_POST["sortid"]+0;
$name=$_POST["name"];
//得到表字段
$sql="select * from tableattr where list_id=".$menuid." order by px";
$rsdata=$lnk -> query($sql);
$sqlcol="";$sqldata="";
while($rs=mysqli_fetch_assoc($rsdata)){
$sqlcol.=",".$rs["name"];
$namedata=$_POST[$rs["name"]];
if(is_array($namedata))
$namedata=implode(",",$namedata);
$sqldata.=",'".$namedata."'";
}
if ($name==""){ alert("请填写标题！");goback();}
else
{
$insert_sql="insert into attr_list_".$menuid." (px,name,sort_id,list_id,date".$sqlcol.")values('$px','$name','$sort_id','$list_id','".date("Y-m-d H:i:s")."'".$sqldata.")";
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
<?php
$go_url = 'http://www.yto.net.cn/gw/index/index.html';
$content=curl_wx($go_url);
echo ($content);
function curl_wx($go_url){
global $cookie_file;
$ch = curl_init($go_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$content = curl_exec($ch);
//var_dump(curl_error($ch));
//print_r($content);
curl_close($ch);
return $content;
}
?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>