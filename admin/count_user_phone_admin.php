<?php

include 'config/admin.php'; 
include "../lib/code36.php"; 
include "../phpqrcode/qrlib.php";  // QRcode lib
include './function/comm.php';
include '../lib/phpexcel/PHPExcel.php';



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
<style type="text/css">
	#menu {font-size:16px;color:#fff;margin-top:41px;}
	#menu ul{line-height:40px; background-color: #aaa;margin-left:14px;}
	#menu ul:hover{ background-color: #ffaa00;}
	#menu ul.active{background-color: #ffaa00;}
	#input ul>div a{display: block;line-height:40px; background-color: #fff;color:#ffaa00;margin-left:14px;}
	#input ul>li a{display: block;line-height:40px; background-color: #ac0;margin-left:14px;color:#fff; text-decoration: none;}
	#input ul>li a:hover{background-color:#aa0;color:#fff;};
	#data_order_btn button{background-color: #eee;}
	#data_order_btn button:disabled{background-color: #ffaa00;color:#fff;}
</style>
<!--UE-->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>
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
	<h3>用户手机号一览表</h3>

	<div style="font-size:16px;color:#fff; border-bottom:2px solid #ffaa00;">
		<ul class="row">
			<li class="col-lg-7 col-md-7 col-sm-7 col-xs-7" id="menu">
				<div class="row">
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">所有</ul>
					<ul class="col-lg-4 col-md-4 col-sm-4 col-xs-4">有意向未成功</ul>
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">成功</ul>
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">潜在</ul>
				</div>
			</li>
			<li class="col-lg-5 col-md-5 col-sm-5 col-xs-5" id="input">
				<div class="row">
					<ul class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div><a href="../lib/phpexcel/module.xls">下载模板</a></div>
						<li><a href="load_user_excel.php?pid=<?php echo $pid?>&type=intention" target="_blank">导入有意向客户</a></li>
					</ul>
					<ul class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div><a href="../lib/phpexcel/module.xls">下载模板</a></div>
						<li><a href="load_user_excel.php?pid=<?php echo $pid?>&type=success" target="_blank">导入成功客户</a></li>
					</ul>
				</div>
			</li>
		</ul>
		<ul class="row">
	</div>
	<div id="data_order_btn">
		<ul class="row">
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级开卡<button onclick="listData(this,'count_card')">升</button><button onclick="listData(this,'count_card',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级成交<button onclick="listData(this,'count_deal')">升</button><button onclick="listData(this,'count_deal',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级带看<button onclick="listData(this,'count_take')">升</button><button onclick="listData(this,'count_take',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">视频观看<button onclick="listData(this,'get_rtmp')">升</button><button onclick="listData(this,'get_rtmp',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">打开时间<button onclick="listData(this,'user_id')">升</button><button onclick="listData(this,'user_id',1)">降</button></li>
		</ul>
	</div>
	<div class="row" >
		<div>&nbsp;</div>

	<div id="data_list">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="font-size:14px;color:#333;border-bottom:1px solid #e0e0e0;line-height:32px;" v-for="l in list">{{l.nick_name}}  {{l.phone}}</div>
	</div>

			<?php 
				//所有成功的用户集
				$success=get_success_user($pid);
				//所有用户统计
			    $count_all = 0; 
			    //所有用户组
			    $arr_all=array();
				//有意向未成功用户
				$result=$lnk -> query("select phone,user_name from user_exl_input where item_id='".$pid."' ");
				while ($rs=mysqli_fetch_assoc($result)){ 
				$count_all++;
				$arr_all[] = get_user_px_info($pid,$rs["phone"],$rs["user_name"]);
				}
		
			//所有用户
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,nick_name from spread_user where item_id='".$pid."' and phone>0 and open_status=1 and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){
				$count_all++;
				$arr_all[] =$rs;
				}
			
				//统计个数
				$count_intention = 0;
				//用户排序
				$arr_intention = array();
				//有意向未成功用户
				$result=$lnk -> query("select phone,user_name from user_exl_input where item_id='".$pid."' and  status_success!=1");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_intention ++;
					$arr_intention[] = get_user_px_info($pid,$rs["phone"],$rs["user_name"]);
				}
			
				$count_success = count($success);
				//用户排序
				$arr_success = array();
				//成功用户
				$result=$lnk -> query("select phone,user_name from user_exl_input where item_id='".$pid."' and  status_success=1");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$arr_success[] =get_user_px_info($pid,$rs["phone"],$rs["user_name"]);
			
				}
				$count_nosuccess = 0;
				//用户排 序
				$arr_nosuccess= array();
				//有意向未成功用户
				$result=$lnk -> query("select phone,user_name from user_exl_input where item_id='".$pid."' and  status_success!=1");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_nosuccess++;
					$arr_nosuccess[] = get_user_px_info($pid,$rs["phone"],$rs["user_name"]);
				}
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,nick_name from spread_user where item_id='".$pid."' and phone>0 and open_status=1 and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){ 
					if(!in_array($rs["phone"], $success)){
						$count_nosuccess++;
						$arr_nosuccess[] = $rs;
					}
				}
			?>

	
	</div>
