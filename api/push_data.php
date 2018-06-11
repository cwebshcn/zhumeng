<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$action = @$_GET["s"];   //动作
$tk = @$_POST["token"]; //
$username="";
$code= 0;
$classid=0;

if(empty($action)){
	$code = -1;
	$msg = "传值错误";
}else{
	$classid = get_action($action);
	$user=tk_to_user();
	if($user){
		$username = $user["username"];
		if($classid == "error"){
			$code = -1;
			$msg = "暂时不支持非列表类型！";
		}
		if($classid>0){
			$insert_id = push_data($classid);
			$msg = "success！";
			//$msg = get_data($classid,$insert_id);
			// if(!$insert_id){
			// 	$code = 1004;
			// 	$msg = "！";			
			// }
		}else{
			$code = -1;
			$msg = "无效动作！";
		}
	}
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


function push_data($classid){
	global $lnk;
	global $msg;
	global $code;
	global $username;

	$user_name=$username;
	$insertid=0;
	$filed_arr = get_attr($classid);
	$insert_sql_k="";
	$insert_sql_v="";
	$update_sql="";
	$id=@$_POST["id"]+0;

	$sort_id =  @$_POST['t']+0;
	$px      =  @$_POST['px']+0;
	$name    =  @$_POST['name'];
	if(!$name){
		$code = -1;
		$msg = "缺少参数 name ！";
		return;
	}
	if($px>0){
		$update_sql   .= ",px='$px'";
		$insert_sql_k .=  ",".$px;
		$insert_sql_v .=  ",'".$px."'";
	}
	if($sort_id>0){
		$update_sql   .= ",sort_id='$sort_id'";
		$insert_sql_k .=  ",sort_id";
		$insert_sql_v .=  ",'".$sort_id."'";
	}

	foreach ($filed_arr as $v) {

		$vn=$v["name"];
		$$vn = @$_POST[$vn];

		$value = $$vn;

		if($v["type"]==1){
			if($vn == "diy_pic"){
				$base64_img= @$_POST["diy_pic"];
				if($base64_img){
					$image = explode(',',$base64_img);
					$image = $image[1];
					$imgName=date('YmdHis',time()).rand(100,999).".jpeg";
					file_put_contents("../admin/temp/".$imgName, base64_decode($image));
					$value = $imgName;
					$base64_img="";
				}
			}else{
				$path_img= @$_FILES[$vn]['name'];
				if($path_img){
					$ex_arr = explode(".",$path_img);
					$ex = $ex_arr[count($ex_arr)-1];

					$ex_ok = "jpeg|jpg|gif|pdf|doc|docx|xls|xlsx|pdm|txt|ppt|pptx|mp3|mp4|avi";
					if(!strstr($ex_ok,$ex)){
						$code = -1;
						$msg ="不支持的格式！";
						return;
					}

					$imgPath=date('YmdHis',time()).rand(100,999).$ex;
					move_uploaded_file($_FILES[$vn]['tmp_name'],"../admin/temp/".$imgName);
					$value = $imgPath;
				}
			}
			
		}

		if($id>0){
			if($value){
				$update_sql   .= ",".$vn."='".$value."'";
			}
		}else{
			if($value){
				$insert_sql_k .=  ",".$vn;
				$insert_sql_v .=  ",'".$value."'";
			}
		}	
	}

	


	if($id>0){
		$sql = "update attr_list_$classid set name='$name',username='".$user_name."' $update_sql  where id =$id";
	}else{
		$sql = "insert into attr_list_$classid (name,username $insert_sql_k) values('$name','".$user_name."' $insert_sql_v)";
	}
	//echo $sql;
	$lnk -> query($sql);
	$msg =  mysqli_insert_id($lnk);

}

function get_data($classid,$id){
	global $lnk;
	$data_arr=array();
	$result=$lnk -> query("select * from attr_list_$classid where id=$id");
	while ($rs=mysqli_fetch_assoc($result)){
		$data_arr = $rs;
	}
	return $data_arr;
}


function get_attr($classid){
	global $lnk;
	$data_arr=array();
	$result=$lnk -> query("select * from tableattr where list_id=$classid");
	while ($rs=mysqli_fetch_assoc($result)){
		$data_arr[]=$rs;
		//array_push($data_arr,$rs["name"]);
	}
	return $data_arr;

}


function get_action($action){
	global $lnk;
	$result=$lnk -> query("select * from  mainbt1 where webpath='$action'");
	while ($data=mysqli_fetch_assoc($result)){
		if($data["typea"]!=2)
			return "error";
		else
			return $data["id"]+0;
	}
	return 0;
}



$arr=array("code"=>$code,"data"=>$msg);
echo json_encode($arr);
?>