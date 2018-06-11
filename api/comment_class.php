<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$action = @$_GET["s"];   //动作
$list_code = @$_REQUEST["c"];   //列表
$pid = @$_REQUEST["pid"]+0;   //列表
$parent = @$_REQUEST["parent"]+0;   //列表

$tk = @$_POST["token"]; //

$code= 0;
$msg = "error";


switch ($action) {
	case 'comment_list':
		comment_list();
		# 注册
		break;
	case 'comment_write':
		comment_write();
		# 登录
		break;
	default:
		# 报错
		$code = -1;
		$msg = "参数错误！";
		break;
}

function comment_list($parent=0){
	global $lnk;
	global $list_code;
	global $pid;
	global $code;
	global $msg;
	$list_id = @$_REQUEST["list_id"]+0;
	$info_arr =array();
	if(!$list_code){
		if(!$list_id){ //扩展用的
			$code = -1;
			$msg ="没有找到对应列表！";
			return;
		}	
	}else{
		$list_code1 = list_code($list_code);
		$list_code = $list_code1["code"];
	}
	if(!$pid){
		$code = -1;
		$msg ="缺少参数，文章评论所需要的pid";
		return;
	}

	$result=$lnk -> query("select * from comment where message_action='".$list_code."' and pid = $pid and parent_id=$parent");
    while($rs=mysqli_fetch_assoc($result))
    {
    	$msg_arr = $rs; 
    	$down_message = comment_list($rs["id"]);
    	if($down_message)
    		$msg_arr["down_message"]=json_encode($down_message);
    	$info_arr[] = $msg_arr;
    }
    $msg =  $info_arr;
}

function comment_write(){
	global $lnk;
	global $list_code;
	global $pid;
	global $parent;
	global $code;
	global $msg;
	$message_body = trim($_REQUEST["message_body"]);
	if(!$list_code){
		$code = -1;
		$msg ="无效动作";
		return;
	}
	if(!$pid){
		$code = -1;
		$msg ="缺少参数，文章评论所需要的pid";
		return;
	}
	if(!$message_body){
		$code = -1;
		$msg ="缺少参数，文章评论内容message_body";
		return;
	}
	$user = tk_to_user();
	if(!$user)
		return;
	$user["password"]="";

	$list_code1 = list_code($list_code);
	$code_act = $list_code1["code"];
	$list_id = $list_code1["list_id"]+0;

	$userinfo =json_encode($user);

	$lnk -> query("insert into comment(parent_id,list_id,pid,username,userinfo,message_body,message_action,message_date) values('$parent','$list_id','$pid','".$user["username"]."','".$userinfo."','$message_body','$code_act','".time()."')");
	$msg = "success!";
}


function list_code($list_code){	
	global $lnk;
	$list_arr = array("code"=>$list_code,"list_id"=>0);
	$code = "a|b";//保留字段
	//if(strstr())

	$TRecord=$lnk -> query("select * from mainbt1 where webpath='".$list_code."'");
    while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$list_arr["list_id"]=$rs["id"];
    }
	return $list_arr;  //以后这里改一些特珠评论先扩展着
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
    	$userinfo["nick_name"] = urlencode($rs["nick_name"]);
    	$userinfo["password"]="***";

    }
    return $userinfo;
}


//得到数据
function user_data($u){
	global $lnk;
	global $code;
	global $msg;
	$userinfo=array();
	if(!$u){
		$code = -1;
		$msg = "缺少用户名参数！";
		return;
	}
	$TRecord=$lnk -> query("select * from user where username='".$u."' $pswd_sql");
    while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$userinfo = $rs;
    }
    $msg =  $userinfo;
}

