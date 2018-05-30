<?php
ini_set('display_errors',1);            //错误信息  
ini_set('display_startup_errors',1);    //php启动错误信息  
error_reporting(-1);                    //打印出所有的 错误信息  
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); //将出错信息输出到一个文本文件 
include 'admin/config/config.php';
include "phpqrcode/qrlib.php";  // QRcode lib 
include "lib/code36.php";  // 自己写的一个三十六进制转换 
include "admin/function/comm.php";








$userGroup=array();     //用户信息
$itemGroup=array();     //项目信息
$count_card=array();    //当前用户开卡统计
$count_take=array();    //当前用户带看统计
$count_interact=array();//当前用户互动统计
$count_spot=array();    //当前用户到场统计
$count_deal=array();    //当前用户成交统计

$useragent = $_SERVER['HTTP_USER_AGENT'];
	// if (strpos($useragent, 'MicroMessenger') === false) {
	// 	alert("只支持微信访问！");
	// 	exit();
	// }
$nn=0;
//检测cookie 是否存在
function ck_cookies(){
	global $lnk;
	global $weburl;
	global $userGroup;
	global $itemGroup;
	global $count_card;
	global $count_take;
	global $count_interact;
	global $count_spot;
	global $count_deal;
	global $nn;
	@$parent_id=$_GET["u"]+0; //得到父级id
	if($parent_id)
		$item_id=get_item_id($parent_id)+0; //得到项目id
	else
		@$item_id=$_GET["i"]+0;  //当项目为第一个人访问时传入item_id

	//不存在
	if(!$item_id)  //如果用户不存在，则传入参数有问题
	{
		alert("抱歉，该用户所在的项目不存在！");
		exit();
	}


	//alert(ipcheck($item_id,3));
	//如果以前打开过
	if (isset($_COOKIE["user"]) && isset($_COOKIE["item"])){
		//存在
		$user = explode("|",$_COOKIE["user"]);
		$item = explode("|",$_COOKIE["item"]);
		//当前是否存在array里
		if(in_array($item_id,$item)){
			//存在项目内
			$n = array_search($item_id,$item);
			if($user[$n]!= $parent_id){
				go($weburl."dshow.php?u=".$user[$n]);
				//echo $user[$n]."||". $parent_id;
			}
			
			//得到项目内容
			$itemGroup = get_item_content($item_id);
			//得到当前用户信息
			$userGroup = get_user_content($user[$n]);
			//更新当前用户所在城市
			$get_ip_city = get_ip_city(getip());  //得到当前ip对应城市
			update_ip_city( $userGroup["user_id"],$get_ip_city); //更新当前用户城市
			//更新并得到当前数据
			$count_card=get_count("card",$user[$n]); //得到当前数据 并更新当前用户开卡
			$count_take=get_count("take",$user[$n]); //得到当前数据 并更新当前用户带看
			$count_interact=get_count("interact",$user[$n]); //得到当前数据 并更新当前用户带看
			$count_spot=get_count("spot",$user[$n]); //得到当前数据 并更新当前用户带看
			$count_deal=get_count("deal",$user[$n]); //得到当前数据 并更新当前用户带看

			//更新父级数据
			get_count("card",$userGroup["parent_id"]); //更新父级用户开卡
			get_count("take",$userGroup["parent_id"]); //更新当前用户带看
			get_count("interact",$userGroup["parent_id"]); //更新父级用户带看
			get_count("spot",$userGroup["parent_id"]); //更新当父级用户带看
			get_count("deal",$userGroup["parent_id"]); //更新父级用户带看
	

			/* 已用  get_count_card（得到当前数据 并更新） update_count_card 更新父级用户  代替
			$nn=0; 
			$redeem_count_nbc = get_count_redeem_nbc($user[$n]);
			$redeem_count_bc = $redeem_count_nbc["down_user_count"]+0;
			//更新当前用户的二级统计
			$lnk->query("update spread_user set open_status='1',redeem_count_bc='$redeem_count_bc'  where  user_id=".$user[$n]);
			//更新上级用户的二级统计
			
			$parent_up1 = get_user_content($user[$n]); //得到父级
			$parent_id_up1 = $parent_up1["parent_id"]; //得到父级id
			if($parent_id_up1){
				$nn=0;
				$redeem_count_bc_up1_nbc = get_count_redeem_nbc($parent_id_up1); //统计父级bc总量
				$redeem_count_bc_up1 = $redeem_count_bc_up1_nbc["down_user_count"]+0; //统计父级bc总量
				$lnk->query("update spread_user set redeem_count_bc='$redeem_count_bc_up1'  where  user_id=".$parent_id_up1);
			}
			*/
			

		}else{
			
			@$ck = $_GET["ck"];
			if(!$ck){
			//当在不同的项目中id也不同
				$userList = implode("|",$user);
				$itemList = implode("|",$item);
				insert_user_action($parent_id,$item_id,$itemList,$userList);
			}else{
				go($weburl."dshow.php?u=".$parent_id);
			}
		}
		return ;

	}else{	
		$userList="";
		$itemList="";
		insert_user_action($parent_id,$item_id,$itemList,$userList);
	}
}

