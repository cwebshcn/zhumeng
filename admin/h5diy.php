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
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head><body>
<?php
@$menuid=$_GET["menuid"];
@$imgid=$_GET["imgid"];
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
<li><a href="data_use.php"><span class="glyphicon glyphicon-plus"></span>管理内容</a></li>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
<?php if($act==""){?>
<?php  include 'sub_menu.php'; ?>
<div align="center" class="margin-top-25"><a href="../<?php echo webpath($menuid);?>?act=loaddata&menuid=<?php echo $menuid;?>" target="_blank"><span class='btn btn-info btn-lg'>页面自导入</span></a> &nbsp;&nbsp;
<a href='javascript:void(0)' onClick='if(confirm("确认要重置本页数据吗？重置后将不能恢复！")){location.href="h5diy.php?act=reload&menuid=<?php echo $menuid;?>"}'><span class='btn btn-danger btn-lg'>重置本页数据</span></a></div>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form name="myform">
<tr>
<td width="16%"><strong>名称/数据调用串</strong></td>
<td width="84%"><strong>内容</strong></td>
</tr>
<?php
/*    toolbars:[
['fullscreen', 'source', '|', 'undo', 'redo', '|',
'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
'directionalityltr', 'directionalityrtl', 'indent', '|',
'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe','insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
'print', 'preview', 'searchreplace', 'help', 'drafts']
]  */
$result=$lnk -> query("select * from pagepart where list_id=$menuid order by list_id,px,id");
$i=1;
while ($kind=mysqli_fetch_assoc($result)){
if ($kind["type"]==1 or $kind["type"]==2){
?>
<tr>
<td height="40"><?php echo $kind["name"];?> <br>
<span class="text-info"><?php echo $kind["indexcode"];?></span></td>
<td><img src="<?php echo strpos($kind["content"],"/") ? "../".$kind["content"]:"temp/".$kind["content"];?>" height="80"><a href="?act=editimg&menuid=<?php echo $menuid;?>&imgid=<?php echo $kind["id"];?>"><span class="btn btn-success  btn-xs">编辑图片</span></a></td>
</tr><?php }else{?>
<tr>
<td height="84"><?php echo $kind["name"];?><br>
<span class="text-info"><?php echo $kind["indexcode"];?></span></td>
<td>
<textarea name='contentdata<?php echo  $i?>'  id='contentdata<?php echo  $i?>' onBlur="ajax_edit_txt(this.value,<?php echo $kind["id"];?>)"  style='width:100%;height:100px;'><?php echo $kind["content"];?></textarea>
<?php // if ($kind["content"] != strip_tags($kind["content"])){?>
<script>
//var data_contentdata<?php echo  $i?> = UE.getEditor('contentdata<?php echo  $i?>');
var data_contentdata<?php echo  $i?> =UE.getEditor('contentdata<?php echo  $i?>',{
//这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
toolbars:[['FullScreen', 'Source', 'Undo', 'Redo', 'bold', 'italic', 'underline','fontsize','link', 'unlink','forecolor', 'backcolor','lineheight']],
//focus时自动清空初始化时的内容
autoClearinitialContent:false,
//关闭字数统计
wordCount:false,
//关闭elementPath
elementPathEnabled:false,
//默认的编辑区域高度
initialFrameHeight:100,
//更多其他参数，请参考ueditor.config.js中的配置项
})
</script><div><span class="btn btn-info" onClick="ajax_edit_txt(data_contentdata<?php echo  $i?>.getContent(),<?php echo $kind["id"];?>);alert('当前编辑器保存成功！');" >保存当前编辑器数据</span></div>
<?php // }?>
</td>
</tr>
<?php
$i++;
}
}?>
</form>
</table>
<?php }?>
<?php
if($act=="editimg"){
$result=$lnk -> query("select * from pagepart where id=$imgid");
while ($kind=mysqli_fetch_assoc($result)){
?>
<table class="width98 table table-striped table-bordered table-hover js-table margin-top-25" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form name="myform" action="?act=saveimg&menuid=<?php echo $menuid;?>&imgid=<?php echo $imgid;?>" method="post">
<tr><td><?php echo $kind["name"];?> <br>
<span class="text-info"><?php echo $kind["indexcode"];?></span></td>
<td><img src="<?php echo strpos($kind["content"],"/") ? "../".$kind["content"]:"temp/".$kind["content"];?>" height="80"><br>
<input name="photo" type="text" id="photo" value="<?php echo $kind["content"];?>" size="30">
<input type="button" name="Submit11" value="上传缩略图" onClick="window.open('./upload.php?formname=myform&editname=photo&uppath=pic&filelx=jpg','','status=no,scrollbars=no,top=20,left=110,width=400,height=100')"></td></tr>
<tr><td colspan="2" class="paddin5"><input type="submit" class="btn btn-info" value="保存修改"></button></td></tr>
</form>
</table>
<?php
}
}
if($act=="saveimg"){
$content=$_POST["photo"];
$lnk -> query("update pagepart set content='$content' where id=$imgid");
alert("保存成功！");
go("?menuid=$menuid");
}
?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
function ajax_edit_txt(content,id){
$.post("h5diy.php?act=savetxt",{imgid:id,value:content});
}
</script>
<?php
if($act=="savetxt"){
$content=$_POST["value"];
$imgid=$_POST["imgid"];
$lnk -> query("update pagepart set content='$content' where id=$imgid");
}
?>
<?php
if($act=="reload" and $menuid>0){
$lnk -> query("delete  from pagepart  where list_id=$menuid");
alert("重置成功！");
go("h5diy.php?menuid=$menuid");
}	?>
</body>
</html>
