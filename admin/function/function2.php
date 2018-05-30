<?php 
#++++++++++++++++++共公参数++++++++++++++++++++++++=
$minDistance=0.1; //距离地图最少的范围
$userinfo=array("sitename"=>"智能标牌系统");   //用户基本信息可扩展


# ============共公函数=======================
#弹出对话框
function alert($message){echo ("<script>alert('". $message ."')</script>");}
#返回上一页
function GoBack(){echo("<script>history.back()</script>");}
#重定向另外的连接
function Go($url){echo ("<script>location.href='" . $url . "';</script>");}
function parentGo($url){echo ("<script>window.parent.location.href='" . $url . "';</script>");}

//EMAIL
function emailCheck($email){
if (preg_match("/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/",$email)) {return true;}else{return false;} 
}
//手机检测
function mobileCheck($num){
	if (preg_match("/^1[3-9]{1}[0-9]{9}$/",$num)) {return true;}else{return false;} 
}
//取中文字符前几位两字节算一个中文
function substr_coral($title,$num){
	if (strlen($title)>=$num){
		$c=substr($title,0,$num);
		$gb=0;
		for ($i=0;$i<$num;$i++){
			if (ord($c{$i})>127){$gb++;}  
		}
		$gb%2!=0?$out=substr($title,0,$num-1): $out=substr($title,0,$num);
		$out.="..";
	}else
	   {
	   $out=substr($title,0);
	   }
	return $out;
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
//权限识别
function yn($id,$admin){
	$edit_data=$lnk -> query("select * from vg_agent where telphone='".$admin."' or email= '".$admin."'");
	while($rs=mysql_fetch_array($edit_data))
	{
		$numid=explode("|",$rs["purview"]);
		if (in_array($id,$numid)){return "checked='checked'";}
	}
	return false;
}

//返回ID转换
function id_to_return($table,$id,$return){
	$edit_data=$lnk -> query("select $return from $table where id=$id");
	if($rs=mysql_fetch_array($edit_data))
	{
		return $rs[$return];
	}
	return false;
}

//返回ID转换
function return_to_id($table,$return,$value){
	$edit_data=$lnk -> query("select id from $table where $return='".$value."'");
	if($rs=mysql_fetch_array($edit_data))
	{
		return $rs["id"];
	}
	return false;
}

//随意转换
function n_to_return($table,$key,$value,$return){
	$edit_data=$lnk -> query("select $return from $table where $key='$value'");
	if ($edit_data){
	if($rs=mysql_fetch_array($edit_data))
	{
		return $rs[$return];
	}
	}
	return false;
}
//优化表记录统计
function total($table,$where){
	$result_total=$lnk -> query("select count(0) from $table $where");
	if($result_total)
	{
		$temp=mysql_fetch_row($result_total);
		return $temp[0]+0;
	}
}
//返回第一个字符集
function query_index($table,$where){
	$temp=array();
	$result=$lnk -> query("select 0 from $table $where");
	while ($row = mysql_fetch_array($result)){
		$temp[]=$row;
	}
	return $temp;
}
//优化表记录求和
function sum($table,$value,$where){
	$result_sum=$lnk -> query("select sum($value) from $table $where");
	if($result_sum)
	{
		$temp=mysql_fetch_row($result_sum);
	}else{
	}
	return $temp[0]+0;
	
}
//返回指定二维数组和  sum_array($query,3)
function sum_array($array,$num,$where=""){
	if(count($array)==0)return 0;
	foreach ($array as $key){
		if ($where){
			if($key[$num]==$where){$value+=$key[$num];}
		}
		else
		$value+=$key[$num]; 
	}
	return $value;
}

//数组排列    参数：$arr 二维数
function multi_array_sort($arr,$shortKey,$short=SORT_DESC,$shortType=SORT_REGULAR)
{
	if(empty($arr))return $arr;
	foreach ($arr as $key => $data){
		$name[$key] = $data[$shortKey];
	}
	array_multisort($name,$shortType,$short,$arr);
	return $arr;
}

if(isset($_GET['pager_PageID'])or isset($_POST['pager_PageID'])){
	isset($_GET['pager_PageID']) ? $pager_PageID =intval($_GET['pager_PageID']): $pager_PageID =intval($_POST['pager_PageID']);
}else{
	$pager_PageID = 1;
}
//< 4 5 6 7 8 9 10 11 12 >分页样式支持多页自动省去 调用过程可调用 select 0 form table 置入
function pages($arr,$pager_Size,$pager_PageID,$url){   //pages(数组，地址，分页尺寸，当前页,传参)
	$pager_Total = count($arr);//记录总数，每页显示记录条数，总页数
	$pager_Number = ceil($pager_Total/$pager_Size);
	$pager_PageID>$pager_Number?$pager_PageID=$pager_Number:"";
	$pager_PageID == 1 ?$pager_StartNum =0: $pager_StartNum = ($pager_PageID -1) * $pager_Size;  //每页的起，始记录数	
	$pager_EndNum = $pager_StartNum + $pager_Size;
	$view=8;
	$pager_PageID-($view/2)>0 ? $CounterStart=$pager_PageID-($view/2):$CounterStart=1;
	$pager_PageID+($view/2)<$pager_Number?$CounterEnd=$pager_PageID+($view/2):$CounterEnd=$pager_Number;
	if($pager_Number-$pager_PageID<($view/2) and $pager_Number>$view){$CounterStart=$pager_Number-$view;}
	if($pager_PageID-($view/2)<=0 and $pager_Number>$view){$CounterEnd=$view+1;}
	for($c=$CounterStart;$c<=$CounterEnd;$c++){
        if($c==$pager_PageID){
        	$n.= " <a href=?pager_PageID=$c".$url." class='orange'><strong>$c</strong></a> ";
    	}else{
			$n.=" <a href=?pager_PageID=$c".$url.">$c</a> ";
		}
    }
		$pager_top = "<a href=?pager_PageID=1".$url." class='orange'><strong><</strong></a> ";
		$pager_end= " <a href=?pager_PageID=$pager_Number".$url." class='orange'><strong>></strong></a>";
		$pageshow=$pager_top.$n.$pager_end;
		return  array("page_show"=>$pageshow,"pager_PageID"=>$pager_PageID-1,"max_page"=>$pager_Size,"total_page"=>$pager_Number,"request_url"=>$url);		
}
//从品牌ID直接链接数据库
function brand_to_connent($id){
	conn();
	$result=$lnk -> query("select server_ip,server_root,server_pwd,server_db,server_port from vg_brand where id=$id");
	while($rs=mysql_fetch_array($result))
		{
			if(connect($rs[0],$rs[1],$rs[2],$rs[3],$rs[4])=="connect_no"){
			$server_info="<p style='color:red'>IP:".$rs[0].":".$rs[4]."</p>";
			}elseif(connect($rs[0],$rs[1],$rs[2],$rs[3],$rs[4])=="database_no"){
			$server_error_info="<p style='color:red'>IP:".$rs[0].":".$rs[4]." 选择数据库".$rs[3]."失败！</p>";
			}else{
			$server_info="pass";
			}
		}
		return $server_info;
}
function get_city($area_code){
	$area_name=n_to_return("vg_area","code",$area_code,"name");
	$area_p_code=n_to_return("vg_area","code",$area_code,"citycode");
	$city_name=n_to_return("vg_city","code",$area_p_code,"name");
	$city_p_code=n_to_return("vg_city","code",$area_p_code,"provincecode");
	$province_name=n_to_return("vg_province","code",$city_p_code,"name");
	return $province_name." ".$city_name." ".$area_name;
}
//二维数组去重复
function a_array_unique($array)
{
   $out = array();
   foreach ($array as $key=>$value) {
       if (!in_array($value, $out))
       $out[$key] = $value;
   }
   return $out;
} 

//二维数组指定键去重复
function key_array_unique($array,$key)
{
	$tmp="";
	foreach ($array as $v){
		if (!strstr($tmp,$v[$key]."|||")){
			$newarray[]=$v;
		}
		$tmp.=$v[$key]."|||";
	}
	return $newarray;
} 

//返回指定二维数组个数去重复 
function a_total_array($array,$num,$where=""){
	if(count($array)==0)return 0;
	foreach ($array as $key){
		if ($where){
			if($key[$num]==$where){$value.=$key[$num]."|||";}
			}
		else{
		$value.=$key[$num]."|||"; 
		}
	}
	$result = array_unique(array_filter(explode("|||",$value)));
	return count($result);
}
//取二维数组最大值，最小值（$ayyay[数组名]，$num[要取值的键名]，$asc["asc取最小值 除asc以外取最大值desc"]）
function a_to_array($array,$num,$asc="desc"){
	if(count($array)==0)return 0;
	foreach ($array as $key){
		$value.=$key[$num]."|||"; 
	}
	$result=array_filter(explode("|||",$value));
	if ($asc=="asc")
		array_multisort($result,SORT_ASC);
	else
		array_multisort($result,SORT_DESC);
	return $result;
}

function createMenu($ACCESS_TOKEN,$data) //创建菜单
	{  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$ACCESS_TOKEN}");  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $tmpInfo = curl_exec($ch);  
        if (curl_errno($ch)) {  
            echo 'Errno'.curl_error($ch);  
        }  
        curl_close($ch);  
        $temp=explode("\"",$tmpInfo);
        return $temp[5]; 
    }  