function h5_show($name,$data){
	return "<script> var $name=". json_encode($data) ."</script>";
}


//写入cookies
function insert_user_action($parent_id,$item_id,$itemList,$userList){
	global $weburl;

	

	$user_id = insert_user($parent_id,$item_id);
	$item = ($itemList) ? $itemList."|".$item_id :  $item_id;
	$user = ($userList) ? $userList."|".$user_id :  $user_id;
	setcookie("item",$item,time()+3600*24*365); //写入cookie
	setcookie("user",$user,time()+3600*24*365); //写入cookie
	go($weburl."dshow.php?u=$user_id&ck=true");
}


//通过用户获取项目id
function get_item_id($parentid){
	global $lnk;
	$result=$lnk -> query("select * from spread_user where user_id='".$parentid."'"); 
	while ($rs=mysqli_fetch_assoc($result)){ return $rs['item_id'];}
}


//通过项目id得到项目详情
function get_item_content($item_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_item where item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs;}
}

//通过用户id得到用户详情
function get_user_content($user_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_user where user_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs;}
}

//得到ip对应城市
function get_ip_city($ip){
	global $lnk;
	if(!$ip)
		exit();
	$getip= explode(".",$ip);
	$ipnum = $getip[0]*256*256*256+$getip[1]*256*256+$getip[2]*256+$getip[3];
	$result=$lnk -> query("select * from iptable where StartIPNum<=$ipnum and EndIPNum>=$ipnum"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return  $rs["Country"];
	}
}
//更新当前用户ip
function update_ip_city($user_id,$city){
	global $lnk;
	$result=$lnk->query("update  spread_user set user_ip_city='$city',open_status='1'  where  user_id=$user_id");
}

