<?php 
# ============共公函数=======================
#弹出对话框
function alert($message){echo ("<script>alert('". $message ."')</script>");}
#返回上一页
function GoBack(){echo("<script>history.back()</script>");}
#重定向另外的连接
function Go($url){echo ("<script>window.location.href='" . $url . "';</script>");}

function parentGo($url){echo ("<script>window.parent.location.href='" . $url . "';</script>");}

//去除空格
function trimall($str)//删除空格
{
    $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
    return str_replace($qian,$hou,$str);    
}
//EMAIL
function emailCheck($email){
	if(preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$email)) {return true;}else{return false;} 
}
function mobileCheck($mobile){
	return preg_match('/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/i', $mobile) ? true : false; 
}

function telCheck($tel,$num)
{
	foreach ($tel as $value) 
	{ 
		$temp = explode(' ',$value); 
		return $temp[$num];
	} 
}
//ip
if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
  if ($_SERVER["HTTP_CLIENT_IP"]) {
  $proxy = $_SERVER["HTTP_CLIENT_IP"];
} else {
  $proxy = $_SERVER["REMOTE_ADDR"];
}
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

function substr_coral($title,$num){

if (strlen($title)>=$num){
$c=substr($title,0,$num);
$gb=0;
for ($i=0;$i<$num;$i++)
   {
   if (ord($c{$i})>127)
      {
       $gb++;
      }  
   }
if ($gb%2!=0)
  {
  $out=substr($title,0,$num-1);
  }   
   else
    {
    $out=substr($title,0,$num);
    }
$out.="..";
}
else
   {
   $out=substr($title,0);
   }
return $out;
}

//IP转地址
function ip_area( $c )
{
	$o = new Ip2Location;
	$p = "^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$";
	if ( eregi( $p, $c ) )
		{
			$o->qqwry( $c );
			$l = str_replace( 'CZ88.NET', '', ($o->Country . $o->Local) );
		}
		else
		{
			return( $c );
		}

return $l;
}


//动态二级目录(主目录ID,编号名ASCIIa-z)
function Menulist($id,$name){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where left_id=".$id."  order by px"); 
	$i=1;
	while ($kind=mysqli_fetch_assoc($result)){
		switch($kind['typea']){case 1:$typea="about";break;case 2:$typea="news";break;case 3:$typea="products";break;default:$typea="about";break;}
		echo ("<div class='menu_3' id='".$name.$i."' OnMouseOver='over(this)' onMouseOut='out(this)'><a href='".$typea.".php?classid=".$kind['id']."'>".$kind['leftname']."</a></div>");
		$i++;
	}
}
//动态二级目录sort(主目录ID,编号名ASCIIa-z)
function Sortlist($id,$name){
	global $lnk;
	$result=$lnk -> query("select * from sort where list_id=".$id."  order by px"); 
	$i=1;
	while ($kind=mysqli_fetch_assoc($result)){
		echo ("<div class='menu_3' id='".$name.$i."' OnMouseOver='over(this)' onMouseOut='out(this)'><a href='products.php?classid=".$kind['list_id']."&sortid=".$kind['id']."'>".$kind['sort_name']."</a></div>");
		$i++;
	}
}

//随意转换
function n_to_return($table,$key,$value,$return){
	global $lnk;
	$edit_data=$lnk -> query("select $return from $table where $key='$value'");
	if ($edit_data){
	if($rs=mysqli_fetch_assoc($edit_data))
	{
		return $rs[$return];
	}
	}
	return false;
}

//目录ID到标题
function getMenuInfo($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where id='".$classid."'"); 
	while ($rs=mysqli_fetch_assoc($result)){ return $rs;}
}

//目录ID到标题
function getIdTitle($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['leftname'];}
}
function webpath($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['webpath'];}
}

function webpathid($str){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where webpath='".$str."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['id'];}
}

//目录ID到内容
function getIdContent($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['body99'];}
}
//得到主目录ID
function getIdMianId($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt1 where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['left_id'];}
}
function getIdMainTitle($classid){
	global $lnk;
	$result=$lnk -> query("select * from mainbt where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['leftname_main'];}

}
function sortid_sortname($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['sort_name'];}
}


function pic_sortid($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where pic='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['id'];}
}


function sortid_sortname1($classid){
	global $lnk;
	$result=$lnk -> query("select * from sortinfo where sort_id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['sort_name'];}
}

function sortid_listid($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['list_id'];}
}

function sortid_pic($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['pic'];}
}

