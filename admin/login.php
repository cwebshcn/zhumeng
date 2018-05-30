<?php include 'config/config.php';
session_start();?><!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<title>管理员登录</title>
<link href="css/login.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript">
function login_code(appid)
{
var src_url = api_url("vcode","","id="+appid);
$("#src_code").attr("src",src_url);
}
//验证并登录
function admlogin()
{
var username = $("#username").val();
if(!username)
{
$.dialog.alert("管理员账号不能为空",false,'error');
return false;
}
//密码验证
var pass = $("#password").val();
if(!pass)
{
$.dialog.alert("密码不能为空",false,'error');
return false;
}
var url = get_url('login','check','user='+$.str.encode(username)+"&pass="+$.str.encode(pass));
var vcode = $("#code_id").val();
if(vcode)
{
url += "&_code="+$.str.encode(vcode);
}
var rs = $.phpok.json(url);
if(rs.status != 'ok')
{
$.dialog.alert(rs.content,function(){
$("#code_id").val('');
login_code('admin');
},'error');
return false;
}
else
{
url = get_url('index');
$.phpok.go(url);
}
return false;
}
function update_lang(val)
{
url = "admin.php?c=login&langid="+val;
$.phpok.go(url);
}
//防止被嵌套
if (self.location != top.location) top.location = self.location;
</script>
</head>
<?php
$_COOKIE['loginandpass']="loginandpass";
@$act=$_GET['action'];
if ($act!="post"){
?>
<body><div class="" style="display: none; position: absolute;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div style="cursor: move;" class="aui_title"></div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td style="display: none;" class="aui_icon"><div style="background: transparent none repeat scroll 0% 0%;" class="aui_iconBg"></div></td><td style="width: auto; height: auto;" class="aui_main"><div style="padding: 20px 25px;" class="aui_content"></div></td></tr><tr><td colspan="2" class="aui_footer"><div style="display: none;" class="aui_buttons"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td style="cursor: se-resize;" class="aui_se"></td></tr></tbody></table></div></div>
<div class="top">
</div>
<div class="main">
<div class="box">
<form action="login.php?action=post"  method="post" name="adminlogin">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="360">
<tbody><tr>
<td height="30">管理员账号</td>
<td colspan="2">语言</td>
</tr>
<tr>
<td height="40"><input name="username" class="user user_bg1" id="username" tabindex="1" type="text"></td>
<td colspan="2">
<select name="langid" id="langid" onChange="update_lang(this.value)" style="padding:3px;border:1px solid #7ea3b8;line-height:27px;height:27px;">
<option value="cn" selected="selected">简体中文</option>
</select>
</td>
</tr>
<tr>
<td height="30" width="209">管理员密码</td>
<td colspan="2">验证码</td>
</tr>
<tr>
<td height="40"><input name="password" id="password" class="user user_bg2" tabindex="2" type="password"></td>
<td width="72"><input name="yzmcode" class="user user_bg3" id="yzmcode" tabindex="3" type="text"></td>
<td width="79"><img  title="点击刷新" src="yzmcode.php" align="absbottom" onClick="this.src='yzmcode.php?'+Math.random();"></td>
</tr>
<tr>
<td colspan="3" height="50"><input value="认证登录" class="but" type="submit"></td>
</tr>
<tr>
<td colspan="3" height="30">推荐使用：傲游/谷歌/火狐/IE9-12等浏览器访问本系统</td>
</tr>
</tbody></table>
</form>
</div>
<div class="bottom"></div>
</div>
<div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"></div>
<?php
}
else{
if (@$_SESSION['buyok_admin_login']>=6){
echo "<script language='javascript'>";
echo "alert('您涉嫌非法登陆网站后台，已被系统锁定。请与技术人员联系。');";
echo "location.href='index.asp';";
echo "</script>";
}
$yzmcode=$_POST["yzmcode"]; //图形验证码
if(strtolower($yzmcode)!=strtolower($_SESSION["yzm"])){
echo '<script>'.strip_tags('alert("图形验证码错误 ！");history.back();').'</script>';
exit();
}
$username=trim($_REQUEST['username']);
$password=trim($_REQUEST['password']);
if ( $username=="" or $password=="" ){
echo "<script language='javascript'>";
echo "alert('填写不完整，请检查后重新提交！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
}
$TRecord=$lnk -> query("select * from manage where password='".md5($password)."' and username='".$username."'");
//$result = $conn -> query( 'select * from data_base' );
//$row =$result -> fetch_row();
$RecordCount = $TRecord-> fetch_row();
if ($TRecord){
$_SESSION['buyok_admin_login']=0;
$_SESSION['uname_admin']=$username;
$_SESSION['pswd']=$password;	#设置session
echo "<script language='javascript'>";
echo "location.href='home.php';";
echo "</script>";
}else{
echo "<script language='javascript'>";
$_SESSION['buyok_admin_login']=$_SESSION['buyok_admin_login']+1;
echo "alert('您的用户名密码有误，您的权限不能操作！');";
echo "location.href='javascript:history.go(-1)';";
echo "</script>";
}
}
?>
</body></html>