//得到数据并更新用户数据
function get_count($type="card",$user_uid,$item_id){
	global $lnk;
	$userGroup = get_user_content($item_id,$user_uid);
	$itemGroup = get_item_content($item_id);
	/*开卡，带看，互动，到场，成交   共公部分代码*/
	$citysql = $itemGroup["user_city"]? "and user_ip_city like '%".$itemGroup["user_city"]."%'" : "";	//ip所在城市限制
	$item_rate_userc_need = $itemGroup["rate_userc_need"]? $itemGroup["rate_userc_need"]+0: 10; //需要下下家开卡数
	$item_rate_userc = $itemGroup["rate_userc"] ? $itemGroup["rate_userc"]+0: 0.3;     //下下家提成率
	$take_time = 600;                                                                  //十分钟带看；
	$target_num = $itemGroup["target_num"]? $itemGroup["target_num"]+0 : 40;           //开卡提成倍率
	$num_card = $itemGroup["num_card"]? $itemGroup["num_card"]+0 : 1;                  //开卡提成倍率
	$num_take = $itemGroup["num_take"]? $itemGroup["num_take"]+0 : 2;                  //带看提成倍率
	$num_interact = $itemGroup["num_interact"]? $itemGroup["num_interact"]+0 : 2;      //互动提成倍率
	$num_spot = $itemGroup["num_spot"]? $itemGroup["num_spot"]+0 : 1;                  //到场提成倍率
	$num_deal = $itemGroup["num_deal"]? $itemGroup["num_deal"]+0 : 30;                 //成交提成倍率
	switch ($type) {
		case 'card':
			$num_cash=$num_card;
			break;
		case 'take':
			$num_cash=$num_take;
			break;
		case 'interact':
			$num_cash=$num_interact;
			break;
		case 'spot':
			$num_cash=$num_spot;
			break;
		case 'deal':
			$num_cash=$num_deal;
			break;
		case 'dealonline':
			$num_cash=$num_deal*0.5;
			break;
	}
	$count_userb=0; 
	$count_userc=0;
	$arr_userb=array(); //b用户列表
	//数据库查询
	$sql ="select user_id,phone,avatar,nick_name,count_card,user_ip,user_ip_city,get_rtmp,get_rtc,get_spot,get_deal,get_deal_online from spread_user where open_status=1 $citysql and parent_id='$user_uid'";

	$result=$lnk -> query($sql);
	while ($rs=mysqli_fetch_assoc($result)){
		$user_id = $rs["user_id"];
		$arr_userb_userc = 0;
		switch ($type) {
			case 'card':
				//得到下级开卡数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				$count_userb ++;
				$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				break;
			case 'take':
				//得到下级带看数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and get_rtmp>=$take_time $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_rtmp"]>=$take_time){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				}elseif($count_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>0));
				break;
			case 'interact':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and get_rtc<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_rtc"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				}elseif($count_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>0));
				break;
			case 'spot':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and get_spot<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_spot"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				}elseif($count_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>0));
				break;
			case 'deal':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and get_deal<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_deal"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				}elseif($count_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>0));
				break;
			case 'dealonline':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and get_deal_online<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_deal_online"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>1));
				}elseif($count_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$count_userc,"self_status"=>0));
				break;
		}	
	}
	/*
	//返回 
	所有用户单位（count_userall）;
	用户b单位（count_userb）
	用户c单位（count_userc）
	所有用户金额（count_userall）;
	下级b用户列表 （arr_userb）
	下级c用户数量（count_userc）
	*/
	$count_userall = $count_userb+$count_userc*$item_rate_userc;
	//如果已兑换，显示兑换状态及金额
	if(get_cash_status($type,$user_uid,$item_id)==0){
		$cash_status=0;
		if($type=="card"){
			$count_cash_all = ($count_userc >= $item_rate_userc_need) ? $count_userall*$num_cash: 0;  //如果c不满足 金额为0
		}else{
			$count_cash_all = $count_userall*$num_cash;
		}

		if($type=="card" and $count_userall<$target_num)
			$count_cash_all = 0;
		$cash_dui=$count_cash_all;
		$cashinfo=array("operate_date"=>"-","operator"=>"-","operate_note"=>"-");
	}else{
		$cashinfo=get_cash_status($type,$user_uid,$item_id);
		$count_cash_all = $cashinfo["operate_cash"]+0;
		$cash_status=1;
		$cash_dui="已领奖";
	}

	$lnk -> query("update  spread_user set count_$type = '$count_userall' where user_id=$user_uid");

	return array("count_userall"=>$count_userall,
				 "count_userb"=>$count_userb,
				 "count_userc"=>$count_userc,
				 "count_cash_all"=>$cash_dui,
				 "count_cash"=>$count_cash_all,
				 "arr_userb"=>$arr_userb,
				 "cashinfo"=>$cashinfo,
				 "cash_status"=>$cash_status
				 );
}

function get_cash_status($type="card",$user_id,$item_id){
	global $lnk;
	$operate_type=1;
	switch ($type) {
		case 'card':
			$operate_type=1;
			break;
		case 'take':
			$operate_type=2;
			break;
		case 'interact':
			$operate_type=3;
			break;
		case 'spot':
			$operate_type=4;
			break;
		case 'deal':
			$operate_type=5;
			break;
	}
	$result=$lnk->query("select * from spread_user_operate  where operate_type=$operate_type and  uid=$user_id and item_id=$item_id");
		while ($rs=mysqli_fetch_assoc($result)){
			return $rs;
		}
	return 0;
}


//通过用户id得到已转发的数量//统计bc下线总和
function get_count_redeem_nbc($user_id){
	global $lnk;
	$n=0;
	$b=0;
	$c=0;
	$d=0;
	$e=0;
	$result=$lnk -> query("select user_id from spread_user where open_status=1 and parent_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		$n++;
		$b++;
		$u_id = $rs["user_id"];
		//得到下级开卡数
		$result2=$lnk -> query("select count(0) from spread_user where open_status=1 and parent_id='".$u_id."'"); 
		while ($rs2=mysqli_fetch_row($result2)){
			$n+=$rs2[0];
			$c+=$rs2[0];
		}
		//得到下级到场人数  1 开卡 2 带看  3 互动  4到场 5 交易 
		//到场
		$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=4 and pid='".$u_id."'"); 
		while ($rs2=mysqli_fetch_row($result2)){
			$d+=$rs2[0];
		}
		//交易
		$result2=$lnk -> query("select count(0) from spread_user_operate where operate_type=5 and pid='".$u_id."'"); 
		while ($rs2=mysqli_fetch_row($result2)){
			$e+=$rs2[0];
		}
	}
	return array("down_user_count"=>$n,"user_b_count"=>$b,"user_c_count"=>$c,"user_spot_count"=>$d,"user_deal_count"=>$e);
}