//自定义菜单中获取access_token
function get_access_token($appid,$secret) //得到TOKEN
	{  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret);  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $tmpInfo = curl_exec($ch);  
        curl_close($ch);  
		$temp=explode("\"",$tmpInfo);
        return $temp[3];
    }  
//得到用户列表
function get_user($token)
	{  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token");  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $tmpInfo = curl_exec($ch);  
        curl_close($ch);  
		$temp=explode("\"",$tmpInfo);
        return  $tmpInfo;
    }
	
function get_user_info($token,$openid) //得到TOKEN
	{  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN");  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $tmpInfo = curl_exec($ch);  
        curl_close($ch);  
		$temp=explode("\"",$tmpInfo);
        return  $tmpInfo;
    }
	
//得到媒体
function playlistID($id){
	$playlistIDR=$lnk -> query("SELECT CurrentPlaylistID FROM data_ddns  where DeviceNum=$id"); 
	while ($playlistIDRow = mysql_fetch_array($playlistIDR)){return $playlistIDRow[0];}
	return 0;
}
//得到名称
function playlist($id){
	$playlistresult=$lnk -> query("SELECT title FROM data_playgroup  where id=$id"); 
	while ($playlistRow = mysql_fetch_array($playlistresult)){return $playlistRow[0];}
	return "设备未使用";
}
function playnum($id){
	$playlistresult=$lnk -> query("SELECT count(0) FROM data_playlist  where PlaylistID=$id"); 
	while ($playlistRow = mysql_fetch_array($playlistresult)){return $playlistRow[0];}
	return 0;
}

