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
$code= 0;

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
		$msg = get_list($classid,$sortid,$pagemin,$pagemax,$search,$order_by,$order_asc,$id);
		if(count($msg)==0){
			$code = 1004;
			$msg = "暂无数据！";			
		}
	}else{
		$code = 1002;
		$msg = "无效动作！";
	}
}

function get_list($classid,$sortid,$pagemin,$pagemax,$search,$order_by,$order_asc,$id=0){

	global $lnk;
	//初值化值
	$sortidsql = intval($sortid)>0 ? "  and  sort_id = ".intval($sortid) : "";
	$pn = $pagemin ? intval($pagemin) : 0;
	$px = $pagemax ? intval($pagemax) : 10;
	$searchsql = $search ? "and name like'%".$search."%'" : "";
	$order_by = intval($order_by)>0  ? intval($order_by) : 1;
	$order_asc = intval($order_asc)>0 ? "desc" : "asc";
	$list =array();
	$count = 0;

	//得到记录数
	$result_count=$lnk -> query("select 0 from  attr_list_".$classid." where 1=1 $sortidSql $searchsql");
	$count = mysqli_num_rows($result_count);

	if($id>0) {
		$sql ="select * from  attr_list_".$classid." where id = $id";
	}else{
		$sql = "select * from  attr_list_".$classid." where 1=1 $sortidSql $searchsql order by ".$order_by."  limit ".$pn.",".$px;
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



$arr=array("code"=>$code,"data"=>$msg);
echo json_encode($arr);
?>