//无限级通过用户id得到已转发的数量
function get_count_redeem($user_id){
	global $lnk;
	global $nn;
	$result=$lnk -> query("select user_id from spread_user where open_status=1 and parent_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		$nn++;
		$u_id = $rs["user_id"];
		get_count_redeem($u_id);
	}
	return $nn;
}






//db 插入新用户
function insert_user($parentid,$item_id){
	global $lnk;
	$open_time = time();
	$user_ip = getip();
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$parent = get_user_content($parentid);
	$redeem_code = enid($open_time); //得到一个三十六进制的邀请码
	//ip 测试
	if(ipcheck($item_id,50)>0){
		alert("相同ip超过3个不能再记录，是否找回以前记录");
		exit();
	}
		//手机是否超过3次 并ip为n次限制
	if(phone_useragent($item_id,3)>0){
		alert("同一个设备不能超过2次，不能再记录，是否找回以前记录，找回页三期开发中...");
		exit();
	}
	if($parent["open_status"]){
		$lnk -> query("insert into spread_user (parent_id,item_id,phone,open_time,redeem_code,user_ip,user_agent) values ('$parentid','$item_id','0','$open_time','$redeem_code','$user_ip','$user_agent')"); 
		$user_id=mysqli_insert_id($lnk);
		//write_qrcode($user_id);
	}else{
		$user_id = $parentid;
	}
	return $user_id;
}

//db 写入二维码
function write_qrcode($user_id){
	global $lnk;
	global $weburl;
	$qrcode_url=qrcode($weburl."dshow.php?u=".$user_id);
	//更新
	$result=$lnk->query("update  spread_user set qrcode='$qrcode_url'  where  user_id=$user_id");				
	return $qrcode_url;
}
//生成二维码
function  qrcode($url){
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'admin/temp'.DIRECTORY_SEPARATOR; 
	$PNG_WEB_DIR = 'admin/temp/'; 
	$ecc = 'H'; // L-smallest, M, Q, H-best 
	$size = 10; // 1-50 
	$filename = $PNG_TEMP_DIR.'qrcode_'.time().'.png'; 
	QRcode::png($url, $filename, $ecc, $size, 2); 
	//chmod($filename, 0777); 
	return basename($filename); 
}

//ip是否超过n个
function ipcheck($item_id,$num){
	global $lnk;
	$ip=getip();
	$result=$lnk -> query("select user_id from spread_user where item_id='".$item_id."' and user_ip='$ip'"); 
	while ($rs=mysqli_fetch_assoc($result)){ $ipcount[]= $rs;}
	if(count($ipcount)>$num)
		return 1;
	else
		return 0;
}

//手机是否超过3次
function phone_useragent($itemid,$num){
	global $lnk;
	global $useragent;
	$result=$lnk -> query("select user_id from spread_user where item_id='".$item_id."' and user_agent='$useragent'"); 
	while ($rs=mysqli_fetch_assoc($result)){ $useragentcount[]= $rs;}
	if(count($useragentcount)>$num)
		return 1;
	else
		return 0;
}

#弹出对话框
function alert($message){echo ("<script>alert('". $message ."')</script>");}
#返回上一页
function goBack(){echo("<script>history.back()</script>");}
#重定向另外的连接
function go($url){echo ("<script>location.href='" . $url . "';</script>");}
//得到ip
function getip(){
	//ip
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
	  	if ($_SERVER["HTTP_CLIENT_IP"]) 
			$proxy = $_SERVER["HTTP_CLIENT_IP"];
		else 
		  $proxy = $_SERVER["REMOTE_ADDR"];
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else {
		if (@$_SERVER["HTTP_CLIENT_IP"]) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
			$_SESSION['ip_now']=  $_SERVER["HTTP_CLIENT_IP"];
		} else {
			  $ip = $_SERVER["REMOTE_ADDR"];
			  $_SESSION['ip_now']=$_SERVER["REMOTE_ADDR"];
		}
	}
	$ip=$ip;
	if (isset($proxy)) {
		$ip=$proxy;
	} 
	return $ip;
}

