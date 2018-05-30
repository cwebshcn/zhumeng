<?php

include 'config/admin.php'; 
include "../lib/code36.php"; 
include "../phpqrcode/qrlib.php";  // QRcode lib
include './function/comm.php';




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
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/h5style.css" rel="stylesheet">
<link href="../css/datepicker.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css">
<!--UE-->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>
<?php

//=------------动作说明-------------------

@$pid=$_GET['pid']+0; #得到当前项目ID
?>
<div style="width:1024px;margin:0 auto;text-align: center;padding:25px;">
	<h3>统计一览表（总计：<?php echo count_all($pid);?> 人）</h3>
	<div>&nbsp;</div>
	<?php
	$courseResult=$lnk -> query("select * from item_class where item_id='".$pid."'");
	while ($course=mysqli_fetch_assoc($courseResult)){?>
	<h4 style="text-align: left; margin-top: 80px;"><?php echo $course["class_name"]?>   (小计：<?php echo count_all($pid,$course["class_id"]);?> 人)</h4>
	

	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
	<tr>
		<td><strong>学生编号</strong></td>
		<td><strong>课程名称</strong></td>
		<td><strong>项目名称</strong></td>
		<td><strong>学生姓名</strong></td>
		<td><strong>推荐人姓名</strong></td>

	</tr>
	<?php
		$result=$lnk -> query("select * from item_user_buy where item_id='".$pid."' and class_id='".$course["class_id"]."'");
		while ($rs=mysqli_fetch_assoc($result)){ 
	?>
	<tr>
		<td><?php echo $rs["user_id"]?></td>
		<td><?php echo $course["class_name"]?></td>
		<td><?php echo get_item_info($rs["item_id"])?></td>
		<td><?php echo $rs["student"]?></td>
		<td><?php echo $rs["teacher"]?></td>

	</tr>
	<?php }?>
	</table>
<?php }?>	
</div>
<?php 
	function count_all($item_id,$classid=""){
		global $lnk;
		$classSql = $classid ? " and class_id=$classid" : "";
		$result=$lnk -> query("select count(0) from item_user_buy where item_id='".$item_id."' $classSql"); 
		while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
	}
	//通过用户id得到已转发的数量//统计bc下线总和
function get_item_info($item_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_item where item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return  $rs["title"];
	}
}

function get_user_info($user_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_user where open_status=1 and user_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return  $rs["name"];
	}
}
?>
</body>
</html>