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
@$pid=$_GET['pid']+0; #得到当前项目ID
if(!$pid)
	return;
@$prizeId = $_GET["prizeid"];
//=------------动作说明-------------------
@$act=$_GET["act"];//动作

switch ($act) {
	case 'del':
		del($pid,$prizeId);
		break;
	case 'addfrom':
		addfrom($pid);
		break;
	case 'add':
		add($pid);
		break;
	
	default:
		def($pid);
		break;
}
exit();
//默认================================================================
function def($pid){
	global  $lnk;
?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
		<tr><td class="text-center font24"><strong>对奖阶梯设置
		</strong><div style="text-align: right;margin-top:-30px;font-size:14px;"><a href="?act=addfrom&pid=<?php echo $pid;?>" style="">新增</a></div></td>
		</tr>
		</table>
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
		<tr>
			<td width="5%"><strong>ID</strong></td>
			<td width="40%"><strong>达到领奖个数</strong></td>
			<td width="35%"><strong>兑奖金额</strong></td>
			<td width="20%"><strong>操作</strong></td>
		</tr>
		<?php 
			$result=$lnk -> query("select * from spread_item_prize where item_id='".$pid."' order by need_num");
			while ($rs=mysqli_fetch_assoc($result)){ 
		?>
		<tr>
			<td><strong><?php echo $rs["id"];?></strong></td>
			<td><strong><?php echo $rs["need_num"];?></strong></td>
			<td><strong><?php echo $rs["prize_cash"];?></strong>元</td>
			<td><strong><a href='javascript:void(0)' onClick='removePrize(<?php echo $rs["id"];?>)'><span class='glyphicon glyphicon-trash'></span> 删除</a><br></strong></td>
		</tr>
		<?php } ?>	
	</table>
	<h4 style="text-align: center;padding-top:25px;"><a href="javascript:void(0)" onclick="window.close()" class="btn btn-primary">返回项目</a></h4>
	<script>
	//删除确认
		function removePrize(prizeId){
			if(window.confirm("你确认删除么,删除后不能恢复！")){
				window.location.href = "?pid=<?php echo $pid;?>&act=del&prizeid="+prizeId;
			}	
		}
	</script>
<?php }

//删除================================================================
function del($pid,$prizeId){
	if(!$prizeId)
		return ;
	global  $lnk;
	$lnk -> query("delete from spread_item_prize where id = $prizeId and item_id=$pid");
	go("?pid=$pid");
	exit;
}

//添加================================================================
function addfrom($pid){
	global  $lnk;
	?>

	<form name="myform" id="wx_kf_add_form" method="post" action="?act=add&pid=<?php echo $pid?>">
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
			<tr>
				<td height=18 colspan="2" class=td><strong>规则</strong> 数据添加</td>
			</tr>
			<tr>
				<td width="18%" height=25>达到领奖个数<br>（B级用户）*</td>
				<td width="82%"><input name="need_num" type="text" id="need_num" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>可兑奖金额*</td>
				<td width="82%"><input name="prize_cash" type="text" id="prize_cash" size="40"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" name="Submit" value=" 保存添加 " id="wx_kf_add_submit" class="btn btn-success" ></td>
			</tr>
			<script>
			$("#wx_kf_add_submit").click(function(e){
				$("#wx_kf_add_form").submit();
				$("#wx_kf_add_submit").attr("disabled","disabled");
			});
			</script>
		</table>
	</form>
<?php }

//添加================================================================
function add($pid){
	global  $lnk;
	$need_num = $_POST["need_num"]+0;
	$prize_cash = $_POST["prize_cash"]+0.00;
	$lnk->query("insert into spread_item_prize(item_id,need_num,prize_cash)values('$pid','$need_num','$prize_cash')");
	go("?pid=$pid");
	exit;
}

?>

</body>
</html>