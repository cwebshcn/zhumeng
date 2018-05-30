<?php

include 'config/admin.php'; 
include "../lib/code36.php"; 
include "../phpqrcode/qrlib.php";  // QRcode lib
include './function/comm.php';




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
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="css/h5style.css" rel="stylesheet">
<link href="../css/datepicker.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css">
<!--UE-->
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script src="https://cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
</head>
<body>

<div style="width:1024px;margin:0 auto;text-align: center;padding:25px;">
	<h3>手机号一览表（总计：<?php echo count_all_phone();?>）</h3>
	<div class="row" >
		<div>&nbsp;</div>
	<?php 
		$result=$lnk -> query("select phone from temp_phone order by px desc");
		while ($rs=mysqli_fetch_assoc($result)){ 
	?>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="font-size:14px;color:#333;border-bottom:1px solid #e0e0e0;"><?php echo $rs["phone"];?></div>
	<?php 
		}
	?>
	</div>
</div>
<?php 
	function count_all_phone(){
		global $lnk;
		$result=$lnk -> query("select count(0) from temp_phone order by px desc"); 
		while ($rs=mysqli_fetch_row($result)){return $rs[0]+0;}
	}
?>
</body>
</html>