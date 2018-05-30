<?php
include '../admin/config/config.php';
include '../admin/function/function.php';
header("Access-Control-Allow-Origin: *");

//通过用户id得到已转发的数量//统计bc下线总和
function get_user_content($user_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_user where open_status=1 and user_id='".$user_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){
		return  $rs;
	}
}



			

//开卡数排名
function get_top3($objname){
	global $lnk;
	global $userGroup;
	$item_id = $userGroup["item_id"];
	echo ("select * from spread_user where item_id = $item_id and open_status=1 and parent_id>0  order by count_$objname desc limit 0,3");
	$result = $lnk -> query("select * from spread_user where item_id = $item_id and open_status=1 and parent_id>0  order by count_$objname desc limit 0,3");
	while ($userb=mysqli_fetch_assoc($result)){
		if($userb["nick_name"])
			$nick_name = substr_replace($userb["nick_name"], '***', 1,-1);
		elseif($userb["phone"])
			$nick_name = substr_replace($userb["phone"], '***', 7);
		elseif($userb["user_ip"])
			$nick_name = "来自".$userb["user_ip_city"]."[".substr_replace($userb["user_ip"], '***', 5)."]的用户";
		else
			$nick_name = "游客用户";

		//得到金额
		$list = get_count($objname,$userb["user_id"],$item_id);
		$operate_cash = $list["count_cash_all"];


		$msg[] =  array("nick_name"=>$nick_name,"operate_cash"=>$operate_cash);
	}
	return $msg;
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

	$lnk -> query("update  spread_user set count_$type = '$count_userall' where open_status=1 and user_id='".$userGroup["user_id"]."'");

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
		case 'deal_online':
			$operate_type=6;
			break;
	}
	$result=$lnk->query("select * from spread_user_operate  where operate_type=$operate_type and  uid=$user_id and item_id=$item_id");
		while ($rs=mysqli_fetch_assoc($result)){
			return $rs;
		}
	return 0;
}

//通过项目id得到项目详情
function get_item_content($item_id){
	global $lnk;
	$result=$lnk -> query("select * from spread_item where item_id='".$item_id."'"); 
	while ($rs=mysqli_fetch_assoc($result)){return $rs;}
}


$code = 0;
$user_id =  $_REQUEST["uid"]+0;

if(!$user_id){
	$code = 1003; 
	$msg = "传值有误";
}else{
	$userGroup=get_user_content($user_id);
	$itemGroup=get_item_content($userGroup["item_id"]);
	$card=get_top3("card");
	$card=get_top3("take");
	$card=get_top3("interact");
	$card=get_top3("spot");
	$card=get_top3("deal");
	$msg=array("card"=>$card,"take"=>$take,"interact"=>$interact,"spot"=>$spot,"deal"=>$deal);
}


echo json_encode( array("code"=>$code,"data"=>$msg));
?>