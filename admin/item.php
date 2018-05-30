<?php

include 'config/admin.php'; 
include "../lib/code36.php"; 
include "../phpqrcode/qrlib.php";  // QRcode lib
include 'function/comm.php';
//当前网站是否正式站
$itemSiteType = strpos("vip".$weburl."vip","dev") ? "0" : "1"; //防止头尾出现
$nn=0;
//=------------动作说明-------------------
@$action=$_GET['act']; #获取动作
@$pid=$_GET['pid']+0; #得到当前项目ID
@$kf_id=$_GET['kf_id']+0; #得到当前项目的客服ID

@$menuid=$_GET['menuid']+0; #得到当前项目ID
$item_user = $_SESSION["uname_admin"]; //当前管理员
$item_user_arr= $arr=menu_one(3,$item_user);  //超级管理员权限
if($item_user_arr){  //如果是超级管理员显示所有  不是只显示当前项目
	$item_user_sql= "";
}else{
	$item_user_sql= " and  item_user = '$item_user' ";
}

if($menuid==""){alert("ID丢失，请重新选择！");}

//得到首发二维码，解决qrcode不能同时运行，进程功能未开。
if($action=="get_qrcode"){
	$u=$_GET["u"]+0;
	$weburl = str_replace("admin/","",strtolower($weburl));
	$zz_qrcode = qrcode($weburl."dshow.php?u=".$u);
	echo "|".$zz_qrcode;
	exit();
}

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
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/h5style.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css">

<link type="text/css" href="https://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />

<link href="../js/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.css" type="text/css" />
<link href="../js/jQuery-Timepicker-Addon/demos.css" rel="stylesheet" type="text/css" />

<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
<script src="../js/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.js" type="text/javascript"></script>

<!--中文-->
<script src="../js/jQuery-Timepicker-Addon/jquery.ui.datepicker-zh-CN.js.js" type="text/javascript" charset="gb2312"></script>
<script src="../js/jQuery-Timepicker-Addon/jquery-ui-timepicker-zh-CN.js" type="text/javascript"></script>

 
<!--UE-->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>

<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>

<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
<style type="text/css">
	#msg_dialog{
		width: 600px;
		height: 265px;
		background: white;
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto;
		border-radius: 2px;
		box-shadow: 0px 0px 3px  gray;
		display: none;
	}
	#msg_dialog > .top_menu{
		width: 100%;
		height: 25px;
		position: absolute;
		top: 0px;
		left: 0;
		right: 0;
		margin: auto;
		border-bottom: 1px solid #ccc;
		background-color: #e0e0e0;
		
	}
	/*关闭按钮*/
	#msg_dialog > .top_menu > .close_btn{
		width: 20px;
		height: 20px;
		background: url(../images/close_icon.png) no-repeat center center;
		background-size: cover;
		position: absolute;
		top: 0;
		bottom: 0;
		right: 10px;
		margin: auto;
		cursor: pointer;
	}
	#msg_dialog > ul {
		width: 100%;
		height: 240px;
		overflow: auto;
		margin-top: 25px;
	}
	
	#msg_dialog > ul > li {
		height: 40px;
		width: 100%;
		list-style: none;
		font-family: "微软雅黑";
		line-height: 40px;
		text-align: center;
		border-bottom: 1px solid #ccc;
	}
	
	#msg_dialog > ul > li > p{
		margin: 0;
		padding: 0;
		float: left;
		width: 32%;
		text-align: center;
		border-right: 1px solid #ccc;
	}
	
	#msg_dialog > ul > li > p:last-child{
		border: 0;
	}
</style>
</head>
<body>

<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=del&pid="+id;
}
}
function  confirm_wx_kf(pid,id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=del_wx_kf&pid="+pid+"&kf_id="+id;
}
}
</script>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：<?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><?php if($menuid){?><a href="?menuid=<?php echo $menuid?>&act=addnew" id="addnew"><span class='glyphicon glyphicon-plus' ></span> 新增</a><?php }?></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>
<?php if($pid and ($action=="search" or $action=="view")){?>
<div class="text-center margin-top-25">
	<form action="?" method="get">
		<input name="key" value="<?php echo @$_GET["key"] ? $_GET["key"]:"";?>" placeholder="请输入手机号" class="text-info">
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
	<td width="5%"><strong>ID</strong></td>
	<td><strong>logo标识</strong></td>
	<td width="20%"><strong>名称</strong></td>
	<td width="35%"><strong>课程管理</strong></td>
	<td width="20%"><strong>操作</strong></td>
	</tr>
	<?php

	//课程列表
	function course_list($itemId){
		global $lnk;
		$item_list="";
		$result2 = $lnk -> query("select * from item_class where item_id=$itemId");
		while ($course=mysqli_fetch_assoc($result2)){
			$item_list.= "<a  href='javascript:void(0)' onClick='removeCourse(".$course["class_id"].")'><div class='remove' course_id=".$course["class_id"].">".$course["class_name"]."<span  class='glyphicon glyphicon-remove'></span></div></a>";
		}
		return $item_list."<a href='javascript:void(0)' onClick='addCourse(".$itemId.")' id='item".$itemId."'><div><input style='width:100px;height:20px;line-height:20px;border:1px solid #e0e0e0'>添加课程<span  class='glyphicon glyphicon-plus'></span></div></a>";
	}
	//数据列表
	$adminuser  = "_admin";
	//$adminuser  = $_SESSION["uname_admin"]=="admin" ? "_admin" :"";
	$result = $lnk -> query("select * from spread_item  where site = '$itemSiteType' $item_user_sql order by item_id desc");
	while ($rs=mysqli_fetch_assoc($result)){
		echo "<tr><td>".$rs["item_id"]."</td>";  //ID
		$logo = explode("|",$rs["logo"]);
		echo "<td>";
		for($i=0;$i<count($logo);$i++){
			echo "<img src='temp/".$logo[$i]."' style='height:60px;'>";
		}
		echo "</td>";  //ID
		echo "<td>".$rs["title"]."</td>";  //标题
		echo "<td>".course_list($rs["item_id"])."</td>";  //内容
		echo "<td>
		<a href='?act=view&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-user'></span> 查看人员</a>
		
		<a href='count_user_phone".$adminuser.".php?pid=".$rs["item_id"]."' target='_blank'><span class='glyphicon glyphicon-phone'></span> 用户手机列表</a>

		<a href='count_user_from.php?pid=".$rs["item_id"]."' target='_blank'><span class='glyphicon glyphicon-send'></span>用户来源分析</a>
		<br>
		<a href='?act=edita&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-pencil'></span> 编辑项目</a>
		<a href='javascript:void(0)' onClick='confirmLink(".$rs["item_id"].")'><span class='glyphicon glyphicon-trash'></span> 删除项目</a><br>

		<a href='count_course_buy.php?pid=".$rs["item_id"]."' target='_blank'><span class='glyphicon glyphicon-calendar'></span> 课程统计</a>
		<a href='?act=vcount&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-gift'></span> 奖励统计</a>  
		<a href='set_prize.php?pid=".$rs["item_id"]."' target='_blank'><span class='glyphicon glyphicon-cog' ></span>兑奖设置</a><br>

		<a href='?act=qrcode_op&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-link'></span> 操作员入口</a>
		<a href='?act=wx_kefu&menuid=$menuid&pid=".$rs["item_id"]."'><span class='glyphicon glyphicon-leaf'></span> 微信客服管理</a>
		<br>
		<a href='https://m.51zbk.vip/agreen-h5/html/teacher/agntool_swar_room_video.html?channel=".$rs["course_id"]."011' target='_blank' class='rtc_one_".$rs["item_id"]."'><span class='glyphicon glyphicon-transfer'></span>私聊一对一入口</a><br>
		</td>"; 
		echo "</tr>";
	
	}
	
	?>


	</table>
	<script>
		function addCourse(itemId){
			var c= $("#item"+itemId+" input").val();
			if (!c) return;
			//alert("?menuid=<?php echo $menuid;?>&act=addcourse&item="+itemId+"&c="+c);
			window.location.href = "?menuid=<?php echo $menuid;?>&act=addcourse&item="+itemId+"&c="+c;
		}
		function removeCourse(courseId){
			if(window.confirm("你确认删除该课程,删除后不能恢复！")){
				window.location.href = "?menuid=<?php echo $menuid;?>&act=delcourse&courseid="+courseId;
			}
			
		}
	</script>

<?php }?>

