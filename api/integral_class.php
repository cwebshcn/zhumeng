<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$action = @$_GET["s"];   //动作
$tk = @$_POST["token"];

$code= 0;
$msg = "error";


	switch ($action) {
		case 'getlist':
			getlist();
			# 获取
			break;
		case 'get':
			$msg = get_total();
			# 获取
			break;

		case 'insert':
			insert();
			# 插入
			break;		
		default:
			# 报错
			$code = -1;
			$msg = "参数错误！";
			break;
	}

function getlist(){
	global $lnk;
	global $code;
	global $msg;
	@$pn=$_GET["pn"] + 0; 
	@$px=$_GET["px"]?$_GET["px"]+0:10; 

	$user = tk_to_user();
	if(!$user)
		return;
	$data = array();
	$TRecord=$lnk -> query("select * from data_integral where username='".$user["username"]."' order by id desc limit ".$pn.",".$px);
    while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$data[] = $rs;
    }
    $msg = $data;
}


function insert(){
	global $lnk;
	global $code;
	global $msg;

	$user = tk_to_user();
	if(!$user)
		return;

	$username    = $user["username"];
	$change      = @$_POST["change"];
	$integral    = get_total($username)+$change;
	$case        = @$_POST["case"];
	$notice      = @$_POST["notice"];
	$change_date = time();

	if($change){
		$lnk -> query("insert into data_integral(username,integral,change_num,`case`,notice,change_date)values('$username','$integral','$change','$case','$notice','$change_date')");
    	$msg = "success!";

	}else{
		$code = -1;
		$msg = "没有传参，参数错误！";
	}
}

function  get_total($u=""){
	global $lnk;
	if(!$u){
		$user = tk_to_user();
		if(!$user)
			return;
		else
			$u=$user["username"];
	}
	$TRecord = $lnk -> query("select SUM(change_num) as num from data_integral where username='".$u."'");
	while($rs=mysqli_fetch_assoc($TRecord)){
		return $rs["num"]>0 ? $rs["num"] : 0;
	}
	return 0;
}


//得到数据
function get_user_info($u,$p=""){
	global $lnk;
	$userinfo=array();
	$pswd_sql = $p ? " and password='".md5($p)."'":'';
	$TRecord=$lnk -> query("select * from user where username='".$u."' $pswd_sql");
    while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$userinfo = $rs;
    }
    return $userinfo;
}



//token 验证
function tk_to_user(){
	global $code;
	global $msg;
	global $tk;
	$u="";
	$p="";
	if(!$tk){
		$code = -1;
		$msg = "缺少参数token！"; 
		return ;
	}
	$tk_decode = json_decode(base64_decode($tk), true);
	if(is_array($tk_decode)){
		$u = $tk_decode["u"];
		$p = $tk_decode["p"];
		$t = $tk_decode["t"];
	}
	if($u and $p){
		$user = get_user_info($u,$p);
		if($user){
			//$msg =   json_encode($user);
			return $user;
		}else{
			$code = -1;
			$msg = "用户已被删除或无效token!";
			return ;
		}
	}else{
		$code = -1;
		$msg = "非法token!"; 
		return ;
	}
}


     

$arr=array("code"=>$code,"data"=>$msg);
echo json_encode($arr);
?>