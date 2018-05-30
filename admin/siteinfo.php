<?php
include 'config/admin.php';
/*
webinfo  //网站信息
domain  //域名绑定
copyallright //权限信息
share //分享
weixin //微信
count  //统计
gs  //工商代码
shx  //设会化
*/
@$act=$_GET["act"];
@$action=$_GET["action"];
switch($act){
case "webinfo":
$webinfoname="网站信息";
break;
case "domain":
$webinfoname="域名绑定";
break;
case "copyallright":
$webinfoname="页脚版权";
break;
case "share":
$webinfoname="分享代码";
break;
case "weixin":
$webinfoname="微信二维码";
break;
case "count":
$webinfoname="网站统计代码";
break;
case "gs":
$webinfoname="工商代码";
break;
case "shx":
$webinfoname="设会化代码";
break;
case "seo":
$webinfoname="SEO优化";
break;
default:
$webinfoname="其它";
break;
}
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
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>
<?php if($action==""){
$result=$lnk -> query("select * from siteinfo limit 0,1");
while($arr=mysqli_fetch_assoc($result))
{
?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="#">您的位置：全局设置 >> <?php echo $webinfoname;?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<form method="post" name="myform" action="siteinfo.php?action=editb">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<input name="submitact" type="hidden" value="<?php echo $act?>">
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk" <?php if($act!="webinfo"){ echo "style='display:none'";}?>>
<tr><td> 网站名称：<span class="text-info"><em>即在前台使用的名称信息</em></span></td></tr>
<tr><td><input type="text" id="site_name" name="site_name"  value="<?php echo $arr["site_name"]?>" /></td></tr>
<tr><td> 域名：<span class="text-info"><em>网站域名，不用填写http://，也不能填写 / 结束符</em></span></td></tr>
<tr><td><input type="text" id="site_domain" name="site_domain"  value="<?php echo $arr["site_domain"]?>" /></td></tr>
<tr><td> 地址：<span class="text-info"><em>网站地址，精确到 XXX 号，用于地图定位</em></span></td></tr>
<tr><td><input type="text" id="site_address" name="site_address"  value="<?php echo $arr["site_address"]?>" /></td></tr>
<tr><td> 网站LOGO：<span class="text-info"><em>绑定网站的LOGO信息</em></span></td></tr>
<tr><td><input type="text" id="site_address" name="site_logo"  value="<?php echo $arr["site_logo"]?>" /> <input type="button" name="Submit11" value="上传图片" onClick="window.open('./upload.php?formname=myform&editname=site_logo&uppath=site_logo&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"> <img src='temp/<?php echo $arr["site_logo"]?>' height='40'></td></tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk" <?php if($act!="seo"){ echo "style='display:none'";}?>>
<tr><td> SEO标题：<span class="text-info"><em>针对HTML里的Title属性进行优化，建议使用英文竖线分割开来，不超过80字</em></span></td></tr>
<tr><td><input type="text" id="seo_title" name="seo_title"  value="<?php echo $arr["seo_title"]?>" /></td></tr>
<tr><td> SEO关键字：<span class="text-info"><em>简单明了用几个词来描述您的网站，多个词用英文逗号隔开</em></span></td></tr>
<tr><td><input type="text" id="seo_title" name="seo_keywords"  value="<?php echo $arr["seo_keyword"]?>" /></td></tr>
<tr><td> SEO摘要：<span class="text-info"><em>针对您的网站，简单描述其作用，目标群体，未来方向等信息，建议不超过100字</em></span></td></tr>
<tr><td><input type="text" id="seo_title" name="seo_descriptions"  value="<?php echo $arr["seo_descriptions"]?>" /></td></tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk" <?php if($act!="domain"){ echo "style='display:none'";}?>>
<tr><td> 域名：<span class="text-info"><em>网站域名，不用填写http://，也不能填写 / 结束符</em></span></td></tr>
<tr><td><input type="text" id="seo_domain2" name="seo_domain2"  value="<?php echo $arr["site_domain"]?>" disabled /></td></tr>
<tr><td><span class="text-info"><em>请在网站信息中修改。若需绑定多个域名，需要支持域名REWRITE 权限 有一对多，与多对多选择！</em></span></td></tr>
</table>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr><td><input name="submit" type="submit" value=" 保存设置 "></td></tr>
</table>
</form>
<?php
}
}
//编辑数据库内容
if($action=="editb"){
$submitact=$_POST["submitact"];
$site_name=$_POST["site_name"];
$site_domain=$_POST["site_domain"];
$site_address=$_POST["site_address"];
$site_logo=$_POST["site_logo"];
$seo_title=$_POST["seo_title"];
$seo_keywords=$_POST["seo_keywords"];
$seo_descriptions=$_POST["seo_descriptions"];
if ($site_name=="" and $seo_title==""){ alert("请填写标题！");goback();}
else
{
$sql="update siteinfo set site_name='$site_name',site_domain='$site_domain',site_address='$site_address',site_logo='$site_logo',seo_title='$seo_title',seo_keyword='$seo_keywords',seo_descriptions='$seo_descriptions'";
$lnk -> query($sql);
alert("保存成功！");
go("?act=$submitact");
}
}
?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>