<?php if($action=="delcourse"){
	$courseId = $_GET["courseid"]+0;
	$lnk -> query("delete from item_class where class_id = $courseId");
	go("?menuid=$menuid");
	exit;
}?>

<?php if($action=="addcourse"){
	$c = $_GET["c"];
	$itemId = $_GET["item"]+0;
	//如果有相同的课程存在，直接返回列表
	$result = $lnk -> query("select * from item_class where item_id='$itemId' and class_name='$c'");
	while ($rs=mysqli_fetch_assoc($result)){
		go("?menuid=$menuid");
		exit;
	}
	$lnk -> query("insert into item_class(item_id,class_name)values('$itemId','$c')");
	go("?menuid=$menuid");
	exit;

}?>


<?php if($action=="wx_kefu_add"){?>
	<form name="myform" id="wx_kf_add_form" method="post" action="?act=wx_kf_add_data&menuid=<?php echo $menuid?>&pid=<?php echo $pid?>">
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
			<tr>
				<td height=18 colspan="2" class=td><strong>客服</strong> 数据添加</td>
			</tr>
			<tr>
				<td width="18%" height=25>客服维信二维码*</td>
				<td width="82%"><input name='wx_code' type='text' id='wx_code' value=''>
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=wx_code&uppath=wx_code&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>客服手机号码*</td>
				<td width="82%"><input name="phone" type="text" id="phone" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>客服一轮显示次数*</td>
				<td width="82%"><input name="count" type="text" id="count" size="10"> 次</td>
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

<?php  } ?>
<?php if($action=="addnew"){?>
	<form name="myform" id="item_add_form" method="post" action="?act=addnewdata&menuid=<?php echo $menuid?>">
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
			<tr>
				<td height=18 colspan="2" class=td><strong><?php echo getIdTitle($menuid)?></strong> 数据添加</td>
			</tr>
			<tr id="logo_load">
				<td width="18%" height=25>logo标识*</td>
				<td width="82%"><input name='logo' type='text' id='logo' v-model="uploadimg"  value=''  style="width:1px;height:1px;font-size:1px;">
					<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=logo&uppath=logo&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
					<div id="logo_img"></div>
				</td>
			</tr>
			<tr>
			<td width="18%" height=25>项目标题*</td>
			<td width="82%"><input name="title" type="text" id="title" size="40"></td>
			</tr>
			<tr>
			<td width="18%" height=25>宣传内容*</td>
			<td width="82%">
				<textarea name='content'  id='content'  style='width:100%;height:300px;'></textarea>
				<script> var data_content = UE.getEditor('content');</script></td>
			</tr>
			
			<tr>
				<td width="18%" height=25>绑定课程id*</td>
				<td width="82%"><input name="course_id" type="text" id="course_id" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>家校通 mp_id*</td>
				<td width="82%"><input name="mp_id" type="text" id="mp_id" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>站点类型 1 正式站 0 测试站*</td>
				<td width="82%"><input name="site" type="text" id="site" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>一对一房间数量*</td>
				<td width="82%"><input name="room_num" type="text" id="room_num" size="40" value="0"></td>
			</tr>
			<tr>
			<td width="18%" height=25>需要转发数量*</td>
			<td width="82%"><input name="target_num" type="text" id="target_num" size="40"></td>
			</tr>
			<tr>
				<td width="18%" height=25>需要下级最少数量单位(B级)*</td>
				<td width="82%"><input name="userb_need_num" type="text" id="userb_need_num" size="40" value="10"></td>
			</tr>
			<tr>
				<td width="18%" height=25>需要下下级最少数量单位(C级)*</td>
				<td width="82%"><input name="userc_need_num" type="text" id="userc_need_num" size="40" value="10"></td>
			</tr>
			<tr>
				<td width="18%" height=25>需要开红包最少数量*</td>
				<td width="82%"><input name="liveroom_redpack_need" type="text" id="liveroom_redpack_need" size="40" value="10"></td>
			</tr>
			<tr>
				<td width="18%" height=25>宣传奖总数*</td>
				<td width="82%"><input name="publicity_award" type="text" id="publicity_award" size="40" value="10000"></td>
			</tr>
			<tr>
				<td width="18%" height=25>兼职淘汰弹窗时间*</td>
				<td width="82%"><input name='partjob_endtime' id='partjob_endtime' type='text'  value='<?php echo date("Y-m-d h:i:s")?>' size='40' readonly>
					<script>
						jQuery(function () {
				            // 时间设置
				            jQuery('#partjob_endtime').datetimepicker({
				                timeFormat: "HH:mm:ss",
				                dateFormat: "yy-mm-dd",
				            });

				        });
					</script>
				</td>
			</tr>
			<tr>
				<td width="18%" height=25>兼职淘汰兑奖单位（少于）*</td>
				<td width="82%"><input name="partjob_finshnum" type="text" id="partjob_finshnum" size="40" value="1"></td>
			</tr>
			<tr>
				<td width="18%" height=25>直播间红包小于等于不显示*</td>
				<td width="82%"><input name="minimum_red_packet" type="text" id="minimum_red_packet" size="40" value="1">（单位：分 微信是按分的整数计算）</td>
			</tr>
			<tr>
				<td width="18%" height=25>底薪奖励*</td>
				<td width="82%"><input name="top3_need" type="text" id="top3_need" size="40" value="10"></td>
			</tr>

			<tr>
				<td width="18%" height=25>活动名称*</td>
				<td width="82%"><input name="activities_name" type="text" id="activities_name" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>现金兑换奖金倍数*</td>
				<td width="82%"><input name="activities_multiple_scholarship" type="text" id="activities_multiple_scholarship" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>购课优惠券折数*</td>
				<td width="82%"><input name="activities_multiple_coupons" type="text" id="activities_multiple_coupons" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>学校名称*</td>
				<td width="82%"><input name="activities_school" type="text" id="activities_school" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>活动时间*</td>
				<td width="82%"><input name="activities_time" type="text" id="activities_time" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>活动领奖地点*</td>
				<td width="82%"><input name="activities_address" type="text" id="activities_address" size="40" value=""></td>
			</tr>
			<tr>
				<td width="18%" height=25>线上兑奖客服微信号*</td>
				<td width="82%"><input name="wx_kf_wxid" type="text" id="wx_kf_wxid" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>下下级提成率*</td>
				<td width="82%"><input name="rate_userc" type="text" id="rate_userc" size="40" value=""></td>
			</tr>
			<tr>
				<td width="18%" height=25>宣传奖倍率*</td>
				<td width="82%"><input name="num_card" type="text" id="num_card" size="40" value="5"></td>
			</tr>

			<tr>
				<td width="18%" height=25>带看奖倍率*</td>
				<td width="82%"><input name="num_take" type="text" id="num_take" size="40" value="5"></td>
			</tr>

			<tr>
				<td width="18%" height=25>互动奖倍率*</td>
				<td width="82%"><input name="num_interact" type="text" id="num_interact" size="40" value="5"></td>
			</tr>
	
			<tr>
				<td width="18%" height=25>到场奖倍率*</td>
				<td width="82%"><input name="num_spot" type="text" id="num_spot" size="40" value="5"></td>
			</tr>

			<tr>
				<td width="18%" height=25>成交奖倍率(线下)*</td>
				<td width="82%"><input name="num_deal" type="text" id="num_deal" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>成交奖倍率(线上)*</td>
				<td width="82%"><input name="num_online" type="text" id="num_online" size="40" value=""></td>
			</tr>

			<tr>
				<td width="18%" height=25>成交奖倍率(线上＋线下)*</td>
				<td width="82%"><input name="num_deal_online" type="text" id="num_deal_online" size="40" value=""></td>
			</tr>


			<tr>
				<td width="18%" height=25>项目截止日期*</td>
				<td width="82%"><input name='close_item' id='close_item' type='text'  value='<?php echo date("Y-m-d")?>' size='40' readonly><script>$('#close_item').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					minView: 'month',
					maxView: 'decade',
					todayBtn: true,
					pickerPosition: 'bottom-left'
					})</script>
				</td>
			</tr>

			<tr>
				<td width="18%" height=25>观看直播开始日期*</td>
				<td width="82%"><input name='video_start_time' id='video_start_time' type='text'  value='<?php echo date("Y-m-d")?>' size='40' readonly><script>$('#video_start_time').datepicker({
					format: 'yyyy-mm-dd',
					autoclose: true,
					minView: 'month',
					maxView: 'decade',
					todayBtn: true,
					pickerPosition: 'bottom-left'
					})</script>
				</td>
			</tr>


			
			<tr>
			<td height=25 colspan="2"> <label>
			<input type="button" name="Submit" value=" 保存添加 " id="submit_add" class="btn btn-success" >
			<script>
			$("#submit_add").click(function(e){
				$("#item_add_form").submit();
				$("#submit_add").attr("disabled","disabled");
			});
			</script>
			</label></td>
			</tr>
			<tr ><td colspan="2"><br><br><br><br><br></td></tr>
		</table>
	</form>
	<script>

		
		setInterval(function(){
				var img_path= $("#logo").val();
				var img_arr = img_path.split("|");
				var imgs;
				for(var i=0;i<img_arr.length;i++){
					if(i==0){
						imgs="<img src='./temp/"+img_arr[i]+"' height='80px' class='img_list'>";
					}else{
						imgs+="<img src='./temp/"+img_arr[i]+"' height='80px' class='img_list'>";
					}
				}
				if(img_path)
					$("#logo_img").html(imgs);
		},1000);
		
		$(document).on("click",".img_list",function(){
			var n=$(this).index();
			var img_path= $("#logo").val();
			var img_arr = img_path.split("|");
			img_arr.splice(n,1);
			$("#logo").val(img_arr.join("|"));
			$(this).remove();
			//alert(n);
		});
	</script>
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
					<td width="82%"><input name='logo' type='text' id='logo' value='<?php echo $rs_edit["logo"]?>'  style="width:1px;height:1px;font-size:1px;">
						<input type='button' name='Submit11' value='上传' onClick="window.open('./upload.php?formname=myform&editname=logo&uppath=logo&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')">
						<div id="logo_img"></div>	
					</td>
				</tr>
				<tr>
				<td width="18%" height=25>项目标题*</td>
				<td width="82%"><input name="title" type="text" id="title" size="40" value="<?php echo $rs_edit["title"]?>"></td>
				</tr>
				<tr>
				<td width="18%" height=25>宣传内容*</td>
				<td width="82%"><?php 
				//$contentarea = $CKEditor->editor("content", $rs_edit['content']); //生成一个以name为content的textarea  
				//echo $contentarea; 
				?><textarea name='content'  id='content'   style='width:100%;height:300px;'><?php echo $rs_edit["content"]?></textarea>
				<script> var data_content = UE.getEditor('content');</script></td>
				</tr>
				<tr>
					<td width="18%" height=25>绑定课程id*</td>
					<td width="82%"><input name="course_id" type="text" id="course_id" size="40" value="<?php echo $rs_edit["course_id"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>家校通 mp_id*</td>
					<td width="82%"><input name="mp_id" type="text" id="mp_id" size="40" value="<?php echo $rs_edit["mp_id"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>站点类型 1 正式站 0 测试站*</td>
					<td width="82%"><input name="site" type="text" id="site" size="40" value="<?php echo $rs_edit["site"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>一对一房间数量*</td>
					<td width="82%"><input name="room_num" type="text" id="room_num" size="40" value="<?php echo $rs_edit["room_num"]?>"></td>
				</tr>
				<tr>
				<td width="18%" height=25>需要转发数量*</td>
				<td width="82%"><input name="target_num" type="text" id="target_num" size="40" value="<?php echo $rs_edit["target_num"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>需要下级最少数量单位(B级)*</td>
					<td width="82%"><input name="userb_need_num" type="text" id="userb_need_num" size="40" value="<?php echo $rs_edit["userb_need_num"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>需要下下级最少数量单位(C级)*</td>
					<td width="82%"><input name="userc_need_num" type="text" id="userc_need_num" size="40" value="<?php echo $rs_edit["userc_need_num"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>需要开红包最少数量*</td>
					<td width="82%"><input name="liveroom_redpack_need" type="text" id="liveroom_redpack_need" size="40" value="<?php echo $rs_edit["liveroom_redpack_need"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>宣传奖总数*</td>
					<td width="82%"><input name="publicity_award" type="text" id="publicity_award" size="40" value="<?php echo $rs_edit["publicity_award"];?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>兼职淘汰弹窗时间*</td>
					<td width="82%"><input name='partjob_endtime' id='partjob_endtime' type='text'  value='<?php echo  date("Y-m-d H:i:s",$rs_edit["partjob_endtime"])?>' size='40' readonly>
						<script>
							jQuery(function () {
					            // 时间设置
					            jQuery('#partjob_endtime').datetimepicker({
					                timeFormat: "HH:mm:ss",
					                dateFormat: "yy-mm-dd"
					            });

					        });
						</script>
					</td>
				</tr>
				<tr>
					<td width="18%" height=25>兼职淘汰兑奖单位（少于）*</td>
					<td width="82%"><input name="partjob_finshnum" type="text" id="partjob_finshnum" size="40" value="<?php echo $rs_edit["partjob_finshnum"]?>"></td>
				</tr>
				<tr>
					<td width="18%" height=25>直播间红包小于等于不显示*</td>
					<td width="82%"><input name="minimum_red_packet" type="text" id="minimum_red_packet" size="40" value="<?php echo $rs_edit["minimum_red_packet"]?>">（单位：分 微信是按分的整数计算）</td>
				</tr>
	

				<tr>
				<td width="18%" height=25>底薪奖励*</td>
				<td width="82%"><input name="top3_need" type="text" id="top3_need" size="40" value="<?php echo $rs_edit["top3_need"]?>"></td>
				</tr>


				<tr>
				<td width="18%" height=25>孙级用户提成率*</td>
				<td width="82%"><input name="rate_userc" type="text" id="rate_userc" size="40" value="<?php echo $rs_edit["rate_userc"]?>"></td>
				</tr>


				<tr>
					<td width="18%" height=25>活动名称*</td>
					<td width="82%"><input name="activities_name" type="text" id="activities_name" size="40" value="<?php echo $rs_edit["activities_name"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>现金兑换奖金倍数*</td>
					<td width="82%"><input name="activities_multiple_scholarship" type="text" id="activities_multiple_scholarship" size="40" value="<?php echo $rs_edit["activities_multiple_scholarship"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>购课优惠券折数*</td>
					<td width="82%"><input name="activities_multiple_coupons" type="text" id="activities_multiple_coupons" size="40" value="<?php echo $rs_edit["activities_multiple_coupons"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>学校名称*</td>
					<td width="82%"><input name="activities_school" type="text" id="activities_school" size="40" value="<?php echo $rs_edit["activities_school"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>活动时间*</td>
					<td width="82%"><input name="activities_time" type="text" id="activities_time" size="40" value="<?php echo $rs_edit["activities_time"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>活动领奖地点*</td>
					<td width="82%"><input name="activities_address" type="text" id="activities_address" size="40" value="<?php echo $rs_edit["activities_address"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>线上兑奖客服微信号*</td>
					<td width="82%"><input name="wx_kf_wxid" type="text" id="wx_kf_wxid" size="40" value="<?php echo $rs_edit["wx_kf_wxid"]?>"></td>
				</tr>

		
				<tr>
					<td width="18%" height=25>宣传奖倍率*</td>
					<td width="82%"><input name="num_card" type="text" id="num_card" size="40" value="<?php echo $rs_edit["num_card"]?>"></td>
				</tr>
		
				<tr>
					<td width="18%" height=25>带看奖倍率*</td>
					<td width="82%"><input name="num_take" type="text" id="num_take" size="40" value="<?php echo $rs_edit["num_take"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>互动奖倍率*</td>
					<td width="82%"><input name="num_interact" type="text" id="num_interact" size="40" value="<?php echo $rs_edit["num_interact"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>到场奖倍率*</td>
					<td width="82%"><input name="num_spot" type="text" id="num_spot" size="40" value="<?php echo $rs_edit["num_spot"]?>"></td>
				</tr>
	
				<tr>
					<td width="18%" height=25>成交奖倍率(线下)*</td>
					<td width="82%"><input name="num_deal" type="text" id="num_deal" size="40" value="<?php echo $rs_edit["num_deal"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>成交奖倍率(线上)*</td>
					<td width="82%"><input name="num_online" type="text" id="num_online" size="40" value="<?php echo $rs_edit["num_online"]?>"></td>
				</tr>

				<tr>
					<td width="18%" height=25>成交奖倍率(线上＋线下)*</td>
					<td width="82%"><input name="num_deal_online" type="text" id="num_deal_online" size="40" value="<?php echo $rs_edit["num_deal_online"]?>"></td>
				</tr>


				<tr>
					<td width="18%" height=25>项目截止日期*</td>
					<td width="82%"><input name='close_item' id='close_item' type='text'  value='<?php echo  date("Y-m-d",$rs_edit["close_item"])?>' size='40' readonly><script>$('#close_item').datepicker({
						format: 'yyyy-mm-dd',
						autoclose: true,
						minView: 'month',
						maxView: 'decade',
						todayBtn: true,
						pickerPosition: 'bottom-left'
						})</script>
					</td>
				</tr>

				<tr>
					<td width="18%" height=25>观看直播开始日期*</td>
					<td width="82%"><input name='video_start_time' id='video_start_time' type='text'  value='<?php echo  date("Y-m-d",$rs_edit["video_start_time"])?>' size='40' readonly><script>$('#video_start_time').datepicker({
						format: 'yyyy-mm-dd',
						autoclose: true,
						minView: 'month',
						maxView: 'decade',
						todayBtn: true,
						pickerPosition: 'bottom-left'
						})</script>
					</td>
				</tr>
				

				<tr>
					<td height=25 colspan="2"> <label><input type="submit" name="Submit" value=" 保存编辑 " class="btn btn-success"></label>
					</td>
				</tr>
				<tr ><td colspan="2"><br><br><br><br><br></td></tr>
			</table>

			<script>
		
		setInterval(function(){
				var img_path= $("#logo").val();
				var img_arr = img_path.split("|");
				var imgs;
				for(var i=0;i<img_arr.length;i++){
					if(i==0){
						imgs="<img src='./temp/"+img_arr[i]+"' height='80px' class='img_list'>";
					}else{
						imgs+="<img src='./temp/"+img_arr[i]+"' height='80px' class='img_list'>";
					}
				}
				if(img_path)
					$("#logo_img").html(imgs);
		},1000);
		$(document).on("click",".img_list",function(){
			
			var yesOrNot = confirm('你确定要删除此图片吗？');
			if (yesOrNot) {
				var n=$(this).index();
				var img_path= $("#logo").val();
				var img_arr = img_path.split("|");
				img_arr.splice(n,1);
				$("#logo").val(img_arr.join("|"));
				$(this).remove();
				console.log('图片删除成功');
			}
			//alert(n);
		});
	</script>
		</form>
	<?php 
	}
}
?>

