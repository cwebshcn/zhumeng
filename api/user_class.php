<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$action = @$_GET["s"];   //动作
$u=@$_POST["username"];  //用户名
$p=@$_POST["password"];  //密码
$msg=@$_POST["msgcode"];  //短信验证
$tk = @$_POST["token"]; //
$ut=@$_POST["usertype"]; //用户类型 reg
$ut_id=@$_POST["uid"]+0; //用户ID
$status=@$_POST["status"]+0; //用户ID
$code= 0;
$msg = "error";


	switch ($action) {
		case 'reg':
			reg($u,$p);
			# 注册
			break;
		case 'login':
			login($u,$p);
			# 登录
			break;
		case "userinfo":
			tk_to_user();
			# 用户信息
			break;
		case 'update_info':
			update_info();
			# 更新信息
			break;
		case 'user_list':
			user_list();
			# 更新信息
			break;
		case 'user_list_self':
			user_list(1,$status);
			# 更新信息
			break;
		case "user_nexus":
			nexus_insert($ut_id);
			break;
		case "user_nexus_verify":
			nexus_verify($ut_id);
			break;
		case "user_nexus_del":
			nexus_del($ut_id);
			break;
		default:
			# 报错
			$code = -1;
			$msg = "参数错误！";
			break;
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


//得到数据
function get_user_info_id($id){
	global $lnk;
	$userinfo=array();
	$TRecord=$lnk -> query("select * from user where id='".$id."'");
    while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$userinfo = $rs;
    }
    return $userinfo;
}

function user_list($self=0,$status=0){
	global $lnk;
	global $code;
	global $msg;

	$userinfo=array();
	$sqlstr = "";
	$ut=@$_POST["usertype"]+0; //用户类型 reg
	if($ut>0){

	}else{
		$user = tk_to_user();
		if(!$user)
			return ;
		$ut= $user["user_type"]==2 ? 1:2;

		if($self){
			$ut_str=user_group($status);
			if(!$ut_str){
				$code = -1;
				$msg = "no data !";
				return;
			}
			$sqlstr =  $ut_str ? " and id in($ut_str)":"";	
		}
	}
	//$ut= $user["user_type"]==2 ? " and student=$ut_id":" and teacher=$ut_id";
	
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
    	$user_ut2 = $user["user_type"]==1  ? "teacher": "student";
    	$str  = $return_str ? ",".$rs[$user_ut2] : $rs[$user_ut2];
    	$return_str .= $str;
    }
    return $return_str;
}

function nexus_insert($ut_id){
	global $lnk;
	global $code;
	global $msg;
	if(!$ut_id){
		$code = -1;
		$msg = "传值错误，uid为必传！";
		return;
	}
	$user = tk_to_user();
	if(!$user)
		return ;

	if($user["user_type"]==2){
		$student = $ut_id;
		$teacher = $user["id"];
		$status =1;
	}else{
		$student = $user["id"];
		$teacher = $ut_id;
		$status =0;
	}

	$student_arr = get_user_info_id($student);
	$teacher_arr = get_user_info_id($teacher);

	if($student_arr["user_type"]==2){
		$code = -1;
		$msg = "你不能绑定老师！";
    	return ;
	}
	if($teacher_arr["user_type"]==1){
		$code = -1;
		$msg = "你不能绑定学生！";
    	return ;
	}

	$TRecord=$lnk -> query("select * from user_nexus where teacher=$teacher and student=$student");
	while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$code = -1;
		$msg = "已绑定，无需再次绑定！";
    	return ;
    }
	$lnk -> query("insert into user_nexus (student,teacher,status) values('$student','$teacher','$status')");
	$msg = "success!";	
}


function nexus_verify($ut_id){
	global $lnk;
	global $code;
	global $msg;
	if(!$ut_id){
		$code = -1;
		$msg = "传值错误，uid为必传！";
		return;
	}
	$user = tk_to_user();
	if(!$user)
		return ;

	if($user["user_type"]==2){
		$student = $ut_id;
		$teacher = $user["id"];
	}else{
		$code = -1;
		$msg = "无权限，必需为老师身份！";
		return;
	}
	$lnk -> query("update user_nexus set status=1 where teacher=$teacher and student=$student");
	$msg = "success！";
	return ;	
}

function nexus_del($ut_id){
	global $lnk;
	global $code;
	global $msg;
	if(!$ut_id){
		$code = -1;
		$msg = "传值错误，uid为必传！";
		return;
	}
	$user = tk_to_user();
	if(!$user)
		return ;

	if($user["user_type"]==2){
		$student = $ut_id;
		$teacher = $user["id"];
	}else{
		$code = -1;
		$msg = "无权限，必需为老师身份！";
		return;
	}
	$lnk -> query("delete from user_nexus  where teacher=$teacher and student=$student");
	$msg = "del success";
	return ;	
}


function reg($u,$p){
	global $lnk;
	global $code;
	global $msg;
	global $ut;
	if($ut<1 or $ut>2){
		$code = -1;
		$msg = "用户类型（usertype）未传值！1:学生，2老师";
		return;
	}
	if(user_info_check($u,$p)==1)
		return ;
	
	$userinfo = get_user_info($u);
	if(count($userinfo)==0){
		$ip=getip();
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$lnk -> query("insert into user (username,password,user_type,nick_name,reg_ip,reg_date,useragent) values('$u','".md5($p)."','$ut','$u','$ip','".time()."','$useragent')");
	    $msg = base64_encode(json_encode( array("u"=>$u,"p"=>$p,"t"=>time())));
	}else{
		$code = -1;
		$msg = "用户已存在！";
	}
}

function login($u,$p){
	global $code;
	global $msg;
	if(user_info_check($u,$p)==1)
		return ;
	$userinfo = get_user_info($u,$p);
	$token="";
	if(count($userinfo)>0){
		$info = base64_encode(json_encode(array("u"=>$u,"p"=>$p,"t"=>time())));
		$type = $userinfo["user_type"];
		$msg = array("token"=>$info,"user_type"=>$type);
	}else{
		$code=-1;
		$msg = "用户不存在，或密码错误！";
	}
}

function user_info_check($u,$p){
	global $code;
	global $msg;
	if(strlen($u)<6){
		$code = -1;
		$msg = "用户名不能少于6位！"; 
		return 1;
	}
	if(strlen($p)<6){
		$code = -1;
		$msg = "密码不能少于6位！"; 
		return 1;
	}
	return 0;
}


//token 验证
function tk_to_user(){
	global $code;
	global $msg;
	global $tk;
	global $u;
	$p="";
	if(!$tk){
		if($u){
			$user = get_user_info($u);
			$user["password"]="";
			$msg = json_encode($user);
			return $user;
		}else{
			$code = -1;
			$msg = "缺少参数token！"; 
			return ;
		}	
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