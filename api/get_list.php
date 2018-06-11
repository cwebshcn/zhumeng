<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$action = @$_GET["s"];   //动作
$sortid = @$_GET["t"]+0; //分类
@$pagemin=$_GET["pn"] + 0; //页码
@$pagemax=$_GET["px"]?$_GET["px"]+0:10; //第几页
@$order_by=$_GET["ob"]+0; //排序字段
@$order_asc=$_GET["oa"]+0; //排序方式
@$search=$_GET["str"];
@$id =$_GET["id"]+0;
$tk = @$_POST["token"]; //用户
$teacher_user="err";
$code= 0;

if($tk){
	$tk_decode = json_decode(base64_decode($tk), true);
	if(is_array($tk_decode)){
		$u = $tk_decode["u"];
		$p = $tk_decode["p"];
		$t = $tk_decode["t"];
		$teacher_user = get_teacker_user($u);

	}else{
		//异常
		$arr=array("code"=>$code,"data"=>$msg);
		echo json_encode($arr);
	}
}


if(empty($action)){
	$code = 1001;
	$msg = "传值错误";
}else{
	$classid = get_action($action);
	if($classid == "error"){
		$code = 1003;
		$msg = "暂时不支持非列表类型！";
	}
	if($classid>0){
		$msg = get_list($classid,$sortid,$pagemin,$pagemax,$search,$order_by,$order_asc,$id,$teacher_user);
		if(count($msg)==0){
			$code = 1004;
			$msg = "暂无数据！";			
		}
	}else{
		$code = 1002;
		$msg = "无效动作！";
	}
}

function get_list($classid,$sortid,$pagemin,$pagemax,$search,$order_by,$order_asc,$id=0,$teacher_user="err"){

	global $lnk;
	//初值化值
	$sortidSql = $sortid>0 ? "  and  sort_id = ".$sortid : "";
	$pn = $pagemin ? intval($pagemin) : 0;
	$px = $pagemax ? intval($pagemax) : 10;
	$searchsql = $search ? "and name like'%".$search."%'" : "";
	$order_by = intval($order_by)>0  ? intval($order_by) : 1;
	$order_asc = intval($order_asc)>0 ? " desc" : " asc";
	$list =array();
	$count = 0;

	$teachersql = $teacher_user =="err" ? "" : $teacher_user;
	//得到记录数
	$result_count=$lnk -> query("select 0 from  attr_list_".$classid." where 1=1 $sortidSql $searchsql $teachersql");
	$count = mysqli_num_rows($result_count);

	if($id>0) {
		$sql ="select * from  attr_list_".$classid." where id = $id";
	}else{
		$sql = "select * from  attr_list_".$classid." where 1=1 $sortidSql $searchsql $teachersql order by ".$order_by.$order_asc."  limit ".$pn.",".$px;
	}

	$result=$lnk -> query($sql);
	while ($data=mysqli_fetch_assoc($result)){$list[]=$data;}
	return array("data"=>$list,"pages"=>ceil($count/$pagemax));
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

function get_teacker_user($u){
	global $lnk;
	$user = get_user_info($u);
	$userid= $user["id"]+0;
	$teacher_arr=array("");
	if(!$userid){
		return array();
	}
	$TRecord=$lnk -> query("select teacher from user_nexus where student=$userid ");
	while($rs=mysqli_fetch_assoc($TRecord))
    {
    	$user_arr =get_user_info("","",$rs["teacher"]);
    	$teacher_name = $user_arr["username"];
    	$teacher_arr[]=" or username = '".$teacher_name."'";
    }
    $teacher = implode(" ",$teacher_arr);
    return $teacher;
}


//得到数据
function get_user_info($u,$p="",$id=""){
	global $lnk;
	$userinfo=array();
	$pswd_sql = $p ? " and password='".md5($p)."'":'';
	$sql = "select * from user where username='".$u."' $pswd_sql";
	if($id>0)
		$sql ="select * from user where id='".$id."'";
	$TRecord=$lnk -> query($sql);
    while($rs=mysqli_fetch_assoc($TRecord))
    {

    	$userinfo = $rs;
    	$userinfo["password"]="";

    }
    return $userinfo;
}

$arr=array("code"=>$code,"data"=>$msg);
echo json_encode($arr);
?>