<?php if($action=="vcount" and $pid>0){?>

<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24"><strong>奖励统计：<?php echo date("Y-m-d H:i:s")?> 截止</strong> </td>
	</tr>
	<tr><td align="center">
		
		<div style="padding-top:25px;"><a href="?menuid=<?php echo $menuid;?>" class="btn btn-danger btn-lg">返回项目</a></div>
		
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
			
			<tr>
				<td class="text-center"><strong>兑换奖项</strong></td>
				<td class="text-center"><strong>已发放奖金</strong></td>
				<td class="text-center"><strong>未发放奖金</strong></td>
			</tr>
			<tr>
				<td class="text-center">宣传奖</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,1)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"card")?></td>
			</tr>
			<tr>
				<td class="text-center">带看奖</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,2)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"take")?></td>
			<tr>
				<td class="text-center">互动奖</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,3)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"interact")?></td>
			</tr>
			<tr>
				<td class="text-center">到场奖</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,4)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"spot")?></td>
			</tr>
			<tr>
				<td class="text-center">成交奖（线下）</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,5)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"deal")?></td>
			</tr>
			<tr>
				<td class="text-center">成交奖(线上)</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,6)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"online")?></td>
			</tr>
			<tr>
				<td class="text-center">成交奖(线上＋线下)</td>
				<td class="text-center"><?php echo count_spread_user_operate($pid,7)?></td>
				<td class="text-center"><?php echo count_spread_user_cash($pid,"deal_online")?></td>
			</tr>
		</table>

	</td></tr>


	</table>

