<?php
//配置文件
//运行环境地址
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';  
$weburl = $http_type . $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];  //定义根目录
$weburl = dirname($weburl)."/";
//家校通api
$api_jxt_php_url = strpos("vip".$weburl."vip","dev") ? "https://m.51zbk.vip/newapi/public/apistage/index.php?s=":"https://m.51zbk.vip/newapi/public/api/index.php?s="; //防止头尾出现
//朱欢php api
$api_jxt_url = strpos("vip".$weburl."vip","dev") ? "http://m.51zbk.vip/testjiaxt/app/":"http://m.51zbk.vip/jiaxt/app/"; //防止头尾出现
//得到数据并更新用户数据
function get_count($type,$user_uid,$item_id){
	global $lnk;
	$userGroup = get_user_content($item_id,$user_uid);
	$itemGroup = get_item_content($item_id);
	/*邀请，带看，互动，到场，成交   共公部分代码*/
	$citysql = $itemGroup["user_city"]? "and user_ip_city like '%".$itemGroup["user_city"]."%'" : "";	//ip所在城市限制
	$item_rate_userc_need = $itemGroup["userc_need_num"]+0; //需要下下家邀请数
	$item_userb_need = $itemGroup["userb_need_num"]>0 ? $itemGroup["userb_need_num"]+0:1; //需要下家邀请数
	$item_rate_userc = $itemGroup["rate_userc"]>0 ? $itemGroup["rate_userc"]+0: 0.3;     //下下家提成率
	$take_time = 600;                                                                  //十分钟带看；
	$target_num = $itemGroup["target_num"]>0 ? $itemGroup["target_num"]+0 : 40;           //邀请提成倍率
	$num_card = $itemGroup["num_card"];                  //邀请提成倍率
	$num_take = $itemGroup["num_take"];                  //带看提成倍率
	$num_interact = $itemGroup["num_interact"];      //互动提成倍率
	$num_spot = $itemGroup["num_spot"];                                              //到场提成倍率
	$num_deal = $itemGroup["num_deal"];                 //成交提成倍率
	$num_online = $itemGroup["num_online"];                 //成交提成倍率
	$num_deal_online = $itemGroup["num_deal_online"];                 //成交提成倍率
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
		case 'online':
			$num_cash=$num_online; 
			break;
		case 'deal_online':
			$num_cash=$num_deal_online;
			break;
		default:
			$num_cash=0;
	}
	$count_userb=0;
	$count_userb_num=0;
	$count_userc=0; 
	$count_card_b_cash=0;
	$count_card_c_cash=0;
	$arr_userb=array(); //b用户列表
	//数据库查询
	$sql ="select user_id,phone,avatar,nick_name,count_card,open_time,user_ip,user_ip_city,get_rtmp,get_rtc,get_spot,get_deal,get_online,get_deal_online from spread_user where openid<>'' $citysql and parent_id='$user_uid'";

	$result=$lnk -> query($sql);
	while ($rs=mysqli_fetch_assoc($result)){
		$user_id = $rs["user_id"];
		$arr_userb_userc = 0;
		switch ($type) {
			case 'card':
				//得到下级邀请数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				//统计下级用户
				$count_userb++;
				//如果下下级满足N人算一个单位
				if($arr_userb_userc>=$itemGroup["userc_need_num"])
					$count_userb_num++;

				$card_c_cash = 0;
				//当达到宣传数后 金额停止累加！
				if($itemGroup["over_time_card"]==0){
					$count_card_b_cash=$count_userb;
					$count_card_c_cash=$count_userb_num;
				}elseif($rs["open_time"]<=$itemGroup["over_time_card"]){
					//echo $rs["open_time"]."|||".$itemGroup["over_time_card"];
					$count_card_b_cash++;
					$result2=$lnk -> query("select count(0) from spread_user where openid<>''  and parent_id='".$user_id."' and open_time<'".$itemGroup["over_time_card"]."'"); 
					while ($rs2=mysqli_fetch_row($result2)){
						$card_c_cash = $rs2[0];
					}
				}
				//如果下下级满足N人算一个单位
				if($card_c_cash>=$itemGroup["userc_need_num"])
					$count_card_c_cash++;

			
				$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				break;
			case 'take':
				//得到下级带看数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_rtmp>=$take_time $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_rtmp"]>=$take_time){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
				break;
			case 'interact':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_rtc<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_rtc"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
				break;
			case 'spot':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_spot<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_spot"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
				break;
			case 'deal':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_deal<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_deal"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
				break;
			case 'online':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_online<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_online"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
				break;
			case 'deal_online':
				//得到下级互动数
				$result2=$lnk -> query("select count(0) from spread_user where openid<>'' and get_deal_online<>0 $citysql and parent_id='".$user_id."'"); 
				while ($rs2=mysqli_fetch_row($result2)){
					$count_userc += $rs2[0];
					$arr_userb_userc = $rs2[0];
				}
				if($rs["get_deal_online"]>0){
					$count_userb ++;
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>1));
				}elseif($arr_userb_userc>0)
					$arr_userb[] = array_merge($rs,array("userc"=>$arr_userb_userc,"self_status"=>0));
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
			$count_cash_all = get_cash_prize($itemGroup["item_id"],$count_card_c_cash+floor($count_card_b_cash/$item_userb_need));  //如果c不满足 金额为0
		}else{
			$count_cash_all = $count_userall*$num_cash;
		}

		$cash_dui=array("status"=>"未兑奖","cash"=>$count_cash_all);
		$cashinfo=array("operate_date"=>"-","operator"=>"-","operate_note"=>"-");
	}else{
		$cashinfo=get_cash_status($type,$user_uid,$item_id);
		$count_cash_all = $cashinfo["operate_cash"]+0;
		$cash_status=1;
		$cash_dui=array("status"=>"已兑奖","cash"=>$count_cash_all);
	}
	$user_all_count=$count_userb+$count_userc;
	$lnk -> query("update  spread_user set count_$type = '$count_userall' where user_id=$user_uid");
	if($type=="card")
		$lnk -> query("update  spread_user set count_userb='".($count_userb_num+floor($count_userb/$item_userb_need))."',count_userc='$count_userc' where user_id=$user_uid");

	

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