function sortid_sortpx($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){return $kind['px'];}
}
//分类到地区
function areaid_name($id){
	global $lnk;
	$area1=$lnk -> query("select * from area  where id=". $id." order by px");
	while($area2=mysqli_fetch_assoc($area1)){return $area2["name"];}
}

//价格分类
function vipnum_num($num){
	if ($num==100){return "1～99元";}
	if ($num==200){return "100～199元";}
	if ($num==300){return "200～299元";}
	if ($num==500){return "300～499元";}
	if ($num==1000){return "500～1000元";}
	if ($num==1001){return "1000元以上";}
	}


//获得当前的脚本网址 
function GetCurUrl() 
{ 
	if(!empty($_SERVER["REQUEST_URI"])) 
		{ 
			$scriptName = $_SERVER["REQUEST_URI"]; 
			$nowurl = $scriptName; 
		} 
		else 
		{ 
			$scriptName = $_SERVER["PHP_SELF"]; 
			if(empty($_SERVER["QUERY_STRING"])) 
		{ 
			$nowurl = $scriptName; 
		} 
		else 
		{ 
			$nowurl = $scriptName."?".$_SERVER["QUERY_STRING"]; 
		} 
	} 
	return $nowurl; 
} 

//产品ID到标题
function pidtotitle($classid){
	global $lnk;
	if (trim(basename($_SERVER['SCRIPT_NAME']))=="p_list.php"){
		$result=$lnk -> query("select * from products where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){ 
			if (trim($kind['web_title'])){return $kind['web_title'];}else{return $kind['name'];}
		}
	}elseif(trim(basename($_SERVER['SCRIPT_NAME']))=="n_list.php"){
		$result=$lnk -> query("select * from news where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){
		if (trim($kind['web_title'])){return $kind['web_title'];}else{return $kind['name'];}
		}
	}elseif(trim(basename($_SERVER['SCRIPT_NAME']))=="bottom_info.php"){
		$result=$lnk -> query("select * from news where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){
		if ($kind['web_title']){return $kind['web_title'];}else{return $kind['name'];}
		}
	}
}

//产品ID到keyword
function pidtocontent($classid){
	global $lnk;
	if (basename($_SERVER['SCRIPT_NAME'])=="p_list.php"){
		$result=$lnk -> query("select * from products where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){ 
		if ($kind['web_content']){return $kind['web_content'];}else{return $kind['name'];}
		}
	}elseif(basename($_SERVER['SCRIPT_NAME'])=="n_list.php"){
		$result=$lnk -> query("select * from news where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){ return ($kind['web_content']);}
	}

}


//产品ID到sortcontent
function pidtosortcontent($classid){
	global $lnk;
	if (basename($_SERVER['SCRIPT_NAME'])=="p_list.php"){
		$result=$lnk -> query("select * from products where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){ return ($kind['sortcontent']);}
	}elseif(basename($_SERVER['SCRIPT_NAME'])=="n_list.php"){
		$result=$lnk -> query("select * from news where pid='".$classid."'"); 
		while ($kind=mysqli_fetch_assoc($result)){ return ($kind['sortcontent']);}
	}

}



//产品ID到标题
function PIdTitle($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['name'];}
}

//产品到图片
function PIdPic($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['pic'];}
}

//产品到图片
function PIdmaxPic($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['maxpic'];}
}


//产品到价格
function PIdchunum($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['chunum'];}
}


function PIdqiangnum($classid){
	global $lnk;
	$result=$lnk -> query("select * from pro_products where pid='".$classid."' order by id desc"); //抢购商品
	if ($kind=mysqli_fetch_assoc($result)){
		$qid=$kind['qid'];
		//$now=date("Y-m-d h:i:s");
		$result2=$lnk -> query("select * from pro_qiang where id='".$qid."' and  Datediff(sdate,now())<0 and Datediff(odate,now())>0  order by sdate desc");  //抢购时间内
		if ($kind2=mysqli_fetch_assoc($result2)){
			$sdate=$kind2["sdate"];
			$odate=$kind2["odate"];
				$result3=$lnk -> query("select * from products where pid='".$classid."'"); //抢购价格
				if ($kind3=mysqli_fetch_assoc($result3)){ return $kind3['qiangnum']!="" ?  $kind3['qiangnum'] : false;} 
				//end 数据是否为空
		//end 时间
		}else{
			return false;
		}//end 活动结束
	}else{
	return false;
	}
	//end 抢购产品
}//end 函数



//产品到价格
function PIdvipnum($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['vipnum'];}
}

//产品到价格
function PIdnum($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['num'];}
}
//产品到分类
function PIdsort($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['sort_id'];}
}
//产品到分类
function PIdlist($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['list_id'];}
}

