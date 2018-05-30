<?php include 'config/admin.php';
require_once "../editor/ckeditor/ckeditor.php";  
require_once '../editor/ckfinder/ckfinder.php' ;  
$CKEditor = new CKEditor;

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
$item_user = $_SESSION["uname_admin"]; //当前管理员
// $item_user_arr= $arr=menu_one(3,$item_user);  //超级管理员权限
// if($item_user_arr){  //如果是超级管理员显示所有  不是只显示当前项目
// 	$item_user_sql= "";
// }else{
// 	$item_user_sql= " where  item_user = '$item_user' ";
// }

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
<li><a href="?menuid=<?php echo $menuid?>">您的位置： <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><?php if($menuid){?><a href="?menuid=<?php echo $menuid?>&act=addnew"><span class='glyphicon glyphicon-plus'></span> 新增</a><?php }?></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>
<?php if($pid and $action!="edita"){?>
<div class="text-center margin-top-25">
	<form action="?" method="get">
		<input name="key" value="<?php echo @$_GET["key"] ? $_GET["key"]:"";?>" placeholder="请输入兑换码" class="text-info">
		<input type="hidden" name="act" value="search">
		<input type="hidden" name="menuid" value="<?php echo $menuid;?>">
		<input type="hidden" name="pid" value="<?php echo @$pid?>">
 		<button class="btn btn-group btn-xs btn-info">查询</button>
	</form>
</div>
<?php  }?>
<?php if($action==""){?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?>

	</strong> 数据管理</td>
	</tr>
	</table>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
	<tr>
	<td width="10%"><strong>ID</strong></td>
	<td width="40%"><strong>模版名称</strong></td>
	<td width="30%"><strong>模版缩略图</strong></td>
	<td width="20%"><strong>操作</strong></td>
	</tr>
	<?php
	//数据列表
	
	$result = $lnk -> query("select * from view_modle  order by modle_id desc");
	while ($rs=mysqli_fetch_assoc($result)){
		echo "<tr><td>".$rs["modle_id"]."</td>";  //ID
		echo "<td><img src='".$rs["modle_name"]." height='150'></td>";  //标题
		echo "<td><img src='".$rs["modle_pic"]." height='150'></td>";  //标题
		echo "<td><a href='javascript:void(0)' onClick='confirmLink(".$rs["modle_id"].")'><span class='glyphicon glyphicon-remove'></span> 删除</a> </td>";
		echo "</tr>";
	
	}
	?>
	</table>
<?php } ?>
<?php if($action=="addnew"){?>
	<form name="myform" method="post" action="?act=addnewdata&menuid=<?php echo $menuid?>">
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
			<tr>
				<td height=18 colspan="2" class=td><strong>新增模板数据</strong> </td>
			</tr>

			<tr>
				<td width="18%" height=25>模板名称*</td>
				<td width="82%"><input name="modle_name" type="text" id="modle_name" size="40"></td>
			</tr>

			<tr>
				<td width="18%" height=25>模版缩略图*</td>
				<td width="82%"><input name='modle_pic' type='text' id='modle_pic' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=modle_pic&uppath=modle_pic&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>红页二维码位置*</td>
				<td width="82%">
					<input name='red_page_postion' type='radio' value='1' /> <img src="./images/red_page_qrcode1.jpg"> 
					<input name='red_page_postion' type='radio' value='2' /> <img src="./images/red_page_qrcode2.jpg"> 
					<input name='red_page_postion' type='radio' value='3' /> <img src="./images/red_page_qrcode3.jpg"> <br><br>
					<input name='red_page_postion' type='radio' value='4' /> <img src="./images/red_page_qrcode4.jpg"> 
					<input name='red_page_postion' type='radio' value='5' checked="checked" /> <img src="./images/red_page_qrcode5.jpg"> 
					<input name='red_page_postion' type='radio' value='6' /> <img src="./images/red_page_qrcode6.jpg"> <br><br>
					<input name='red_page_postion' type='radio' value='7' /> <img src="./images/red_page_qrcode7.jpg"> 
					<input name='red_page_postion' type='radio' value='8' /> <img src="./images/red_page_qrcode8.jpg"> 
					<input name='red_page_postion' type='radio' value='9' /> <img src="./images/red_page_qrcode9.jpg">

				</td>
			</tr>
			<tr>
				<td width="18%" height=25>红页背景图片*</td>
				<td width="82%"><input name='red_page_bgimg' type='text' id='red_page_bgimg' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=red_page_bgimg&uppath=red_page_bgimg&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片尺寸必需为 750*1136 象素
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页背景色*</td>
				<td width="82%"><input name='yellow_page_bg' type='text' id='yellow_page_bg' value=''>＊示例：#ff3300
				</td>
			</tr>
			<tr><td colspan="2" style="height:60px;padding-top: 30px;"><h3>黄页首页图片</h3></td></tr>
			<tr>
				<td width="18%" height=25>黄页首页图片(选填）</td>
				<td width="82%"><input name='yellow_page_home_img1' type='text' id='yellow_page_home_img1' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=yellow_page_home_img1&uppath=yellow_page_home_img1&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片调用根据设计稿上传（调用home_img1）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页图片(选填）</td>
				<td width="82%"><input name='yellow_page_home_img2' type='text' id='yellow_page_home_img2' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=yellow_page_home_img2&uppath=yellow_page_home_img2&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片调用根据设计稿上传（调用home_img2）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页图片(选填）</td>
				<td width="82%"><input name='yellow_page_home_img3' type='text' id='yellow_page_home_img3' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=yellow_page_home_img3&uppath=yellow_page_home_img3&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片调用根据设计稿上传（调用home_img3）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页图片(选填）</td>
				<td width="82%"><input name='yellow_page_home_img4' type='text' id='yellow_page_home_img4' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=yellow_page_home_img4&uppath=yellow_page_home_img4&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片调用根据设计稿上传（调用home_img4）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页图片(选填）</td>
				<td width="82%"><input name='yellow_page_home_img5' type='text' id='yellow_page_home_img5' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=yellow_page_home_img5&uppath=yellow_page_home_img5&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> ＊图片调用根据设计稿上传（调用home_img5）
				</td>
			</tr>
			<tr><td colspan="2" style="height:60px;padding-top: 30px;"><h3>黄页首页文字</h3></td></tr>
			<tr>
				<td width="18%" height=25>黄页首页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_home_txt1');?><br>
					（调用home_txt1）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_home_txt2');?><br>
					（调用home_txt2）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_home_txt3');?><br>
					（调用home_txt3）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_home_txt4');?><br>
					（调用home_txt4）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页首页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_home_txt5');?><br>
					（调用home_txt5）
				</td>
			</tr>
			<tr><td colspan="2" style="height:60px;padding-top: 30px;"><h3>黄页兑奖详情页</h3></td></tr>
			<tr>
				<td width="18%" height=25>黄页详情页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_detail_txt1');?><br>
					（调用detai_txt1）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页详情页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_detail_txt2');?><br>
					（调用detai_txt2）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页详情页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_detail_txt3');?><br>
					（调用detai_txt3）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页详情页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_detail_txt4');?><br>
					（调用detai_txt4）
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>黄页详情页文字(选填）</td>
				<td width="82%"><?php $CKEditor->editor('yellow_page_detail_txt5');?><br>
					（调用detail_txt5）
				</td>
			</tr>
			<script>
				setTimeout(function(){
					$(".cke_contents").height(100);
				},100);
			</script>
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
	$sql="select * from spread_item where item_id=$pid";
	$row=$lnk -> query($sql);
	while($rs_edit=mysqli_fetch_assoc($row))
	{
	?>
		<form name="myform" method="post" action="?act=editb&menuid=<?php echo $menuid?>&pid=<?php echo $pid?>">
			<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
				<tr>
					<td height=18 colspan="2" class=td><strong><?php echo getIdTitle($menuid)?></strong> 数据编辑</td>
				</tr>
				<tr>
				<td width="18%" height=25>logo标识*</td>
				<td width="82%"><input name='logo' type='text' id='logo' value='<?php echo $rs_edit["logo"]?>' size='30'>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=logo&uppath=logo&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
				</td>
				</tr>
				<tr>
				<td width="18%" height=25>项目标题*</td>
				<td width="82%"><input name="title" type="text" id="title" size="40" value="<?php echo $rs_edit["title"]?>"></td>
				</tr>
				<tr>
				<td width="18%" height=25>宣传内容*</td>
				<td width="82%"><textarea name='content'  id='content'   style='width:100%;height:300px;'><?php echo $rs_edit["content"]?></textarea><script> var data_content = UE.getEditor('content');</script></td>
				</tr>
				<tr>
					<td width="18%" height=25>公众号二维码*</td>
					<td width="82%"><input name='wx_img' type='text' id='wx_img' value='<?php echo $rs_edit["wx_img"]?>' size='30'>
						<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=wx_img&uppath=wx_img&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
					</td>
				</tr>
				<tr>
				<td width="18%" height=25>需要转发数量*</td>
				<td width="82%"><input name="target_num" type="text" id="target_num" size="40" value="<?php echo $rs_edit["target_num"]?>"></td>
				</tr>
				<tr>
					<td height=25 colspan="2"> <label><input type="submit" name="Submit" value=" 保存编辑 " class="btn btn-success"></label>
					</td>
				</tr>
			</table>
		</form>
	<?php }
}
?>


<?php if($action=="view" and $pid>0){?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?>

	</strong> 成员管理</td>
	</tr>
	</table>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
	<tr>
	<td width="5%"><strong>ID</strong></td>
	<?php if($item_user_arr){?><td width="15%"><strong>手机号</strong></td><?php }?>
	<td width="10%"><strong>已分享</strong></td>
	<td width="10%"><strong>兑换码</strong></td>
	<td width="10%"><strong>上级用户</strong></td>
	<td width="10%"><strong>兑换状态</strong></td>
	<td width="10%"><strong>兑换时间</strong></td>
	<td width="10%"><strong>操作员</strong></td>
	<td width="10%"><strong>操作</strong></td>
	</tr>
	<?php 
	//数据列表
	$result = $lnk -> query("select * from spread_user where item_id = $pid and open_status=1  order by parent_id");
	while ($rs=mysqli_fetch_assoc($result)){
		echo "<tr><td>".$rs["user_id"]."</td>";  //ID
		if($item_user_arr){ echo "<td>".$rs["phone"]."</td>";};  //手机号
		echo "<td>".get_count_redeem($rs["user_id"])." 次</td>";  //手机号
		echo "<td>".$rs["redeem_code"]."</td>";  //兑换码
		echo "<td>".$rs["parent_id"]."</td>";  //手机号
		$status_num = $rs["redeem_status"];

		switch ($status_num) {
			case 2:
				$status = "已获取";
				break;
			case 3:
				$status = "已领奖";
				break;
			
			default:
				$status = "未兑换";
				break;
		}
		$redeem_used_time = $rs["redeem_status"]>=2 ? date("Y-m-d H:i:s",$rs["redeem_used_time"]):"---"; //状态
		echo "<td>".$status."</td>";  //兑换状态
		echo "<td>".$redeem_used_time."</td>";  //兑换状态
		echo "<td>".$rs["redeem_user"]."</td>";  //操作员
		echo "<td>
		<a href='?act=search&menuid=$menuid&pid=$pid&key=".enid($rs["user_id"]+10000000)."'><span class='glyphicon glyphicon-user'></span> 查看详情</a><br>
		</td>"; 
		echo "</tr>";
	
	}
	?>


	<tr><Td colspan="<?php echo $item_user_arr? "9":"8"; ?>" align="center">一共转发<span style="color:red; font-weight: bold; font-size:16px;"><?php echo get_count_item_user($pid)-1 ;?></span>条数据 </td></tr>
	</table>
<?php } ?>




<?php
//写入数据库
if($action=="addnewdata"){
	$modle_pic               = $_POST["modle_pic"];
	$modle_name              = $_POST["modle_name"];	
	$red_page_postion        = $_POST["red_page_postion"]+0;
	$red_page_bgimg          = $_POST["red_page_bgimg"];
	$yellow_page_bg          = $_POST["yellow_page_bg"];
	$yellow_page_home_img1   = $_POST["yellow_page_home_img1"];
	$yellow_page_home_img2   = $_POST["yellow_page_home_img2"];
	$yellow_page_home_img3   = $_POST["yellow_page_home_img3"];
	$yellow_page_home_img4   = $_POST["yellow_page_home_img4"];
	$yellow_page_home_img5   = $_POST["yellow_page_home_img5"];
	$yellow_page_home_txt1   = $_POST["yellow_page_home_txt1"];
	$yellow_page_home_txt2   = $_POST["yellow_page_home_txt2"];
	$yellow_page_home_txt3   = $_POST["yellow_page_home_txt3"];
	$yellow_page_home_txt4   = $_POST["yellow_page_home_txt4"];
	$yellow_page_home_txt5   = $_POST["yellow_page_home_txt5"];
	$yellow_page_detail_txt1 = $_POST["yellow_page_detail_txt1"];
	$yellow_page_detail_txt2 = $_POST["yellow_page_detail_txt2"];
	$yellow_page_detail_txt3 = $_POST["yellow_page_detail_txt3"];
	$yellow_page_detail_txt4 = $_POST["yellow_page_detail_txt4"];
	$yellow_page_detail_txt5 = $_POST["yellow_page_detail_txt5"];

	if(strlen($modle_name)< 2){
		alert("请输入模板名称");
		GoBack();
		exit();	
	}

	if(!$red_page_postion){
		alert("请选择二维码（红页）位置！");
		GoBack();
		exit();
	}else{
		$lnk -> query("insert into  view_modle(modle_pic,modle_name,red_page_postion,red_page_bgimg,yellow_page_home_img1,yellow_page_home_img2,yellow_page_home_img3,yellow_page_home_img4,yellow_page_home_img5,yellow_page_home_txt1,yellow_page_home_txt2,yellow_page_home_txt3,yellow_page_home_txt4,yellow_page_home_txt5,yellow_page_detail_txt1,yellow_page_detail_txt2,yellow_page_detail_txt3,yellow_page_detail_txt4,yellow_page_detail_txt5)values('$modle_pic','$modle_name','$red_page_postion','$red_page_bgimg','$yellow_page_home_img1','$yellow_page_home_img2','$yellow_page_home_img3','$yellow_page_home_img4','$yellow_page_home_img5','$yellow_page_home_txt1','$yellow_page_home_txt2','$yellow_page_home_txt3','$yellow_page_home_txt4','$yellow_page_home_txt5','$yellow_page_detail_txt1','$yellow_page_detail_txt2','$yellow_page_detail_txt3','$yellow_page_detail_txt4','$yellow_page_detail_txt5')");
		alert("您的数据已加入成功！");
		echo ("insert into  view_modle(modle_pic,modle_name,red_page_postion,red_page_bgimg,yellow_page_home_img1,yellow_page_home_img2,yellow_page_home_img3,yellow_page_home_img4,yellow_page_home_img5,yellow_page_home_txt1,yellow_page_home_txt2,yellow_page_home_txt3,yellow_page_home_txt4,yellow_page_home_txt5,yellow_page_detail_txt1,yellow_page_detail_txt2,yellow_page_detail_txt3,yellow_page_detail_txt4,yellow_page_detail_txt5)values('$modle_pic','$modle_name','$red_page_postion','$red_page_bgimg','$yellow_page_home_img1','$yellow_page_home_img2','$yellow_page_home_img3','$yellow_page_home_img4','$yellow_page_home_img5','$yellow_page_home_txt1','$yellow_page_home_txt2','$yellow_page_home_txt3','$yellow_page_home_txt4','$yellow_page_home_txt5','$yellow_page_detail_txt1','$yellow_page_detail_txt2','$yellow_page_detail_txt3','$yellow_page_detail_txt4','$yellow_page_detail_txt5')");
		exit;
		go("?menuid=$menuid");
	}
}
?>
<?php
//编辑数据库内容
if($action=="editb" and $pid>0){

$title = $_POST["title"];
$logo = $_POST["logo"];
$content = $_POST["content"];
$wx_img = $_POST["wx_img"];
$target_num = $_POST["target_num"];


if (!$title or !$content){ alert("请填写标题！");goback();}
else
{
$lnk -> query("update spread_item set title='$title',logo='$logo',content='$content',wx_img='$wx_img', target_num='$target_num' where item_id=$pid") or die(mysql_error());
alert("保存成功！");
go("?menuid=$menuid");
}
}
?>
<?php
if($action=="del" and $pid>0){
$lnk -> query("delete  from spread_operator  where id=$pid");
alert("删除成功！");
go("?menuid=$menuid");
}


function get_user_info($username,$manage){
	global $lnk;
	$result=$lnk -> query("select * from spread_operator  where  username='$username' and manage='$manage'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		$_SESSION['uname_operator']=$rs["manage"];
		return $rs;
	}
	return 0;
}

?>
</body>
</html>