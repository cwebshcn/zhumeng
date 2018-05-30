<?php
include 'config/admin.php';
@$px=$_POST['px'];
@$typea=$_POST['typea']+0;
@$content=trim($_POST['content']);
@$indexcode=$_POST['indexcode'];
@$list_id=$_POST['list_id'];
/*
@$px=$_GET['px'];
@$typea=$_GET['typea'];
@$content=$_GET['content'];
@$indexcode=$_GET['indexcode'];
@$list_id=$_GET['list_id'];
*/
if($typea==2){
@$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
$url=str_replace("/admin","",dirname($url));
$content=str_replace($url."/","",$content);
$content=str_replace("url(","",$content);
$content=str_replace(")","",$content);
}
$result=$lnk -> query("select 0 from pagepart where indexcode='".$indexcode."'");
while ($kind=mysqli_fetch_assoc($result)){
$code="ok";
}
if($code!="ok" && strlen($indexcode)>0)
{
$content=str_replace("\n","",$content);
$content=str_replace("\r","",$content);
$content=str_replace("\r\n","",$content);
$content=str_replace("\"","",$content);
$content=str_replace("\'","",$content);
$myquery="insert into pagepart (list_id,indexcode,content,px,type) values ('$list_id','$indexcode','$content','$px','$typea')";
$result= $lnk -> query($myquery) or die("失败了" . mysql_error());
}
?>