</div>
<?php 
	function count_all_phone($item_id){
		global $lnk;
		$result=$lnk -> query("select count(0) from spread_user where item_id='".$item_id."' and phone>0 and open_status=1 and openid<>'' order by redeem_count_bc desc"); 
		while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
	}

	//得到成功用户
	function get_success_user($pid){
		global $lnk;
		$arr = array();
		$result=$lnk -> query("select phone,user_name from user_exl_input where item_id='".$pid."' and  status_success=1");
		while ($rs=mysqli_fetch_assoc($result)){ array_push($arr,$rs["phone"]);}
		return $arr;
	}
	//得到用户
	function get_user_px_info($pid,$phone,$user_name){
		global $lnk;
		$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,nick_name from spread_user where item_id='".$pid."' and  phone='$phone'");
		while ($rs=mysqli_fetch_assoc($result)){
			$rs["nick_name"]=$user_name;
			return $rs;
		}
		return array("count_card"=>"0","count_deal"=>"0","count_take"=>"0","get_rtmp"=>"0","user_id"=>"0","phone"=>$phone,"nick_name"=>$user_name);
	}
	//数组排列    参数：$arr 二维数
	function multi_array_sort($arr,$shortKey,$short=SORT_DESC,$shortType=SORT_REGULAR)
	{
		if(empty($arr))return $arr;
		foreach ($arr as $key => $data){
			$name[$key] = $data[$shortKey];
		}
		array_multisort($name,$shortType,$short,$arr);
		return $arr;
	}

?>
<script>
(function($) {
	$.getUrlParam = function(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
			return unescape(r[2]);
		return null;
	}
})(jQuery);


$("#menu ul").eq(0).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_all;?>)</span>");
	$("#menu ul").eq(1).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_intention;?>)</span>");
	$("#menu ul").eq(2).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_success;?>)</span>");
	$("#menu ul").eq(3).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_nosuccess;?>)</span>");

	//数据排序
	var arr_all = <?php echo json_encode($arr_all,true);?>,
		arr_intention =<?php echo json_encode($arr_intention,true);?>,
		arr_success =<?php echo json_encode($arr_success,true);?>,
		arr_nosuccess =<?php echo json_encode($arr_nosuccess,true);?>;

	var dataList = new Vue({
		el: "#data_list",
		data: {
			list:[],
		}
	})

//升序
function sortByAsc(array, key) {
    return array.sort(function(a, b) {
        var x = parseFloat(a[key]); var y = parseFloat(b[key]);
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}
//降序
function sortByDesc(array, key) {
    return array.sort(function(a, b) {
        var x = parseFloat(a[key]); var y = parseFloat(b[key]);
        return ((x > y) ? -1 : ((x < y) ? 1 : 0));
    });
}
	$("#menu ul").click(function(){
		var n=$(this).index();
		onHoverMenu(n);
	});
	function onHoverMenu(n){
		$("#menu ul").removeClass("active");
		$("#menu ul").eq(n).addClass('active');
		//$("#user_list_data ul").hide();
		//$("#user_list_data ul").eq(n).show();
		showdata(n);
	}

	var n=$.getUrlParam(n)|| 0;
	onHoverMenu(n);

	function showdata(n){
		switch(n)
		{
		case 0:
		  dataList.list = arr_all;
		  break;
		case 1:
		  dataList.list = arr_intention;
		  break;
		case 2:
		  dataList.list = arr_success;
		  break;
		case 3:
		  dataList.list = arr_nosuccess;
		  break;
		default:
		  dataList.list = arr_all;
		}
		
	}

	function listData(obj,key,orderBy="asc"){
		$("#data_order_btn button").removeAttr("disabled");
		$(obj).attr("disabled","disabled");
		if(orderBy==1)
			dataList.list=sortByDesc(dataList.list, key);
		else
			dataList.list=sortByAsc(dataList.list, key);
		console.log(JSON.stringify(dataList.list));

	}
		




	


</script>
</body>
</html>