<?php
header("Content-type: text/html; charset=utf-8");
session_start();
$bd_names=@$_GET['editname'];
if ($bd_names==""){$bd_names=@$_SESSION['bd_names'];}else{$_SESSION['bd_names']=$bd_names;}
@$fname=$_POST['fname'];
if (isset($_POST['set'])) {
$upload_slots = $_POST['slots'];
} else {
$upload_slots = 1; // <---------- 默认文件上传数量
}
$max_size = 100000000; // 文件最大上传字节数
if (@$_POST['location']==""){
$location = "./temp/";     // 文件被上传后的目录
}
else  {
$location = "./".$_POST['location']."/";
}
$S_ImageExt = "jpg|png|gif|jpeg|pdf|mp3|mp4|bmp|doc|docx|xls|xlsx|ppt|pptx";
?>
<html>
<title>图片上传</title>
<body style="background:#dddddd">
<?php if (! isset($_POST['upload'])){ ?>
<form method="POST" name="myform" enctype="multipart/form-data" action="upload_img.php">
<input type="hidden" name="MAX_FILE_SIZE" size="5200000">
<?php for($count = 1; $count < $upload_slots+1; $count++) {echo '<input type="file" name="upload'.$count.'" size="29" style="border:1px solid #666666;height:20px">'; }?>
<input type="hidden" name="slots" value="<?php echo $upload_slots; ?>">
<input type="hidden" name="location" value="<?php echo @$_GET['location'];?>">
<input type="hidden" name="fname" value="<?php echo $_GET['formname'];?>">
<input type="submit" value="开始上载" name="upload" style="border:1px solid #666666;height:20px"></form>
<?php } else { 
	 // 循环检查每个提交的文件
		for ($num = 1; $num < $_POST['slots']+1; $num++){
			$event = "Success";
			// 检查是否有文件上传
			if (! $_FILES['upload'.$num]['name'] == ""){
				if ($_FILES['upload'.$num]['size'] < $max_size) {
					@$c=$_FILES['upload'.$num]['name'];

					$ex_arr = explode(".",$c);
					$ex = strtolower($ex_arr[count($ex_arr)-1]);
					$pass_ex = "jpg|png|gif|jpeg|pdf|mp3|mp4|bmp|doc|docx|xls|xlsx|ppt|pptx|pbd";

					if (strstr($pass_ex,$ex)){
						$thisimg=date('YmdHis',time()).rand(10,99).".".$ex;
						if ($bd_names=="upname1" or $bd_names=="upname2" or $bd_names=="upname3"){$thisform="forms[1]";}else{$thisform="forms[0]";}
						if ($fname){$thisform="forms['".$fname."']";}
						move_uploaded_file($_FILES['upload'.$num]['tmp_name'],"./temp/".$thisimg) or $event = "Failure";
						// if ($bd_names =="logo"){
							echo("<script>");
							echo("var obj=opener.document.".$thisform.".".$bd_names.";");
							echo("if(obj.value==''){");
							echo("obj.value='".$thisimg."';");
							echo("}else{");
							echo("obj.value+='|".$thisimg."';");
							echo("};");
							//echo("var obj1=opener.document.".$thisform.".".$bd_names.";");
							//echo("if(obj1.value==''){");
							//echo("obj1.value='".$thisimg."';");
							//echo("}else{");
							//echo("obj1.value+='|".$thisimg."';");
							//	echo("}");
							//echo("opener.Pshow_max();");
							echo("self.close();");
							echo("</script>");
						// }else{
						// 	if ($bd_names =="logo"){
						// 		echo "<script language='javascript'>opener.document.".$thisform.".".$_SESSION["bd_names"].".value='".$thisimg."';self.close();</script>";
						// 	}else{
						// 		echo "<script language='javascript'>opener.document.".$thisform.".".$_SESSION["bd_names"].".value='".$thisimg."';self.close();</script>";
						// 	}
						// }
					}else{echo "不支持的格式[".$ex."]";
				}
			} else {
				$event = "文件超过限定大小";
			}
		}
	}
}
?>
</body>
</html>