<?php } ?>
<?php if($action=="qrcode_op" and $pid>0){
  $domain =  "https://".$_SERVER['SERVER_NAME']."/";
  $op_url =  strpos("vip".$weburl."vip","dev") ?  $domain."dev/index.html?item=".$pid : $domain."index.html?item=".$pid ;
  //$qrcode = qrcode($op_url);

?>

<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
	

			<tr>
				<td  style="text-align: center">
					<br>
					<h3 >扫码成为系统操作员</h3>
					<div style='color:#ccc;'>*系统操作员：手机操作后可以结算奖励。</div>
					<div>
						<?php 
						echo "<img src='temp/".qrcode($op_url)."' width='200' height='200'>"; 
						?>
					</div>
				</td>
			</tr>
	</table>


<?php } ?>

<?php if($action=="wx_kefu" and $pid>0){?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24">公众号客服管理 <a href="<?php echo "?act=wx_kefu_add&menuid=$menuid&pid=$pid";?>" style="font-size:16px;color:#f39;display:none">添加新客服</a></td>
	</tr>
	</table>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
		<tr>
		<td width="5%"><strong>ID</strong></td>
		<td width="35%"><strong>客服微信二维码</strong></td>
		<td width="30%"><strong>客服手机号</strong></td>
		<td width="10%"><strong>客服一轮显示次数</strong></td>
		<td width="20%"><strong>操作</strong></td>
		</tr>
		<?php 
			$result = $lnk -> query("select * from spread_item_kefu where item_id = $pid");
			while ($rs=mysqli_fetch_assoc($result)){?>
			<tr>
				<td><?php echo $rs["id"];?></td>
				<td><img src="temp/<?php echo $rs["wx_code"];?>" style="width:80px;height:80px;"></td>
				<td><?php echo $rs["phone"];?></td>
				<td><input value="<?php echo get_count_item_kefu_count($rs["id"]);?>" style="border:0px;" onblur="change_count_num(this,<?php echo $rs["id"];?>)"></td>
				<td>
					<a href='javascript:void(0)' onClick='confirm_wx_kf(<?php echo $pid .",".$rs["id"]?>)'><span class='glyphicon glyphicon-remove'></span> 删除</a><br>
				</td>
				
				
			</tr>

			<?php }?>
			<tr>
				<td colspan="5" style="text-align: center">
					<h3 >扫码成为系统客服</h3>
					<div style='color:#ccc;'>*系统客服：在用户上随机显示客服电话和手机号</div>
					<div>
						<?php 
						$tkStr= base64_encode(json_encode(array("user"=>$_SESSION['uname_admin'],"pswd"=>$_SESSION['pswd'],"item_id"=>$pid,"date"=>time()))); //base64加密
						echo "<img src='temp/".qrcode(str_replace("admin/","",$weburl)."kf_add.php?tk=$tkStr")."' width='200' height='200'>"; 
						?>
					</div>
				</td>
			</tr>
	</table>
	<script>
		//提交AJAX至客服
		function change_count_num(obj,kf_id){
			var n=Number(obj.value);
			if(n<=0 || isNaN(n) || !kf_id){
				obj.value=1;
				n=1;
			}
			setTimeout(function(){
				if(window.confirm("改变客服显示次数为 "+n+",修改后不能撤回！")){
					window.location.href = "?menuid=<?php echo $menuid;?>&act=edit_kf_count&count="+n+"&kf_id="+kf_id+"&pid=<?php echo $pid;?>";
				}
			},100);	
		}
	</script>
<?php } ?>