function user_list($self=0,$status=0){
	global $lnk;
	global $code;
	global $msg;
	$userinfo=array();
	$sqlstr = "";
	
	
	//$ut= $user["user_type"]==2 ? " and student=$ut_id":" and teacher=$ut_id";
	if($self){
		$user = tk_to_user();
		$ut= $user["user_type"]==2 ? 1:2;
		if(!$user)
			return ;
		$ut_str=user_group($status);
		if(!$ut_str){
			$code = -1;
			$msg = "no data !";
			return;
		}
		$sqlstr =  $ut_str ? " and id in($ut_str)":"";	
	}else{
		$ut=@$_POST["usertype"]+0; //用户类型 reg
		if(!$ut){
			$code = -1;
			$msg ="缺少参数 usertype!";
			return;
		}
	}
	$TRecord=$lnk -> query("select * from user where user_type='".$ut."' $sqlstr");
	while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$userinfo[] = $rs;
    }
    $msg =  $userinfo;
}

function user_group($status){
	global $lnk;
	$user = tk_to_user();
	if(!$user)
		return ;

	$user_ut = $user["user_type"]==2  ? "teacher": "student";
	$ut_id = $user["id"]+0;
	$return_str = "";
	$TRecord=$lnk -> query("select * from user_nexus where $user_ut=$ut_id and status=$status");
	while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$str  = $return_str ? ",".$rs["id"] : $rs["id"];
    	$return_str .= $str;
    }
    return $return_str;
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
			$msg =   json_encode($user);
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


function update_info(){
	global $lnk;
	global $code;
	global $msg;
	$user=tk_to_user();
	if(!$user)
		return ;
	$nick_name = @$_POST["nick_name"];
	$birthday  = @$_POST["birthday"]+0;
	$sex       = @$_POST["sex"]+0;
	$mobile    = @$_POST["mobile"];
	$email     = @$_POST["email"];
	$base64_img= @$_POST["avatar"];
	$old_pswd  = @$_POST["old_pswd"];
	$new_pswd  = @$_POST["new_pswd"];
	$avatar_path = "";
	//base64
	if($base64_img){
		$image = explode(',',$base64_img);
		$image = $image[1];
		$imgName=date('YmdHis',time()).rand(100,999).".jpeg";
		file_put_contents("../admin/temp/avatar/".$imgName, base64_decode($image));
		$avatar_path = $imgName;
	}
	//pswd
	if($new_pswd and $old_pswd){
		if(strlen($new_pswd)<6){
			$code = -1;
			$msg = "密码不能少于6位！"; 
			return ;
		}
		if($user["password"] != $old_pswd){
			$code = -1;
			$msg = "密码与原始密码不符！"; 
			return ;
		}
			$password=$new_pswd;
	}

	$nick_name_sql = $nick_name ? ",nick_name = '$nick_name'" : "";
	$birthday_sql  = $birthday ? ",birthday = '$birthday'" : "";
	$sex_sql       = $sex ? ",sex = '$sex'" : "";
	$mobile_sql    = $mobile ? ",mobile = '$mobile'" : "";
	$email_sql     = $email ? ",email = '$email'" : "";
	$avatar_sql    = $avatar_path ? ",avatar='$avatar_path'" : "";
	$password_sql    = $password ? ",password='$password'" : "";

	$sql = $nick_name_sql.$birthday_sql.$sex_sql.$mobile_sql.$email_sql.$avatar_sql.$password_sql;

	if($sql){
		$lnk ->query("update user set update_time='".time()."'  $sql  where username = '".$user["username"]."'");
		$msg = tk_to_user();
	}else{
		$code = -1;
		$msg = "没有接受到任何数据!";
	}
}

//得到ip
function getIp(){ 
    $onlineip=''; 
    if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){ 
        $onlineip=getenv('HTTP_CLIENT_IP'); 
    } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){ 
        $onlineip=getenv('HTTP_X_FORWARDED_FOR'); 
    } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){ 
        $onlineip=getenv('REMOTE_ADDR'); 
    } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){ 
        $onlineip=$_SERVER['REMOTE_ADDR']; 
    } 
    return $onlineip; 
}

     

$arr=array("code"=>$code,"data"=>$msg);
echo json_encode($arr);
?>