$username="";

@$key=trim($_GET["code"]);

search_page_api($key); //得到用户基本信息
$count_card=get_count("card",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户开卡
$count_take=get_count("take",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户带看
$count_interact=get_count("interact",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户带看
$count_spot=get_count("spot",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户带看
$count_deal=get_count("deal",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户带看
$count_deal_online=get_count("dealonline",$userGroup["user_id"],$itemGroup["item_id"]); //得到当前数据 并更新当前用户带看




if(!$count_card["count_cash_all"]){
	$count_take["count_cash_all"]      = 0;
	$count_interact["count_cash_all"]  = 0;
	$count_spot["count_cash_all"]      = 0;
}

@$act=trim($_GET["act"]);
//更新当前状态
if($act=="status_update"){
	@$obj="get_".$_REQUEST["objname"];
	@$obj_value = $_REQUEST["objvalue"]+0;
	$item_id = $itemGroup["item_id"];
	$user_id = $userGroup["user_id"];
	$result=$lnk -> query("update spread_user set $obj='$obj_value'   where  item_id='$item_id' and user_id='$user_id'"); 
	exit();
}

//更新领奖状态（插入）
if($act=="update"){
	@$obj=trim($_GET["obj"]);
	if(!$obj)
		exit();
	switch ($obj) {
		case 'card':
			$operate_type = 1;
			$operate_cash = $count_card["count_cash_all"];
			break;
		case 'take':
			$operate_type = 2;
			$operate_cash = $count_take["count_cash_all"];
			break;
		case 'interact':
			$operate_type = 3;
			$operate_cash = $count_interact["count_cash_all"];
			break;
		case 'spot':
			$operate_type = 4;
			$operate_cash = $count_spot["count_cash_all"];
			break;
		case 'deal':
			$operate_type = 5;
			$operate_cash = $count_deal["count_cash_all"];
			break;
		case 'deal_online':
			$operate_type = 6;
			$operate_cash = $count_deal_online["count_cash_all"];
			break;
	}
	if(!$operate_cash)
		exit();

	$uid =  $userGroup["user_id"]+0;
	$pid =  $userGroup["parent_id"]+0;
	$item_id = $itemGroup["item_id"]+0;
	$operator =  $username;
	$operate_note = $_REQUEST["note"];
	$operate_date = time();
	$lnk -> query("insert into spread_user_operate (uid,pid,item_id,operate_type,operate_cash,operate_date,operator,operate_note) values ('$uid','$pid','$item_id','$operate_type','$operate_cash','$operate_date','$operator','$operate_note')"); 
	alert("更新成功！");
	go("?code=$key");
	exit();
}


function search_page_api($key){
	global $userGroup;
	global $itemGroup;
	global $username;
	$error=0;

	$token = $_COOKIE["data"];
	//用户id是否传入
	if(!$token){
		$error = "登录已超时！请重新登录获取权限";
		$code =  1001 ;
	}
	//手机号是否正确
	elseif(strlen($key)<= 3 ){
		$error = "关键字格式错误！$key";
		$code =  1002;
	}

	//如果用户不存在
	else{
		$jsonarr = json_decode(base64_decode($token));
		//print_r($jsonarr);
		$manage = $jsonarr->manage;
		$username =  $jsonarr->username; 
		$item = get_item($manage);
		$itemGroup = $item;
		$item_id=$item["item_id"]+0;
		if($item_id>0){
			$arr=get_key_info($item_id,$key);
			if($arr){
				$arr["target_num"]=$item["target_num"];
				$msg = $arr;
				$code = 0; 
			}else{
				$code = 1004;
				$msg = "查询结果：没有找到，请核对！";
			}
		}else{
			$error = "您还没有创建项目！";
			$code =  1003;
		}
		
	}
	if($error){
		alert($error."[errcode:$code]");
		goBack();
		exit();
	}else{
		$userGroup = $arr;
	}
}




function get_item($item_user){
	global $lnk;
	$result=$lnk -> query("select * from spread_item  where  item_user='$item_user' order by item_id desc limit 0,1"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return $rs;
	}
	return 0;
}
function get_key_info($item_id,$key){
	global $lnk;
	$result=$lnk -> query("select * from spread_user  where  item_id='$item_id' and (phone='$key' or redeem_code='$key')"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return $rs;
	}
	return 0;
}


?>