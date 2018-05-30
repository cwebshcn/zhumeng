<?php include 'config/admin.php';
set_time_limit(0);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="后台管理">
<meta name="keywords" content="后台管理">
<meta name="author" content="code by vic.tang">
<title>后台管理</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="css/h5style.css" rel="stylesheet">
<!--------UE------->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>
<?php
//=------------动作说明-------------------
@$action=$_GET['act']; #获取动作
@$menuid=$_GET['menuid']+0; #得到当前目录ID
@$sortid=$_GET['sortid']+0; #得到当前分类ID
@$pid=$_GET['pid']+0; #得到当前ID
if($menuid==""){alert("ID丢失，请重新选择！");}
//是否有图片
$attr = $lnk->query('DESCRIBE attr_list_'.$menuid);
$tables=array();
if($attr){
while($arr = $attr->fetch_assoc()){
$tables[]=$arr["Field"];
}
}
?>
<script language=javascript>
//删除子目录确认
function  confirmLink(id)
{
if(confirm("确认要删除吗？删除后将不能恢复！") ){
location.href="?menuid=<?php echo $menuid?>&act=del&pid="+id;
}
}
</script>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：数据管理 >><?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td class="text-center font24"><strong><?php echo getIdTitle($menuid)?>
<br>
<span style="font-size:14px;">
<a href="WeixinSendList.php?act=upload&menuid=<?php echo $menuid?>"><span class='glyphicon glyphicon-download-alt'></span> 微信数据更新下载</a> &nbsp;&nbsp;&nbsp; <a href="WeixinSendList.php?act=update&menuid=<?php echo $menuid?>"><span class='glyphicon glyphicon-refresh'></span> 全部同步到服务器</a> </span>
<?php
if($sortid)
echo " > ".sortid_sortname($sortid)?>
</strong></td>
</tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName">
<tr>
<td width="60%"><strong>标题</strong></td>
<td width="10%"><strong>自带分类</strong></td>
<td width="10%"><strong>发布日期</strong></td>
<td width="20%"><strong>操作</strong></td>
</tr>
<?php
$sql="select * from  curl_wx order by pass,date desc,mid";
$result=$lnk->query($sql);
while ($rs=mysqli_fetch_assoc($result)){
?>
<tr>
<td><a href="http://mp.weixin.qq.com/s?__biz=<?php echo $rs["biz"];?>==&mid=<?php echo $rs["mid"];?>&idx=1&sn=<?php echo $rs["sn"];?>#rd" target="_blank"><?php echo $rs["title"];?></a></td>
<td><?php echo $rs["types"];?></td>
<td><?php echo $rs["date"];?></td>
<td><form name="get<?php echo $rs["mid"];?>" action="WeixinSendList.php">
<input name="act" type="hidden" value="update">
<input name="menuid" type="hidden" value="<?php echo $menuid;?>">
<input name="mid" type="hidden" value="<?php echo $rs["mid"];?>">
<select name="sortid">
<?php
$sql="select * from  sort where list_id=1 order by px,id desc";
$resultsort=$lnk->query($sql);
while ($sort=mysqli_fetch_assoc($resultsort)){	?>
<option value="<?php echo $sort["id"];?>" <?php
if(sortname_sortid($rs["types"])==$sort["id"])
echo "selected='selected'";
?>><?php echo $sort["sort_name"];?></option>
<?php }?>
</select><?php
if($rs["pass"]==2)
echo "已同步到本地数据库";
else
echo "<button type='submit' class='btn-info btn-sm'>同步</button>";
?>
</form>
</td>
</tr>
<?php }?>
</table>
<?php
//更新已发布资讯
$cookie_file = tempnam('./temp','cookie');   //配置COOKIES路径
if($action=="upload"){
//模拟微信登入  得到COOKIES
$login_url = 'https://mp.weixin.qq.com/cgi-bin/login';
$data = 'f=json&imgcode=&pwd=c8fe28f25e02346cbfa5d55e9bc04e7d&username=admin@fawubu.com';
$ch = curl_init($login_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_REFERER,'https://mp.weixin.qq.com');
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$content = curl_exec($ch);
curl_close($ch);
$newurl = json_decode($content,1);
$newurl = $newurl['redirect_url'];
//获取登入后的目录TOKEN
$go_url = 'https://mp.weixin.qq.com'.$newurl;
$content=curl_wx($go_url);
preg_match('/send&token=(.*?)&lang=zh_CN/',$content,$matched);
$tokentmp=$matched[1]; //得到链接TOKEN
//获取记录总数
$go_url = "https://mp.weixin.qq.com/cgi-bin/masssendpage?t=mass/list&action=history&begin=0&count=10&token=$tokentmp&lang=zh_CN";
$content=curl_wx($go_url);
//得到页码
preg_match('/total_count : (.*?),/',$content,$pagecount);
$page=ceil($pagecount[1]/50);
if($pagecount[1]>0){
preg_match('/__biz=(.*?)==&mid=/',$content,$biz); //如果总记录数大于0那么加载数据
//目前数据页数
$mid=array();
$sn=array();
$date=array();
$title=array();
for ($i=0;$i<$page+1;$i++){
$go_url = "https://mp.weixin.qq.com/cgi-bin/masssendpage?t=mass/list&action=history&begin=".($i*50)."&count=50&token=$tokentmp&lang=zh_CN";
$content=curl_wx($go_url);
preg_match_all('/==&mid=(.*?)&idx/',$content,$mid1);
preg_match_all('/&sn=(.*?)#/',$content,$sn1);
preg_match_all('/"date_time":(.*?),"content":/',$content,$date1);
preg_match_all('/"msg_status":2,"title":"(.*?)",/',$content,$title1);
$mid=array_merge($mid,$mid1[1]);
$sn=array_merge($sn,$sn1[1]);
$date=array_merge($date,$date1[1]);
$title=array_merge($title,$title1[1]);
}
$sql_temp="";
for ($n=0;$n<count($mid);$n++){
@$titlename=str_replace("丨","|",$title[$n]);
$titlename=explode("|",$titlename);
@$titles= strlen($titlename[0])>strlen($titlename[1])? $titlename[0]:$titlename[1];
@$types= strlen($titlename[1])>strlen($titlename[0])? $titlename[0]:$titlename[1];
if(!midupdate($mid[$n])){
$sql="REPLACE into curl_wx(mid,biz,sn,date,title,types,content)values('".$mid[$n]."','".$biz[1]."','".$sn[$n]."','".date("Y-m-d H:i:s",$date[$n])."','".$titles."','".$types."','')";
$lnk->query($sql);
$sql_temp.=$sql."|".$title[$n]."<br>";
}
}
alert("导入成功！");
go("WeixinSendList.php?menuid=$menuid");
}
}
//同步更新数据
if($action=="update"){
//模拟微信登入  得到COOKIES
$login_url = 'https://mp.weixin.qq.com/cgi-bin/login';
$data = 'f=json&imgcode=&pwd=c8fe28f25e02346cbfa5d55e9bc04e7d&username=admin@fawubu.com';
$ch = curl_init($login_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_REFERER,'https://mp.weixin.qq.com');
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$content = curl_exec($ch);
curl_close($ch);
$newurl = json_decode($content,1);
$newurl = $newurl['redirect_url'];
//获取登入后的目录TOKEN
$go_url = 'https://mp.weixin.qq.com'.$newurl;
$content=curl_wx($go_url);
preg_match('/send&token=(.*?)&lang=zh_CN/',$content,$matched);
$tokentmp=$matched[1]; //得到链接TOKEN
@$mid=$_GET["mid"];
@$sortid=$_GET["sortid"]+0;
if($mid)
$midsql=" and mid='$mid'";
$sql="select * from  curl_wx where pass=0 $midsql order by pass desc,date desc,mid";
$result=$lnk->query($sql);
while ($rs=mysqli_fetch_assoc($result)){
if(!$rs["content"]){
$go_url = "http://mp.weixin.qq.com/s?__biz=".$rs["biz"]."==&mid=".$rs["mid"]."&idx=1&sn=".$rs["sn"]."#rd	";
$content=curl_wx($go_url);
//得到内容
preg_match('/<div class="rich_media_content " id="js_content">(.*)<\/div>/isU',$content,$contents);
$diycontent=$contents[1];
if(!midupdate($rs["mid"])){
$sortid= $sortid>0? $sortid:sortname_sortid($rs["types"]);
if($sortid>0)
{
$lnk->query("update curl_wx set content='$diycontent',pass='2' where mid=".$rs["mid"]." ");
$lnk->query("insert into  attr_list_1(list_id,sort_id,px,name,date,diy_pic,diy_content,biz,mid,sn)values('1','$sortid','0','".$rs["title"]."','".$rs["date"]."','','$diycontent','".$rs["biz"]."','".$rs["mid"]."','".$rs["sn"]."')");
}
$sortid=0;
}else{
$lnk->query("update curl_wx set pass='2' where mid=".$rs["mid"]." ");
}
}
}
alert("同步成功！");
go("WeixinSendList.php?menuid=$menuid");
}
function midupdate($mid){
global $lnk;
$result=$lnk -> query("select id from attr_list_1 where mid=".$mid);
while ($kind=mysqli_fetch_assoc($result)){
return true;
}
}
//取详细数据http://mp.weixin.qq.com/s?__biz=MzA5MzE0NzMxOQ==&mid=404730286&idx=1&sn=65d44285bb7515762ba25af815b06467#rd
//读取页面并返回
function curl_wx($go_url){
global $cookie_file;
$ch = curl_init($go_url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$content = curl_exec($ch);
//var_dump(curl_error($ch));
//print_r($content);
curl_close($ch);
return $content;
}
function sortname_sortid($sortname){
global $lnk;
$result=$lnk -> query("select * from sort where sort_name='".$sortname."'");
while ($kind=mysqli_fetch_assoc($result)){return $kind['id'];}
}
?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>