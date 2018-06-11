<?php include 'config/admin.php'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Expires" content="wed, 26 feb 1997 08:21:57 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache,no-store,must-revalidate">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> - 后台管理</title>
<link href="css/admin-index.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/window.css">
<link rel="stylesheet" type="text/css" href="css/artdialog.css">
<link rel="stylesheet" type="text/css" href="css/icomoon.css">
<script type="text/javascript" src="js/admin.js"></script>
</head>
<body style="margin:0px;"><div class="" style="display: none; position: fixed; top:0px;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div style="cursor: move;" class="aui_title"></div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td style="display: none;" class="aui_icon"><div style="background: transparent none repeat scroll 0% 0%;" class="aui_iconBg"></div></td><td style="width: auto; height: auto;" class="aui_main"><div style="padding: 20px 25px;" class="aui_content"></div></td></tr><tr><td colspan="2" class="aui_footer"><div style="display: none;" class="aui_buttons"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td style="cursor: se-resize;" class="aui_se"></td></tr></tbody></table></div></div>
<div class="header" style="position: fixed; top:0px;">
<div class="logo"><a href="home.php" title="" style="line-height: 40px;font-size:24px; color:#fff;padding-left:15px;">后台管理系统</a></div>
<div class="head_user head_tool" onclick="javascript:phpok_admin_logout();void(0);" title="管理员退出"><img class="head_user_img" src="images/logout.png" alt="管理员退出"></div>
<div class="head_tool head_list" id="top-menu-icon">

<div class="header-tc-content" id="top-menu">
<span class="header-tc-ct-bg"></span>

</div>
</div>

<div class="head_web">
<span class="clear_cache" onclick="phpok_admin_clear()">清空缓存</span>




</div>
</div>
<div class="content"><table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top" width="220px" <?php echo @$_GET["menu"]=="show" ? '': 'style="display:none"'; ?>>
<div class="c_left">
<ul>
<li appfile="cate"><a href="javascript:$.win('分类管理','kindsadmin.php?act=sortmenu');void(0);"><span class="icon-stack"></span>分类管理</a></li>
<li appfile="module"><a href="javascript:$.win('属性结构','tableattr.php');void(0);"><span class="icon-finder"></span>属性结构</a></li>
<li appfile="call"><a href="javascript:$.win('数据调用','explain.php');void(0);"><span class="icon-rocket"></span>数据调用</a></li>
<li appfile="reply"><a href="javascript:$.win('留言管理','message.php');void(0);"><span class="icon-bubbles"></span>留言管理</a></li>
<li appfile="res"><a href="javascript:$.win('目录管理','admin_ml.php');void(0);"><span class="icon-download"></span>目录管理</a></li>
<li appfile="tag"><a href="javascript:$.win('SEO管理','siteinfo.php?act=seo');void(0);"><span class="icon-tags"></span>SEO管理</a></li>
<li appfile="user"><a href="javascript:$.win('会员列表','user.php');void(0);"><span class="icon-user"></span>会员列表</a></li>
<li appfile="module"><a href="javascript:$.win('模块管理','admin_ml.php?act=modelist');void(0);"><span class="icon-settings"></span>模块管理</a></li>
<li appfile="admin"><a href="javascript:$.win('管理员维护','safe3.php');void(0);"><span class="icon-cogs"></span>管理员维护</a></li>
</ul>
</div>
</td>
<td valign="top" style="padding-left:10px;"><div class="index_main">
<div class="sub_box" id="all_setting"><script type="text/javascript">
function all_refresh()
{
var url = get_url('index','all_setting');
var rs = $.phpok.json(url);
if(rs.status == 'ok')
{
$("#all_setting").html(rs.content).show();
}
else
{
$("#all_setting").html('').hide();
}
}
</script>
<!--div class="box_item">
<ul>
<li><a title="配置网站信息，包括网址域名，布全局关键字等" href="javascript:$.win('网站信息','siteinfo.php?act=webinfo');void(0);">
<div class="top_img"><img src="images/ico/setting.png" alt="网站信息" class="ie6png" height="48" width="48"></div>
<div class="name">基础信息</div></a>
</li>
<?php
$result=$lnk -> query("select * from global_data order by id");
while($rs=mysqli_fetch_assoc($result))
{?>
<li><a title="<?php echo $rs["name"]?>" href="javascript:$.win('<?php echo $rs["name"]?>','addglobal.php?act=showdata&pid=<?php echo $rs["id"]?>');void(0);">
<div class="top_img"><img src="<?php echo $rs["ico"]?>" alt="<?php echo $rs["name"]?>" class="ie6png" height="48" width="48"></div>
<div class="name"><?php echo $rs["name"]?></div></a>
</li>
<?php }?>
<li class="plus"  disabled="disabled" onclick="$.win('新增全局内容','addglobal.php?act=addroot')"!></li>
</ul>
</div></div-->
<div class="sub_box" id="list_setting"><div class="title">
<span class="maintain">内容管理</span>
</div>
<div class="box_item">
<ul>
<?php
$mainbta=$lnk -> query("select * from mainbt order by px");
while($mainbt=mysqli_fetch_assoc($mainbta))
{
$arr=menu_one($mainbt['id'],@$_SESSION['uname_admin']);
	if($arr){
?>
	<li pid="90">
		<a title="<?php echo $mainbt['leftname_main'];?>" href="javascript:$.win('<?php echo $mainbt['leftname_main'];?>','<?php echo phpname($arr["typea"])?>?menuid=<?php echo $arr['id'] ;?>');void(0);">
			<div class="top_img"><img src="<?php echo $mainbt['ico'];?>" class="ie6png" alt="<?php echo $mainbt['leftname_main'];?>" height="48" width="48"></div>
			<div class="name"><?php echo $mainbt['leftname_main'];?></div>
		</a>
	</li>
<?php
	}
	 }?>
