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
<div style="width:1200px;margin:0 auto;text-align: center;padding:25px;">
	<h3>用户来源及事件一览表</h3>

	<div style="font-size:16px;color:#fff; border-bottom:2px solid #ffaa00;">
		<ul class="row">
			<li class="" id="menu">
				<div class="row">
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">来自分享页</ul>
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">来自直播间</ul>
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">点击过手机</ul>
					<ul class="col-lg-2 col-md-2 col-sm-2 col-xs-2">识别过客服二维码</ul>
				</div>
			</li>
		</ul>
		<ul class="row">
	</div>
	<!--<div id="data_order_btn">
		<ul class="row">
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级开卡<button onclick="listData(this,'count_card')">升</button><button onclick="listData(this,'count_card',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级成交<button onclick="listData(this,'count_deal')">升</button><button onclick="listData(this,'count_deal',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">下级带看<button onclick="listData(this,'count_take')">升</button><button onclick="listData(this,'count_take',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">视频观看<button onclick="listData(this,'get_rtmp')">升</button><button onclick="listData(this,'get_rtmp',1)">降</button></li>
			<li class="col-lg-2 col-md-2 col-sm-2 col-xs-2">打开时间<button onclick="listData(this,'user_id')">升</button><button onclick="listData(this,'user_id',1)">降</button></li>
		</ul>
	</div>-->
	<div class="row" >
		<div>&nbsp;</div>

	<div id="data_list">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="font-size:14px;color:#333;border-bottom:1px solid #e0e0e0;line-height:32px;" v-for="l in list">
			<span  v-if="l.avatar" ><img :src="l.avatar" style="width:60px;height:60px;margin:3px;"/></span>
			<span  v-else class="glyphicon glyphicon-user" style="display:inline-block;width:60px;height:60px;font-size:36px;color:#ccc;margin:3px;"></span>

			 {{l.nick_name ? l.nick_name : ''}}   {{l.phone>0? l.phone : ''}}</div>
	</div>

			<?php 

				//所有从分享页进的用户
			    $count_share_page = 0; 
			    //所有从分享页进的用户组
			    $arr_share_page=array();
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,avatar,nick_name from spread_user where item_id='".$pid."' and parent_id<>'0' and enter_path='0' and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_share_page++;
					$arr_share_page[] = $rs;
				}
		

				
			
				//所有从直播间进的用户
			    $count_liveroom_page = 0; 
			    //所有从分享页进的用户组
			    $arr_liveroom_page=array();
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,avatar,nick_name from spread_user where item_id='".$pid."' and parent_id<>'0' and enter_path='1' and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_liveroom_page++;
					$arr_liveroom_page[] = $rs;
				}

				//所有从直播间进的用户
			    $count_click_phone = 0; 
			    //所有从分享页进的用户组
			    $arr_click_phone=array();
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,avatar,nick_name from spread_user where item_id='".$pid."' and parent_id<>'0' and touch_phone='1' and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_click_phone++;
					$arr_click_phone[] = $rs;
				}



				//所有从直播间进的用户
			    $count_touch_qrocde = 0; 
			    //所有从分享页进的用户组
			    $arr_touch_qrocde=array();
				$result=$lnk -> query("select count_card,count_deal,count_take,get_rtmp,user_id,phone,avatar,nick_name from spread_user where item_id='".$pid."' and parent_id<>'0' and touch_wx_qrcode='1' and openid<>'' order by redeem_count_bc desc");
				while ($rs=mysqli_fetch_assoc($result)){ 
					$count_touch_qrocde++;
					$arr_touch_qrocde[] = $rs;
				}

			
				
			?>

	
	</div>
</div>
<?php 
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


	$("#menu ul").eq(0).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_share_page;?>)</span>");
	$("#menu ul").eq(1).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_liveroom_page;?>)</span>");
	$("#menu ul").eq(2).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_click_phone;?>)</span>");
	$("#menu ul").eq(3).append("<span style='font-size:12px;color:yellow'>(<?php echo $count_touch_qrocde;?>)</span>");

	//数据排序
	var arr_share_page = <?php echo json_encode($arr_share_page,true);?>,
		arr_liveroom_page =<?php echo json_encode($arr_liveroom_page,true);?>,
		arr_click_phone =<?php echo json_encode($arr_click_phone,true);?>,
		arr_touch_qrocde=<?php echo json_encode($arr_touch_qrocde,true);?>;

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
		  dataList.list = arr_share_page;
		  break;
		case 1:
		  dataList.list = arr_liveroom_page;
		  break;
		case 2:
		  dataList.list = arr_click_phone;
		  break;
		case 3:
		  dataList.list = arr_touch_qrocde;
		  break;
		default:
		  dataList.list = arr_share_page;
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