//得到当前用户金额及奖励条件  用户b
function get_cash_prize($pid,$num){
	global $lnk;
	$result=$lnk -> query("select * from spread_item_prize where item_id='".$pid."' order by need_num desc");
	while ($rs=mysqli_fetch_assoc($result)){
		if($num>=$rs["need_num"])
			return $rs["prize_cash"]+0;
	}
	return 0;
}


//得到当前用户金额及奖励条件  用户b
function get_cash_prize_list($pid){
	global $lnk;
	$return="";
	$result=$lnk -> query("select * from spread_item_prize where item_id='".$pid."' order by need_num");
	while ($rs=mysqli_fetch_assoc($result)){
		$return.=$rs["need_num"]."个宣传奖获得￥".$rs["prize_cash"]."元<br>";
	}
	return $return;
}


//得到所有宣传奖个数
function get_prize_num($itemGroup){
	global $lnk;
	$result=$lnk -> query("select sum(count_userb) from spread_user where parent_id>0 and item_id=".$itemGroup["item_id"]); 
	while ($rs=mysqli_fetch_row($result)){
		if($itemGroup["publicity_award"]>$rs[0]){
			return array("publicity_award"=>$itemGroup["publicity_award"],"use_num"=>$rs[0],"have_num"=>$itemGroup["publicity_award"] - $rs[0])                                   ;
		}else{
			if($itemGroup["over_time_card"]>0){

			}else{
				$lnk -> query("update  spread_item set over_time_card='".time()."' where item_id=".$itemGroup["item_id"]); 
			}
			return array("publicity_award"=>$itemGroup["publicity_award"],"use_num"=>$itemGroup["publicity_award"],"have_num"=>0);
		}
	}
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
		case 'online':
			$operate_type=6;
			break;
		case 'deal_online':
			$operate_type=7;
			break;
	}
	$result=$lnk->query("select * from spread_user_operate  where operate_type=$operate_type and  uid=$user_id and item_id=$item_id");
		while ($rs=mysqli_fetch_assoc($result)){
			return $rs;
		}
	return 0;
}?>