//
function PIdwebtitle($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['web_title'];}
}

//产品到分类
function sortid_name($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['sort_name'];}
}

//分类名到ID
function sortname_id($classid){
	global $lnk;
	$result=$lnk -> query("select * from sort where sort_name='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['id'];}
}

//产地ID到产地名称
function areaname($classid){
	global $lnk;
	$result = $lnk -> query("select * from area where id='".$classid."'");
	while ($kind=mysqli_fetch_assoc($result)){return $kind['name'];}
	}
	
//产地名到ID
function areaname_id($classid){
	global $lnk;
	$result=$lnk -> query("select * from area where name='".$classid."'"); 
	$i="";
	while ($kind=mysqli_fetch_assoc($result)){  
	if(!$i){$i=$kind['id'];}else{$i.=",".$kind['id'];}
	}
		return $i;
}

//用户地址
function getprovince($classid){
	global $lnk;
	$result = $lnk -> query("select * from province where code = '".$classid."'");
	while($kind = mysqli_fetch_assoc($result)){return $kind['name'];}
	
	}
	
function getcity($classid){
	global $lnk;
	$result = $lnk -> query("select * from city where code = '".$classid."'");
	while($kind = mysqli_fetch_assoc($result)){return $kind['name'];}
	
	}
	
function getcounty($classid){
	global $lnk;
	$result = $lnk -> query("select * from county where code = '".$classid."'");
	while($kind = mysqli_fetch_assoc($result)){return $kind['name'];}
	}

function PIdNum1($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['click'];}
}
function PIdNum2($classid){
	global $lnk;
	$result=$lnk -> query("select * from products where pid='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['fandj'];}
}

function cuser($name){
	global $lnk;
	$result=$lnk -> query("select * from user where username='".$name."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['id'];}
}

function viptype($name){
	global $lnk;
	$result=$lnk -> query("select * from vip where email='".$name."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['manage'];}
}

function couponnum($name,$rs){
	global $lnk;
	$result=$lnk -> query("select * from couponnum where username='".$name."' and coupon_id='$rs'");
	while ($kind=mysqli_fetch_assoc($result)){return $kind['coupon_id'];}
}
//从用户到昵称
function vipniname($name){
	global $lnk;
	$result=$lnk -> query("select * from vip where email='".$name."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['niname'];}
}


function buy_this($name,$id){
	global $lnk;
	$result=$lnk -> query("select * from vipstorage  where username='".$name."' and pid=".$pid);
	if($kind=mysqli_fetch_assoc($result)){return true;}else{return false;}
}


//地址ID到收货人
function address_PId_name($classid){
	global $lnk;
	$result=$lnk -> query("select * from vip_address where id='".$classid."'"); 
	while ($kind=mysqli_fetch_assoc($result)){ return $kind['add_name'];}
}
if (isset($_GET['pid'])){$pid=$_GET['pid'];}
if(isset($_GET['classid'])){$classid=$_GET['classid'];}

if(isset($_GET['sortid'])){$sortid=$_GET['sortid'];}

if(isset($_GET['areaid'])){$areaid=$_GET['areaid'];}

if(isset($_GET['vipnum'])){$vipnum=$_GET['vipnum'];}

function ckd($input1,$input2)
{
if (strstr($input1,$input2)){return " checked='checked'";}
}

function menu1($typeid,$classid,$ckid){
	global $lnk;
	$sql="select * from sort where type_id=".$typeid." and list_id=".$classid." order by px";
	$rsmain1=$lnk -> query($sql);
    while($rsmain=mysqli_fetch_assoc($rsmain1)){
		echo  "<option value=".$rsmain['id'];
	if ($ckid==$rsmain['id']){echo (" selected");}
	echo " style='font-size:12px;font-weight:bold'>";
	echo menu_num ($rsmain['id'],0);
	echo $rsmain['sort_name']."</option>";	
		if (MenuDown($rsmain['id'])){menu1 ($rsmain['id'],$classid,$ckid);}
}
}

function getsortid($sortid){
	global $lnk;
	$sql = "select * from sort where id=".$sortid;
	$res = $lnk -> query($sql);
	while($res = mysqli_fetch_assoc($res)){
		$type_id = $res['type_id'];
		$sql2 = "select * from sort where id=".$type_id;
		$res2 = $lnk -> query($sql2);
		while ($res2 = mysqli_fetch_assoc($res2)){
		return $type_id = $res2['id'];
		}
		}
	}

function get_sortid($sortid){
	global $lnk;
	$sql = "select * from sort where id='".$sortid."'";
	$res = $lnk -> query($sql);
	while($rs = mysqli_fetch_assoc($res)){
		if($rs['type_id']==0){
			$sortid = $rs['id'];
			}else{
				$sort_id = $rs['type_id'];
				$sortid = get_sortid($sort_id);
				}
				return $sortid;
		}
	
	}
//得到快递公司名称
function getfastname($send_cp){
	global $lnk;
	$sql = "select * from fast where company='".$send_cp."'";
	$res = $lnk -> query($sql);
	while($rs = mysqli_fetch_assoc($res)){
		return $rs['send_id'];
		}
	
	}

//得到上级目录
function getTypeId($sortid){
	global $lnk;
	$sql="select * from sort where id=".$sortid;
	$rsd1=$lnk -> query($sql);
    while($rsd=mysqli_fetch_assoc($rsd1)){
			return $rsd['type_id'];
}}
//得到无限分类所有下属ID
function sqlsortid($id,$start){
	global $lnk;
	$sql="select * from sort where type_id=".$id;
	//echo $sql;
	if ($start=="start"  or  $start==""){$sortid=$id;}
	else{$sortid=($start.",".$id);}
		$rsstyle1=$lnk -> query($sql);
		while($rsstyle=mysqli_fetch_assoc($rsstyle1)){
		$sortid=sqlsortid($rsstyle['id'],$sortid);
		}
		return $sortid;
}

//从模板加入内容
function index_area_pro($area){
	global $lnk;
	$sid="";
	$result=$lnk -> query("select * from index_area where area='".$area."'  order by id"); 
	while ($kind=mysqli_fetch_assoc($result)){
		if ($sid)
		$sid.=",".sqlsortid($kind["sortid"],"start");
		else
		$sid=sqlsortid($kind["sortid"],"start");
	}
	return $sid;
}

function index_area($area,$only){
	global $lnk;
	$sid="";
	$result=$lnk -> query("select * from index_area where area='".$area."'  order by id"); 
	while ($kind=mysqli_fetch_assoc($result)){
		if ($sid)
		$sid.="&nbsp;&nbsp;<a href='".sortid_pic($kind["sortid"])."'>".sortid_sortname($kind["sortid"])."</a>";
		else{
		$sid="<a href='".sortid_pic($kind["sortid"])."'>".sortid_sortname($kind["sortid"])."</a>";
		if ($only){return "<a href='".sortid_pic($kind["sortid"])."'>更多&gt;&gt;</a>";}
		}
	}
	return $sid;
}

//下级是否有菜单
function MenuDown($typeid){
	global $lnk;
	$sql="select * from sort where type_id=".$typeid;
	$rs1=$lnk -> query($sql);
    while($rs=mysqli_fetch_assoc($rs1)){return 1;}
	return "";
}
//得到根目录
function memu_top($id){
	if($rs=mysqli_fetch_assoc($lnk -> query("select * from sort where id=".$id))){
		return $rs['type_id']==0 ? $id : memu_top($rs['type_id']);
	}
}
//得到根目录名
function memu_topname($id){
	if($rs=mysqli_fetch_assoc($lnk -> query("select * from sort where id=".$id))){
		return $rs['type_id']==0 ? $rs['sort_name'] : memu_topname($rs['type_id']);
		}
	}

//递归得到阶层
function menu_num($id,$i){
	static $i;
	global $i,$lnk;
	$sql="select * from sort where id=".$id;
	$rsstyle1=$lnk -> query($sql);
    if($rsstyle=mysqli_fetch_assoc($rsstyle1)){
		menu_num ($rsstyle['type_id'],++$i);
		}
		return menu_j($i);
}
function menu_j($i){
	switch ($i){
	case 1:
		return "";break;
		case 2:
		return "├ ";break;
		case 3:
		return "　├ ";break;
		case 4:
		return "　　├ ";break;
		case 5:
		return "　　　├ ";break;
		default:
		return $i;break;
}}



	
//目录样式输出
function style1($i){
switch($i){
		case 0:
		return "font-size:16px;font-weight:bold;padding-left:4px;margin-left:4px;background:#003950";
		break;
		case 1:
		return "font-size:16px;font-weight:100;padding-left:4px;margin-left:8px;background:#004960";
		break;
		case 2:
		return "font-size:14px;font-weight:bold;padding-left:4px;margin-left:16px;background:#106980";
		break;
		case 3:
		return "font-size:14px;font-weight:100;padding-left:4px;margin-left:24px;background:#207696";
		break;
		case 4:
		return "font-size:12px;font-weight:bold;padding-left:4px;margin-left:32px;background:#178296";
		break;
		default:
		return "font-size:12px;font-weight:100;padding-left:4px;margin-left:32px;background:#278296";
		break;
}
}
//递归得到递归次数
function style($id,$i){ 
	static $i;
	global $i;
	$sql="select * from sort where id=".$id; 
	$rs1=$lnk -> query($sql); 
	while($rsd=mysqli_fetch_assoc($rs1)){ 
	style($rsd['type_id'],++$i); 
	} 
	return style1($i); 
} 
function recursion($a)
{
    if ($a < 20) {
        echo "$a\n";
        recursion($a + 1);
    }
}

function getect($file_name) 
{ 
$pos=strpos($file_name,"."); 
if($pos!=false) 
{ 
$ect=getect(substr($file_name,$pos+1)); 
} else $ect=$file_name; 
return $ect; 
} 

//清除WORD
function clearword($str){
//$str1=str_replace("/^<div[^<>]*>$/","<div>",$str);
$str1=preg_replace("/<P[^<>]*>/","<p>",$str);
$str1=preg_replace("/<\?xml[^<>]*>/","",$str1);
$str1=preg_replace("/<SPAN[^<>]*>/","<span>",$str1);
$str1=preg_replace("/<FONT[^<>]*>/","<font>",$str1);
$str1=str_replace("<o:p></o:p>","",$str1);
return $str1;
}

function checkemail($inaddress)
{
return (ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+",$inaddress));
}
function getmail($inaddress){
	$sql = "select * from vip where email='".$inaddress."'";
	$res = $lnk -> query($sql);
	while($rs = mysqli_fetch_assoc($res)){
		return $rs['mail'];
		}
	}

function excu_php($classid){
	global $lnk;
	$sql="select * from pagepart where list_id=".$classid;
	$rs1=$lnk -> query($sql);
	if($rs1){
    while($rs=mysqli_fetch_assoc($rs1)){
		$content=str_replace('"',"'",$rs["content"]);
		$content=str_replace("\n","",$content);
		$content=str_replace("<p>","",$content);
		$content=str_replace("</p>","",$content);
		$indexcode=$rs["indexcode"];
		global $$indexcode;
		$$indexcode=$content;
		}
	}
}


function excu($classid){
	global $lnk;
	$sql="select * from pagepart where list_id=".$classid;
	$rs1=$lnk -> query($sql);
	$ex="<script>";
	if($rs1){
    while($rs=mysqli_fetch_assoc($rs1)){
		$content=str_replace('"',"'",$rs["content"]);
		$content=str_replace("\n","",$content);
		$content=str_replace("<p>","",$content);
		$content=str_replace("</p>","",$content);		
		if($rs["type"]==1){
			if(!strpos($rs["content"],"/"))
			$ex.='$("#'.$rs["indexcode"].'").attr("src","admin/temp/'.$content.'");';
			
		}elseif($rs["type"]==2){
			if(!strpos($rs["content"],"/"))
			$ex.='$("#'.$rs["indexcode"].'").css("background-image","url(admin/temp/'.$content.')");';
		}
		else
		{
			$ex.='$("#'.$rs["indexcode"].'").html("'.$content.'");';
		}
	}
	}
	$ex.="</script>";
	return $ex;
}

//zhuml
function ynml($id,$admin){
	$edit_data=$lnk -> query("select * from mainbt where id='".$id."'");
	while($rs2=mysql_fetch_array($edit_data))
	{
		if (yn($rs2["id"],$admin)){return true;}else{return false;}
	}
}

//得么第一个子目录
function menu_one($id,$admin){
	global $lnk;
	$edit_data=$lnk -> query("select * from mainbt1 where left_id='".$id."' order by px");
	while($rs2=mysqli_fetch_assoc($edit_data))
	{
		if (yn($rs2["id"],$admin)){return array("typea"=>$rs2["typea"],"id"=>$rs2["id"]);}
	}
	return 0;
}


//子目录
function yn($id,$admin){
	global $lnk;
	$edit_data=$lnk -> query("select * from manage where username='".$admin."'");
	while($rs=mysqli_fetch_assoc($edit_data))
	{
		$numid=explode("|",$rs["manage"]);
		foreach ($numid as $v){
			if ($v==$id){ return "checked='checked'";}
		}
	}
}
function phpname($id){
	global $lnk;
	$pagetype1=$lnk -> query("select * from pagetype where id=$id");
	if($pagetype1){
	while($pagetype=mysqli_fetch_assoc($pagetype1)){
		return $pagetype['linkd'];
		}
	}
		return "#";
}  

?>