</ul>
</div></div>
</div></td>
</tr>
</tbody></table>
<div class="clear"></div>
</div>
<div class="foot">
<div class="foot_left">
</div>
</div>
<script type="text/javascript">
function pendding_info()
{
var url = get_url('index','pendding');
$.ajax({
'url':url,
'cache':false,
'async':true,
'dataType':'json',
'success': function(rs){
if(rs.status == "ok"){
var list = rs.content;
var html = '<em class="toptip">{total}</em>';
var total = 0;
for(var key in list){
if(list[key]['id'] == 'user' || list[key]['id'] == 'reply'){
$("li[appfile="+list[key]['id']+"] a em").remove();
$("li[appfile="+list[key]['id']+"] a").append(html.replace('{total}',list[key]['total']));
}else{
$("li[pid="+list[key]['id']+"] a em").remove();
$("li[pid="+list[key]['id']+"] a").append(html.replace('{total}',list[key]['total']));
total = parseInt(total) + parseInt(list[key]['total']);
}
}
if(total>0){
$("li[appfile=list] a em").remove();
$("li[appfile=list] a").append(html.replace('{total}',total));
}
window.setTimeout("pendding_info()", 60000);
}else{
$("em.toptip").remove();
window.setTimeout("pendding_info()", 180000);
}
}
});
}
$(document).ready(function(){
pendding_info();
//自定义右键
var r_menu = [[{
'text':'刷新网页',
'func':function(){
$.phpok.reload();
}
},{
'text': "清空缓存",
'func': function() {phpok_admin_clear();}
},{
'text':'修改我的信息',
'func':function(){phpok_admin_control();}
},{
'text': "显示桌面",
'func': function() {$.desktop.tohome();}
}],[{
'text':'关于PHPOK',
'func':function(){
$.dialog({
'title':'关于PHPOK',
'lock':true,
'drag':false,
'fixed':true,
'content':''
});
}
}]];
$(window).smartMenu(r_menu,{'textLimit':8});
$(document).keydown(function(e){
if (e.keyCode == 8){
return false;
}
});
});
</script>
<div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"></div>
<div  style="font-size:10px; color:#ccc; text-align:center">version: 1.0</span></div>
<script type="text/javascript">
	$(function(){
		console.log('进入该页面');
		$(".sub_box > .box_item > ul >li").unbind('click').bind('click',function(){
			console.log('点击！');
		});
	});
</script>
</body></html>