//组是否存在
function DeviceGroupRS($DeviceNum)
{
	$Gresult=$lnk -> query("SELECT 0 FROM data_taskgroup where DeviceID=$DeviceNum"); 
	while ($GRow = mysql_fetch_array($Gresult)){return true;}
	return false;
}
//下载是否存在
function DeviceUploadRS($DeviceNum,$MediaID)
{
	//echo ("SELECT 0 FROM data_devicemedia where DeviceID=$DeviceNum and MediaID=$MediaID"); 
	$Gresult=$lnk -> query("SELECT 0 FROM data_devicemedia where DeviceID=$DeviceNum and MediaID=$MediaID"); 
	while ($GRow = mysql_fetch_array($Gresult)){return true;}
	return false;
}
function BToKM($num)
{
	switch($num)
	{
		case 0:
		$r="0KB";
		break;
		case $num>=(1024*1024*1024):
		$r=round(($num/1024/1024/1024),2)."GB";
		break;		
		case $num>=(1024*1024):
		$r=round(($num/1024/1024),2)."MB";
		break;
		default:
		$r=round(($num/1024),2)."KB";
		break;
	}
	return $r;
}

//得到IP
function get_real_ip()
{
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		$ip = $_SERVER["HTTP_CLIENT_IP"];

	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
			$ip = $ips[$i];
			break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

//设备状态
function DeviceStatus($did){
	$DSresult=$lnk -> query("SELECT sleep,LastUpdateTime  FROM data_ddns where DeviceNum='$did' order by id desc limit 0,1");
	while ($DSrow = mysql_fetch_array($DSresult)){
		$sleep=$DSrow["sleep"]+0;
		$LastUpdateTime=strtotime($DSrow["LastUpdateTime"]);
	}
	if($sleep){
		if(strtotime("now")-$LastUpdateTime>1800)
			return "失联";
		else
			return "休眠";
	}elseif(strtotime("now")-$LastUpdateTime>60)
		return "失联";
	else
		return "正常";
}

//得到用户ID
function FanID($str){
	$edit_data=$lnk -> query("select id from data_fans  where OpenID='".$str."'");
	if($rsa=mysql_fetch_array($edit_data)){return $rsa["id"];}
}

function FansOpenID($id){
	$edit_data=$lnk -> query("select OpenID from data_fans  where id='".$id."'");
	if($rsa=mysql_fetch_array($edit_data)){return $rsa["OpenID"];}
}
//得到当前用户的XY值
function getXY($u){
	$edit_data=$lnk -> query("select Latitude,Longitude from data_fans  where OpenID='".$u."'");
	if ($edit_data)
	if($rsa=mysql_fetch_array($edit_data)){return array("Latitude"=>($rsa["Latitude"]+0),"Longitude"=>($rsa["Longitude"]+0));}
}
//CURLget发送数据
function getsend($url){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,false);  
		curl_exec($ch);  
        curl_close($ch);  
}
//curlPOAT 发送数据
function postsend($url,$data){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,false);  
		curl_exec($ch);  
        curl_close($ch);  
}

?>