<?php 
//客服修改出现次数
if($action=="edit_kf_count" and $pid>0){
	$count = $_GET["count"]+0;
	$kf_id = $_GET["kf_id"]+0;
	if(!$kf_id or !$count)
		return;
	$count_old = get_count_item_kefu_count($kf_id);
	if($count_old==$count){
		go("?menuid=$menuid&act=wx_kefu&pid=$pid");
		exit();
	}
	$n=$count_old-$count;
	if($count_old>$count){
		//减法
		$absN= abs($n);
		for($i=0;$i<$absN;$i++){
			$lnk->query("delete from spread_item_kefu_count where kf_id=$kf_id limit 1");
		}
	}else{
		//加法
		$absN= abs($n);
		$count=get_count_item_kefu_num($kf_id);
		for($i=0;$i<$absN;$i++){
			$lnk->query("insert into spread_item_kefu_count(item_id,kf_id,count)values('$pid','$kf_id','$count')");
		}
	}
	go("?menuid=$menuid&act=wx_kefu&pid=$pid");
	exit();

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
	<td width="10%"><strong>本人手机号</strong></td>
	<td width="7%"><strong>完成单位/下家邀请总数</strong></td>
	<td width="8%"><strong>下下家邀请总数</strong></td>
	<td width="10%"><strong>兑换码</strong></td>
	<td width="10%"><strong>祖级用户</strong></td>
	<td width="10%"><strong>父级用户</strong></td>
	<td width="10%"><strong>操作</strong></td>
	</tr>
	<?php 


	//数据列表
	$pagenum=5;
	$item_group = get_item_content($pid);  //项目信息
	$rate_userc = $item_group["rate_userc"];  //c用户提成率
	@$page=$_GET["page"]?$_GET["page"]:1; //当前页码
	$start=($page-1)*$pagenum; //起始数据记录
	$root_user_group = get_user_root($pid); //得到根用户

	$parent_id=get_item_parent_user($pid);

	$parentarr=array("count_userb"=>get_curuser_count_redeem($parent_id),"count_userc"=>get_count_redeem($parent_id)-get_curuser_count_redeem($parent_id) ); //得到当前数据 并更新当前用户邀请





	$result = $lnk -> query("select * from spread_user where item_id = $pid and openid<>''  order by parent_id=0 desc, count_userb desc,count_userc desc,count_card desc limit $start,$pagenum");
	while ($rs=mysqli_fetch_assoc($result)){
		get_count("card",$rs["user_id"],$pid);
		//write_code($rs["user_id"]);
		$nn=0;
		echo "<tr><td>".$rs["user_id"]."</td>";  //ID
		echo "<td>".$rs["phone"]."</td>";  //手机号
		echo "<td><span style='color:red'>".($rs["count_userb"]+0)."</span>/".get_curuser_count_redeem($rs["user_id"])." 次 [<span class='find_btn' user_id=".$rs["user_id"].">查看</span>]</td>";  //手机号
		echo "<td>".$rs["count_userc"]." 次 </td>";  //手机号
		echo "<td>".$rs["redeem_code"]."</td>";  //兑换码
		$parent_arr=get_user_content($rs["parent_id"],$rs["item_id"]);
		$father_user= $rs["parent_id"]." [  ".$parent_arr["redeem_code"]."  ]";
		$root_id =0;
		if(in_array($rs["user_id"],$root_user_group)){
			$root_name="－－";
			$father_user= "<span style='color:red;'>二维码</span>";
		}else{
			$root_id = get_user_root_id($rs["user_id"],$pid);
			$root_arr=get_user_content($root_id,$rs["item_id"]);
			$root_name = $root_id." [  ".$root_arr["redeem_code"]."  ]";
		}

		if(!$rs["parent_id"]){
			$root_name = "－－";
			$father_user = "－－";
		}

		if($root_id==$rs["parent_id"]){
			$root_name = "<span style='color:red;'>二维码</span>";
		}

		


		echo "<td>$root_name</td>";  //祖级用户
		echo "<td>$father_user</td>";  //父级用户
		
		$key = ($rs["phone"]>0) ? $rs["phone"] : $rs["user_id"];
		echo "<td>
		<a href='?act=search&menuid=$menuid&pid=$pid&page=$page&key=$key'><span class='glyphicon glyphicon-user'></span> 查看详情</a><br>
		</td>"; 
		echo "</tr>";
	
	}
	?>


	<tr><Td colspan="9" align="center">一共邀请开卡<span style="color:red; font-weight: bold; font-size:16px;"><?php echo get_count_item_user($pid)-1 ;?></span>位用户 (其中：A级用户数：<span style="color:red; font-weight: bold; font-size:16px;"><?php echo $parentarr["count_userb"]?></span> 人, B级用户数：<span style="color:red; font-weight: bold; font-size:16px;"><?php 
		//b减30%给c  
		$c_count_ceil = intval($parentarr["count_userc"]*0.3);
	echo $parentarr["count_userc"]-$c_count_ceil;?></span> 人, C级及C级以下用户数：<span style="color:red; font-weight: bold; font-size:16px;"><?php echo get_count_item_user($pid)-1 -$parentarr["count_userb"] -$parentarr["count_userc"]+$c_count_ceil;?></span> 人 到场统计：<span style="color:red; font-weight: bold; font-size:16px;"><?php echo count_type_all($item_group["item_id"],"get_spot");?></span> 人  线下课成交统计：<span style="color:red; font-weight: bold; font-size:16px;"><?php echo count_type_all($item_group["item_id"],"get_deal");?></span> 人


</td></tr>
	
	<tr><td colspan="9">

  <?php  
					  @$url="?menuid=$menuid&act=view&pid=$pid";	   
					  
					  $att2= $lnk->query("select * from spread_user where item_id = $pid and openid<>''");
					  while($rss2=mysqli_fetch_assoc($att2)){$counts[]=$rss2;}
					  
					 @$count=count($counts);
					 $maxpage=ceil($count/$pagenum); 
					 
					 $uppage=$page<=1?1:$page-1;
					 $downpage=$page>=$maxpage?$maxpage:$page+1;
					  ?>
					  
					 
                        <div class=" col-xs-12 text-center marginbottom30" style="margin-top:15px;margin-bottom: 15px;">
                        	<span>共<span style="color:red;"><?php echo $page;?></span>/<?php echo $maxpage;?>页</span>
                            <a href="<?php echo $url."&page=1"?>" class=" pro10">&lt;&lt;首页</a>
                            <a href="<?php echo $url."&page=$uppage"?>" class=" pro10">&lt;上页</a>
                            
                            <?php for($i=1;$i<=$maxpage;$i++){
                            		if($i>=$page-5 and $i<=$page+5){
                            	?>
                            <a href="<?php echo $url."&page=$i"?>" <?php echo $page==$i? "style='color:red'":""; ?>><?php echo $i?></a>
                            <?php } }?>
                            <a href="<?php echo $url."&page=$downpage"?>" class=" pro10">下页&gt;</a>
                            <a href="<?php echo $url."&page=$maxpage"?>" class=" pro10">尾页&gt;&gt;</a>
                            <span>跳到<input type="text" style="width:40px;height:30px;font-size: 14px;line-height: 30px;" id="jumppage">页 <button id="jumpbtn">跳转</button></span>
                            <script>
                            	$("#jumpbtn").click(function(){
                            		var v=parseInt($("#jumppage").val());
                            		if (!v)
                            			return;
                            		var maxpage=<?php echo $maxpage?>;
                            		if(v<1)
                            			v=1;
                            		if(v>maxpage)
                            			v=maxpage;
                            		window.location.href='<?php echo $url."&page="?>'+ v;
                            	})
                            </script>
                       </div>
</td></tr>
<tr><td>&nbsp;</td></tr>



	</table>
<?php } ?>

                       </div>

<?php if($action=="search" and $pid>0){
	$key = trim($_GET["key"]);
	@$keyid = trim($_GET["keyid"])+0;
	if(!$key and $keyid){
		$key = $keyid;
	}
	if($key){
		$arr= get_user_key_content($key,$pid);
		if(!$arr){
			alert("没有查到您要地数据，请确认！");
			go("?act=view&menuid=$menuid&pid=$pid");
			exit();
		}
		//print_r($arr);
		if(count($arr)<=1){
			$user_id = $arr[0]["user_id"];
			$target_num = get_target_num($arr[0]["item_id"])+0; //需要分享的次数

			if($arr[0]["parent_id"]==0){
				$qrcode=$arr[0]["qrcode"];
			}

			$count_card=get_count("card",$user_id,$pid); //得到当前数据 并更新当前用户邀请
			$count_take=get_count("take",$user_id,$pid); //得到当前数据 并更新当前用户带看
			$count_interact=get_count("interact",$user_id,$pid); //得到当前数据 并更新当前用户带看
			$count_spot=get_count("spot",$user_id,$pid); //得到当前数据 并更新当前用户带看
			$count_deal=get_count("deal",$user_id,$pid); //得到当前数据 并更新当前用户带看
			$count_online=get_count("online",$user_id,$pid); //得到当前数据 并更新当前用户带看
			$count_deal_online=get_count("deal_online",$user_id,$pid); //得到当前数据 并更新当前用户带看
			if(!$count_card["count_cash_all"]["cash"]){
				$count_take["count_cash_all"]["cash"]      = 0;
				$count_interact["count_cash_all"]["cash"]  = 0;
				$count_spot["count_cash_all"]["cash"]      = 0;
			}
		}else{
			$data="";
			for($i=0;$i<count($arr);$i++){
				//$user_id = $arr[$i]["user_id"];
				$data.="<a href='?key=".$arr[$i]["redeem_code"]."&act=search&menuid=$menuid&pid=$pid'> ".$arr[$i]["redeem_code"]."(".$arr[$i]["redeem_count_bc"].") </a> &nbsp; ";
			}
			echo "<script>swal({title : \"<div style='font-size:18px;'>查出有多个重复手机号,点击以下数据兑换(括号中为下级用户统计)</div><div>$data</div>\",html:true});</script>";
			exit;
		}

	

	?>
	<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
	<tr><td class="text-center font24"><strong>查询结果</strong> </td>
	</tr>
	<tr><td align="center">
		
		<div style="padding-top:25px;"><a href="?act=view&menuid=<?php echo $menuid;?>&pid=<?php echo $pid;?>&page=<?php echo @$_GET["page"]?$_GET["page"]:1; //当前页码?>" class="btn btn-danger btn-lg">返回列表</a></div>
		<?php if(!$arr[0]["parent_id"]){
			$weburl = str_replace("admin/","",strtolower($weburl));
			$zz_qrcode=qrcode($weburl."dshow.php?u=".$arr[0]["user_id"]);
			//echo $zz_qrcode;
			//$upload_qrcode=qrcode($weburl."wxqrcode.php?u=".$arr[0]["user_id"]);
			?>
		<div style="padding-bottom:35px;"><img src="temp/<?php echo $zz_qrcode;?>" width="200" height="200" id="f_code"><h3>首发二维码</h3></div>
		<?php /*<script>
			//加载首发二维码
				$.ajax({
					url:"item.php?act=get_qrcode&menuid=<?php echo $menuid;?>&pid=<?php echo $pid;?>&u=<?php echo  $arr[0]['user_id'];?>",
					type:"get",
					success:function(data){
						$("#f_code").attr("src","temp/"+data.split("|")[1]);
					}
				})
			
		</script>*/?>
		<div style="padding:25px;"></div>
		<?php /*
		<div style="padding:10px 0px;"><img src="<?php echo "temp/".$upload_qrcode;?>" width="200" height="200"></div>
		<div style="padding:5px 0px;">
			<h3>扫码成为个人客服</h3>
			<div style="color:#666">*个人客服：下家用户显示您的二维码和电话！</div>
		</div>*/?>
		<?php }else{?>
		<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
			
			<tr>
				<td class="text-center"><strong>兑换奖项</strong></td>
				<td class="text-center"><strong>下家转发并打开</strong></td>
				<td class="text-center"><strong>下下家转发并打开</strong></td>
				<td class="text-center"><strong> 金额 </strong></td>
				<td class="text-center"><strong>时间</strong></td>
				<td class="text-center"><strong>操作员</strong></td>
				<td class="text-center"><strong>操作员备注</strong></td>
			</tr>
			<tr>
				<td class="text-center">宣传奖</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_card["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_card["count_userc"];?></td>
				<td class="text-center"><?php echo $count_card["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_card["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_card["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_card["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_card["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_card["cashinfo"]["operate_note"]?></td>
			</tr>
			<?php /*
			<tr>
				<td class="text-center">带看奖</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_take["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_take["count_userc"];?></td>
				<td class="text-center"><?php echo $count_take["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_take["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_take["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_take["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_take["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_take["cashinfo"]["operate_note"]?></td>
			</tr>
			<tr>
				<td class="text-center">互动奖</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_interact["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_interact["count_userc"];?></td>
				<td class="text-center"><?php echo $count_interact["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_interact["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_interact["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_interact["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_interact["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_interact["cashinfo"]["operate_note"]?></td>
			</tr>
			<tr>
				<td class="text-center">到场奖</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_spot["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_spot["count_userc"];?></td>
				<td class="text-center"><?php echo $count_spot["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_spot["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_spot["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_spot["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_spot["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_spot["cashinfo"]["operate_note"]?></td>
			</tr>*/?>
			<tr>
				<td class="text-center">成交奖(线下)</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_deal["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_deal["count_userc"];?></td>
				<td class="text-center"><?php echo $count_deal["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_deal["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_deal["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_deal["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_deal["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_deal["cashinfo"]["operate_note"]?></td>
			</tr>
			<?php /*
			<tr>
				<td class="text-center">成交奖(线上)</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_online["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_online["count_userc"];?></td>
				<td class="text-center"><?php echo $count_online["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_online["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_online["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_online["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_online["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_online["cashinfo"]["operate_note"]?></td>
			</tr>
			<tr>
				<td class="text-center">成交奖(线上＋线下)</td>
				<td class="text-center"><?php 
				$n=0;
				foreach ($count_deal_online["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center"><?php echo $count_deal_online["count_userc"];?></td>
				<td class="text-center"><?php echo $count_deal_online["count_cash_all"]["status"]=="已兑奖"? "<span style='color:red'>[已兑奖] </span>" :"";echo  $count_deal_online["count_cash_all"]["cash"]."元";?></td>
				<td class="text-center"><?php echo $count_deal_online["cashinfo"]["operate_date"] == "-" ? "-" : date("Y-m-d H:i:s",$count_deal_online["cashinfo"]["operate_date"]);?></td>
				<td class="text-center"><?php echo $count_deal_online["cashinfo"]["operator"]?></td>
				<td class="text-center"><?php echo $count_deal_online["cashinfo"]["operate_note"]?></td>
			</tr>*/?>

		</table>

		<div style="padding:25px;">兑换码</div>
		<div style=" font-size:45px"><?php echo $arr[0]["redeem_code"]?></div>

		
		<?php }?>
		
		
	</td></tr>


	</table>
<?php 
	}else{
			alert("您什么都没填写，请核实！");
			go("?act=view&menuid=$menuid&pid=$pid");
			exit();
		}

} ?>


<?php

if($action=="wx_kf_add_data"){
	$wx_code = $_POST["wx_code"];
	$phone = $_POST["phone"];
	$count = $_POST["count"];
	if(!$wx_code or !$phone or !$pid or !$count>0){
		alert("请输入必填项目！");
		GoBack();
		exit();
		
	}else{
		$insert_result=$lnk -> query("insert into  spread_item_kefu(wx_code,phone,item_id,count)values('$wx_code','$phone','$pid','$count')") or die(mysql_error());
		$kf_id=mysqli_insert_id($lnk);
		for($i=0;$i<$count;$i++){
			$insert_result=$lnk -> query("insert into  spread_item_kefu_count(item_id,kf_id,count)values('$pid','$kf_id','0')") or die(mysql_error());
		}
		alert("您的数据已加入成功！");
		go("?menuid=$menuid&pid=$pid&act=wx_kefu");
		exit();
	}
}


//写入数据库
if($action=="addnewdata"){
$manage_id = $_SESSION['uname_admin'];
$title = $_POST["title"];
$logo = $_POST["logo"];
$content = $_POST["content"];
$course_id = $_POST["course_id"]+0;
$mp_id = $_POST["mp_id"]+0;
$site = $_POST["site"]+0;
$target_num = $_POST["target_num"]+0;
$rate_userc = $_POST["rate_userc"];
$userb_need_num = $_POST["userb_need_num"];
$userc_need_num = $_POST["userc_need_num"];
$liveroom_redpack_need = $_POST["liveroom_redpack_need"];
$publicity_award = $_POST["publicity_award"];
$minimum_red_packet = $_POST["minimum_red_packet"];
$top3_need = $_POST["top3_need"];
$room_num = $_POST["room_num"]+0;

$partjob_endtime = strtotime($_POST["partjob_endtime"]);
$partjob_finshnum = $_POST["partjob_finshnum"];

$close_item = strtotime($_POST["close_item"])+0;
$video_start_time = strtotime($_POST["video_start_time"])+0;
//中奖倍率
$num_card = $_POST["num_card"];
$num_take = $_POST["num_take"];
$num_interact = $_POST["num_interact"];
$num_spot = $_POST["num_spot"];
$num_deal = $_POST["num_deal"];
$num_online = $_POST["num_online"];
$num_deal_online = $_POST["num_deal_online"];

//页面文字参数
$activities_name = $_POST["activities_name"];
$activities_multiple_scholarship = $_POST["activities_multiple_scholarship"];
$activities_multiple_coupons = $_POST["activities_multiple_coupons"];
$activities_school = $_POST["activities_school"];
$activities_time = $_POST["activities_time"];
$activities_address = $_POST["activities_address"];
$wx_kf_wxid = $_POST["wx_kf_wxid"];



$reg_time = time();

if(!$title or !$content){
	alert("请输入必填项目！");
	GoBack();
	exit();
	
}else{
$insert_sql="insert into  spread_item(manage_id,title,logo,content,course_id,mp_id,site,code_img,target_num,rate_userc,userb_need_num,userc_need_num,liveroom_redpack_need,publicity_award,partjob_endtime,partjob_finshnum,minimum_red_packet,top3_need,room_num,reg_time,item_user,close_item,video_start_time,num_card,num_take,num_interact,num_spot,num_deal,num_online,num_deal_online,activities_name,activities_multiple_scholarship,activities_multiple_coupons,activities_school,activities_time,activities_address,wx_kf_wxid)values('$manage_id','$title','$logo','$content','$course_id','$mp_id','$site','','$target_num','$rate_userc','$userb_need_num','$userc_need_num','$liveroom_redpack_need','$publicity_award','$partjob_endtime','$partjob_finshnum','$minimum_red_packet','$top3_need','$room_num','$reg_time','$item_user','$close_item','$video_start_time','$num_card','$num_take','$num_interact','$num_spot','$num_deal','$num_online','$num_deal_online','$activities_name','$activities_multiple_scholarship','$activities_multiple_coupons','$activities_school','$activities_time','$activities_address','$wx_kf_wxid')";
//echo $insert_sql;
//exit();
$insert_result=$lnk -> query($insert_sql) or die(mysql_error());
$item_id=mysqli_insert_id($lnk);




$redeem_code = enid($open_time); //得到一个三十六进制的邀请码


//添加种子用户
$lnk -> query("insert into spread_user (parent_id,item_id,phone,open_time,openid,open_status,redeem_code) values ('0','$item_id','0','$reg_time','openid','1','$redeem_code')"); 
$user_id=mysqli_insert_id($lnk);
$weburl = str_replace("admin/","",strtolower($weburl));
$qrcode_url=qrcode($weburl."dshow.php?u=".$user_id);
//更新二维码
$result=$lnk->query("update  spread_user set qrcode='$qrcode_url'  where  user_id=$user_id");

alert("您的数据已加入成功！");
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
$target_num = $_POST["target_num"];
$rate_userc = $_POST["rate_userc"];
$userb_need_num = $_POST["userb_need_num"];
$userc_need_num = $_POST["userc_need_num"];
$liveroom_redpack_need = $_POST["liveroom_redpack_need"];
$publicity_award = $_POST["publicity_award"];
$minimum_red_packet = $_POST["minimum_red_packet"];
$top3_need = $_POST["top3_need"];
$room_num = $_POST["room_num"]+0;
$course_id = $_POST["course_id"]+0;
$mp_id = $_POST["mp_id"]+0;
$site = $_POST["site"]+0;

$partjob_endtime = strtotime($_POST["partjob_endtime"]);
$partjob_finshnum = $_POST["partjob_finshnum"];

$close_item = strtotime($_POST["close_item"])+0;
$video_start_time = strtotime($_POST["video_start_time"])+0;
//中奖倍率
$num_card = $_POST["num_card"];
$num_take = $_POST["num_take"];
$num_interact = $_POST["num_interact"];
$num_spot = $_POST["num_spot"];
$num_deal = $_POST["num_deal"];
$num_online = $_POST["num_online"];
$num_deal_online = $_POST["num_deal_online"];

//页面文字参数
$activities_name = $_POST["activities_name"];
$activities_multiple_scholarship = $_POST["activities_multiple_scholarship"];
$activities_multiple_coupons = $_POST["activities_multiple_coupons"];
$activities_school = $_POST["activities_school"];
$activities_time = $_POST["activities_time"];
$activities_address = $_POST["activities_address"];
$wx_kf_wxid = $_POST["wx_kf_wxid"];


if (!$title or !$content){ alert("请填写标题！");goback();}
else
{

$lnk -> query("update spread_item set title='$title',logo='$logo',content='$content',course_id='$course_id',mp_id='$mp_id',site='$site',rate_userc='$rate_userc',userb_need_num='$userb_need_num',userc_need_num='$userc_need_num',liveroom_redpack_need='$liveroom_redpack_need',publicity_award='$publicity_award',partjob_endtime='$partjob_endtime',partjob_finshnum='$partjob_finshnum',minimum_red_packet='$minimum_red_packet',top3_need='$top3_need',room_num='$room_num',target_num='$target_num',close_item='$close_item',video_start_time='$video_start_time',num_card='$num_card',num_take='$num_take',num_interact='$num_interact',num_spot='$num_spot',num_deal='$num_deal',num_online='$num_online',num_deal_online='$num_deal_online',activities_name='$activities_name',activities_multiple_scholarship='$activities_multiple_scholarship',activities_multiple_coupons='$activities_multiple_coupons',activities_school='$activities_school',activities_time='$activities_time',activities_address='$activities_address',wx_kf_wxid='$wx_kf_wxid' where item_id=$pid") or die(mysql_error());
alert("保存成功！");
go("?menuid=$menuid");
}
}
?>
<?php
if($action=="del" and $pid>0){
$lnk -> query("delete  from spread_item  where item_id=$pid");
alert("删除成功！");
go("?menuid=$menuid");
}

if($action=="del_wx_kf" and $pid>0 and $kf_id>0){
$lnk -> query("delete  from spread_item_kefu  where id=$kf_id");
$lnk -> query("delete  from spread_item_kefu_count  where kf_id=$kf_id");
alert("删除成功！");
go("?menuid=$menuid&act=wx_kefu&pid=$pid");
}

//通过用户id得到用户详情
function get_user_content($user_id,$item_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_user where item_id=$item_id and user_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs;}
}

//通过key得到用户详情
function get_user_key_content($key,$item_id){
	global $lnk;
	$data=array();
	if(strlen($key)>10)
		$sql="phone='$key'";
	elseif(strlen($key)>6 and  strlen(intval($key))<6)
		$sql="redeem_code='$key'"; 
	else
		$sql="user_id='$key'"; 
	$result=$lnk -> query("select * from spread_user where item_id=$item_id and $sql"); 
	while ($rs=mysqli_fetch_assoc($result)){$data[]=$rs;}
	return $data;
}

//我转发的数量
function get_curuser_count_redeem($user_id){
	global $lnk;
	$result=$lnk -> query("select count(0) from spread_user where openid<>'' and parent_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
}


//通过用户id得到已转发的数量
function get_count_redeem($user_id){
	global $lnk;

	$n=0;
	$result=$lnk -> query("select user_id from spread_user where openid<>'' and parent_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		$n++;
		$u_id = $rs["user_id"];
		$result2=$lnk -> query("select count(0) from spread_user where openid<>''  and parent_id='".$u_id."'"); 
		while ($rs2=mysqli_fetch_row($result2)){
			$n+=$rs2[0];
		}
	}
	return $n;
}
//得到下级详细列表统计
function get_count_redeem_nbc($user_id){
	global $lnk;
	$n=0;
	$b=0;
	$c=0;
	$d=0;
	$e=0;
	$result=$lnk -> query("select user_id from spread_user where openid<>'' and parent_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		$n++;
		$b++;
		$u_id = $rs["user_id"];
		//得到下级邀请数
		$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and parent_id='".$u_id."'"); 
		while ($rs2=mysqli_fetch_row($result2)){
			$n+=$rs2[0];
			$c+=$rs2[0];
		}
		
	}
	//得到下级到场人数  1 邀请 2 带看  3 互动  4到场 5 交易 
	//到场
	$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=4 and uid='".$user_id."'"); 
	while ($rs2=mysqli_fetch_row($result2)){
		$d=$rs2[0];
	}
	//交易
	$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=5 and uid='".$user_id."'"); 
	while ($rs2=mysqli_fetch_row($result2)){
		$e=$rs2[0];
	}

	//下级到场
	$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=4 and pid='".$user_id."'"); 
	while ($rs2=mysqli_fetch_row($result2)){
		$f=$rs2[0];
	}
	//下级交易
	$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=5 and pid='".$user_id."'"); 
	while ($rs2=mysqli_fetch_row($result2)){
		$g=$rs2[0];
	}

	return array("down_user_count"=>$n+0,"user_b_count"=>$b+0,"user_c_count"=>$c+0,"user_spot_count"=>$d+0,"user_deal_count"=>$e+0,"user_spot_down_count"=>$f+0,"user_deal_down_count"=>$g+0);
}


//通过用户id得到需要转发的数量
function get_target_num($item_id){
	global $lnk;
	$result=$lnk -> query("select target_num from spread_item where item_id=".$item_id); 
	while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
}

//生成二维码
function  qrcode($url){
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'./temp'.DIRECTORY_SEPARATOR; 
	$PNG_WEB_DIR = './temp/'; 
	$ecc = 'H'; // L-smallest, M, Q, H-best 
	$size = 10; // 1-50 
	$filename = $PNG_TEMP_DIR.'qrcode_'.time().'.png'; 
	QRcode::png($url, $filename, $ecc, $size, 2); 
	//chmod($filename, 0777); 
	return basename($filename); 
}

//通过项目id得到项目详情
function get_item_content($item_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_item where item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs;}
}

//通过项目id得到已转发数量
function get_count_item_user($item_id){
	global $lnk;
	$result=$lnk -> query("select count(0) from spread_user where openid<>'' and  item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
}

//通过项目id得到客服显示次数
function get_count_item_kefu_count($kf_id){
	global $lnk;
	$result=$lnk -> query("select count(0) from spread_item_kefu_count where kf_id='".$kf_id."'"); 
	while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
}
//通过项目id得到客服已轮到的显示次数
function get_count_item_kefu_num($kf_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_item_kefu_count where kf_id='".$kf_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs["count"]+0;}
}

//通过项目id得到种子用户
function get_item_parent_user($item_id){
	global $lnk;
	$result=$lnk -> query("select user_id from spread_user where  parent_id='0' and  item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs["user_id"]+0;}
}

//得到根用户组
function get_user_root($item_id){
	global $lnk;
	$result=$lnk -> query("select user_id from spread_user where  parent_id='0' and item_id='$item_id'"); 
	$i = 0;
	$root_id=0;
	while ($rs=mysqli_fetch_row($result)){
		$root_id= $rs[0]+0;
	}
	//找到根用户
	if($root_id>0){
		$result=$lnk -> query("select user_id from spread_user where open_status='1' and parent_id='$root_id'"); 
		$root_user_id=array();
		while ($rs=mysqli_fetch_assoc($result)){
			array_push($root_user_id,$rs["user_id"]);
		}
		return $root_user_id;
	}
}

//得到用户根级id
function get_user_root_id($parent_id,$item_id){
	global $lnk;
	$root_user_group = get_user_root($item_id);

	$result=$lnk -> query("select user_id,parent_id from spread_user where user_id='$parent_id'"); 
	while ($rs=mysqli_fetch_row($result)){
		if(!$rs[1])
		return "种子";
		if($root_user_group){
			//return $root_user_group[0];
			if(in_array($rs[1],$root_user_group)){
				$user_root_id = $rs[1];
			}else{
				$user_root_id = get_user_root_id($rs[1],$item_id);
			}	
		}else{
			$user_root_id = "";
		}
	}
	return $user_root_id;
}

//统计对应的已发放奖励  0 1 2 3 4 
function count_spread_user_operate($item_id,$operate_type="1"){
	global $lnk;
	$count=0;
	//echo "select sum(operate_cash) from spread_user_operate where item_id='$item_id'";
	$result=$lnk -> query("select sum(operate_cash) from spread_user_operate where  item_id='$item_id' and operate_type=$operate_type and operate_cash>0"); 
	while ($rs=mysqli_fetch_row($result)){
		$count+=($rs[0]+0);
		//echo $rs[0];
	}
	return $count;
}
//统计对应的未发放奖励  card ....
function count_spread_user_cash($item_id,$type="card"){
	global $lnk;
	$count=0;
	//echo "select sum(operate_cash) from spread_user_operate where item_id='$item_id'";
	$result=$lnk -> query("select count_$type,user_id from spread_user  where  item_id='$item_id' and parent_id>0 and open_status>0"); 
	while ($rs=mysqli_fetch_assoc($result)){

		$arr = get_count($type,$rs["user_id"],$item_id);
		if($arr["count_cash_all"]["status"]!="已兑奖")
			$count+= $arr["count_cash_all"]["cash"];
		//echo $rs[0];
	}
	return $count;
}


//统计 1 邀请 2 带看  3 互动  4到场 5 交易
function count_type_all($item_id,$type="get_spot"){
	global $lnk;
	$result2=$lnk -> query("select count(0) from spread_user where $type>0 and item_id='".$item_id."'"); 
	while ($rs2=mysqli_fetch_row($result2)){
		$f=$rs2[0];
	}
	return $f+0;
}


//查询是否领奖



//返回指定二维数组和  sum_array($query,3)
function sum_array($array,$num,$where=""){
	if(count($array)==0)
		return 0;
	foreach ($array as $key){
		if ($where){
			if($key[$num]==$where){$value+=$key[$num];}
		}
		else
		$value+=$key[$num]; 
	}
	return $value;
}

?>

<div id="msg_dialog">
	<ul>
		<li>
			<p class="mPhoneNumber">
				<span>下家手机号码 </span>
			</p>
			
			<p class="mRedeem_count_bc">
				<span>下下家打开次数</span>
			</p>
			<p class="mRedeem_code">
				<span>下家兑换码 </span>
			</p>
		</li>
		
	</ul>
	<div class="top_menu">
		<div class="close_btn"></div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$(".find_btn").css("cursor","pointer");
		
		$(".find_btn").unbind('click').bind('click',function(ev){
			var e = ev||event;
			$("#msg_dialog > ul >li:not(:first-child)").remove();
			$("#msg_dialog").css("display","block");
		 	var  user_id = $(this).attr("user_id");
		 	console.log(user_id);
			$.ajax({
				type:"post",
				url:"../api/cms_user_list.php",
				async:true,
				data:{
					"user_id":user_id
				},
				success:function(data){
					var msg = JSON.parse(data);
					//var fragment  = document.createDocumentFragment();
					console.info(msg);
					if (msg['code']==0) {
						for (var i=0;len = msg["data"].length,i<len;i++) {
							console.log(msg["data"][i]);
							var mList = $("#msg_dialog>ul>li").eq(0).clone(true,true);//克隆第一个作为模板文件
							mList.find(".mPhoneNumber").html(msg["data"][i]["phone"]);//手机号码
							mList.find(".mRedeem_count_bc").html(msg["data"][i]["count_c"]);//已发送并打开数量
							mList.find(".mRedeem_code").html(msg["data"][i]["redeem_code"]);//兑换码
							$("#msg_dialog > ul").append(mList[0]);
						}
					}
				},
				error:function(data){
					console.log(data);
				}
			});
			
			$(".close_btn").click(function(){
				$("#msg_dialog").css("display","none");
				$("#msg_dialog > ul >li:not(:first-child)").remove();
				console.log("删除所有元素");
			});
			return false;
		});
		
	});
</script>
</body>
</html>