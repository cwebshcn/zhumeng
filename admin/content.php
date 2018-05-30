<?php
include 'config/admin.php';
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
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head><body>
<?php
@$menuid=$_GET["menuid"];
@$act=$_GET["act"];
function showh5($key){
global $lnk;
$result=$lnk -> query("select * from pagepart where indexcode='".$key."'");
if ($result)
while ($kind=mysqli_fetch_assoc($result)){
return $kind["content"];
}
}
?>
<nav class="navbar navbar-default">
<div class="container-fluid">
<ul class="nav navbar-nav">
<li><a href="?menuid=<?php echo $menuid?>">您的位置：<?php echo  getIdMainTitle(getIdMianId($menuid))?> >> <?php echo getIdTitle($menuid)?></a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<?php  include 'sub_menu.php'; ?>
<?php if($act=="")
{
$result=$lnk -> query("select * from mainbt1 where id=$menuid");
if ($result)
while ($rs=mysqli_fetch_assoc($result)){
$content= $rs["body99"];
}
?>
<form action="content.php?act=save&menuid=<?php echo $menuid?>" method="post">
<textarea name='contentdata'  id='contentdata' class="center-block"  style='width:99%;height:300px;'><?php echo $content?></textarea>
<script> var data_contentdata = UE.getEditor('contentdata');</script>
<div style="margin:5px;"><input type="submit" name="Submit" value=" 保存设置 " class="btn btn-success"></div>
</form>
</table>
<?php }?>
<?php
if($act=="save"){
$contentdata=$_POST["contentdata"];
$lnk -> query("update mainbt1 set body99='$contentdata' where id=$menuid");
alert("保存成功!");
go("content.php?menuid=$menuid");
}
?>
</body>
</html>
