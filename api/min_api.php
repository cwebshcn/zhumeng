<?php 
include '../admin/config/config.php';
include '../admin/function/function.php';  
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
@$pid=$_GET["pid"]+0;
@$sortname=$_GET["sortname"];
@$sortid=$_GET["sortid"]+0;
@$classid=$_GET["classid"]+0;
@$type=$_GET["type"]+0; //   1主目录列表 2分类列表 3 目录列表  4目录介绍 5 产品介绍
@$pagemin=$_GET["pagemin"] + 0;
@$pagemax=$_GET["pagemax"]?$_GET["pagemax"]+0:10;
@$sort="id";
@$order=$_GET["order"] ? $_GET["order"]." ," :"";
@$search=$_GET["search"];
$code=0;
$list=null;
$content=null;
//分类ID
if($sortname){
	$sortid=sortname_sortid($sortname)+0;
}

$keyname = "Tables_in_".$database_t;


@$parse=array(
	"code"=>$code,
	"classid"=>$classid,
	"sortid"=>$sortid,
	"pid"=>$pid,
	"pagemin"=>$pagemin,
	"pagemax"=>$pagemax,
	"sort"=>$sort,
	"order"=>$order,
	"type"=>$type,
	"search"=>$search
	);

function get_data($parse){
	global $lnk;
	global $keyname;
	if(!$parse["classid"] and !$parse["sortid"]){
		return "您传入的格式有误！";
	}
	$parse["code"]=0;

	
	$searchsql= $parse["search"] ? " and name like '%". $parse["search"]."%'":"";
	if($parse["classid"]>0)
		$classid=$parse["classid"];
	else{

		$result=$lnk -> query("select * from  sort where id='".$parse["sortid"]."'");
		while ($data=mysqli_fetch_assoc($result)){
			$classid=$data["list_id"];
			$parse["classid"]=$data["list_id"];
			
		}
	}
	//分类列表页
	if($parse["type"]==2 or $parse["type"]==0){
		$result=$lnk -> query("select * from  sort where list_id='$classid'");
		while ($data=mysqli_fetch_assoc($result)){$list_sort[]=$data;}  //输出分类列表
	}

	$sortidSql=$parse["sortid"]>0? " and sort_id='".$parse["sortid"]."'":"";

	//目录列表页
	
	//如果传值有目录ID	
	if($parse["classid"]){
		$mainid=getIdMianId($parse["classid"]);//得到上级ID
		$result=$lnk -> query("select * from  mainbt1  where left_id='$mainid'");
		while ($data=mysqli_fetch_assoc($result)){
			if($parse["type"]==4 or $parse["type"]==0)
				$list_menu_data[]=$data;
			if($data["id"]==$parse["classid"]) //如果当前目录ID与当前目录ID相同输出当前ID
				$content_menu_temp=$data;	//当前目录介绍
		}
		$list_menu=$list_menu_data;
	}

	if($parse["type"]==4 or $parse["type"]==0)
		$content_menu=$content_menu_temp;

	//是否存在列表
	$result=$lnk-> query("show tables");
	while ($data=mysqli_fetch_assoc($result)){$database[]=$data[$keyname];}

	if(in_array("attr_list_$classid",$database)){

		//产品/资讯列表页
		if($parse["type"]==3 or $parse["type"]==0){
			if($parse["pid"]>0){
				$result=$lnk -> query("select * from  attr_list_$classid  where 1=1 $sortidSql and id='".$parse["pid"]."'");
				while ($data=mysqli_fetch_assoc($result)){$content=$data;}
			}
		}

		if($parse["type"]==5 or $parse["type"]==0){
			$result=$lnk -> query("select * from  attr_list_".$parse["classid"]." where 1=1 $sortidSql $searchsql order by ".$parse["order"]." px limit ".$parse["pagemin"].",".$parse["pagemax"]);
			while ($data=mysqli_fetch_assoc($result)){$data["list_id"]=$parse["classid"]; $list[]=$data; }
		}
	}
	


	//目录列表，分类列表，产品列表;目录介绍，产品介绍
	return array("list_menu"=>$list_menu,"list_sort"=>$list_sort,"list"=>$list,"content_menu"=>$content_menu,"content"=>$content);
}







//lsit 例表 content 介绍  

$arr=array("code"=>$parse["code"],"data"=>get_data($parse));
echo json_encode($arr);
?>