<?php 
include 'config/admin.php'; 
@$act=$_REQUEST["act"];


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
<script language=javascript>
<!--
function CheckAll(form){
for (var i=0;i<form.elements.length;i++){
var e = form.elements[i];
if (e.name != 'chkall') e.checked = form.chkall.checked; 
}
}
-->
</script>
</head>
<BODY>
<nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          	<li><a href="#">您的位置：留言管理</a></li>
        </ul>
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="#"><span class="glyphicon glyphicon-plus"></span>添加留言</a></li>
          </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<?php 


//得到模块
@$somodeid=$_GET['id'];
if ($somodeid!=""){$_SESSION['somoeid']=$somodeid;}
else{@$somodeid=$_SESSION['somoeid'];}

@$menuid=$_GET['menuid']+0;
if (!$menuid)
	exit;

if($act=="del"){
	$n=$_POST["num"];	
	$num="";
	for($i=0;$i<count($n);$i++){
		$num.=	$i==0 ? $n[$i]:",".$n[$i];
		}
		if(!$num){
			alert("您什么都没选!");
			goback();
			exit();
			}
		
	$lnk -> query("delete from message where id in($num)");
	go("msg.php?menuid=$menuid");
	exit();
	
}

if (!$act){
?>

<table class="width98 table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<form action="msg.php?act=del&menuid=<?php echo $menuid;?>" method="post" name="user">
<tr>
<td colspan=6 class=td height=25>留言管理 &nbsp;</td>
</tr>

<tr>
<td align=center width=3%>选</td>
<td width="11%" align=center>联系人</td>
<td width="16%" align=center>联系方式</td>
<td width="17%" align=center>email </td>
<td width="17%" align=center>提交时间</td>
<td width="20%" align=center>查看</td>
</tr>
<?php 
# =====================
# 分页调出数据
#搜索
@$keyword=$_REQUEST['keyword'];
if (@$_REQUEST['fs']=="search") {$str=" and username like '%".$keyword."%'";
$sql="select * from message where list_id='$menuid' ".$str."  order by id";}
else {$sql="select * from   message  where list_id='$menuid' order by id desc";}

//没页显示记录数
$PageSize = 20;
$StartRow = 0;  //开始显示记录的编号 

//获取需要显示的页数，由用户提交
if(empty($_GET['PageNo'])){  //如果为空，则表示第1页
    if($StartRow == 0){
        $PageNo = $StartRow + 1;  //设定为1
    }
}else{
    $PageNo = $_GET['PageNo'];  //获得用户提交的页数
    $StartRow = ($PageNo - 1) * $PageSize;  //获得开始显示的记录编号
}


//设置显示页码的初始值
if($PageNo % $PageSize == 0){
    $CounterStart = $PageNo - ($PageSize - 1);
}else{
    $CounterStart = $PageNo - ($PageNo % $PageSize) + 1;
}

//显示页码的最大值
$CounterEnd = $CounterStart + ($PageSize - 1);

$result =$lnk -> query($sql." LIMIT $StartRow,$PageSize");
$abc=$lnk -> query($sql);
while($tong=mysqli_fetch_assoc($abc)){
	  $tj[]=$tong;
	}
	
	
	//  a "a"  122 a[]  {a} {a:1}
 
 $TRecord = $lnk -> query($sql);
 //获取总记录数
 $tmparr=count($tj);
 @$RecordCount =$tmparr.count+1;

 //获取总页数
 $MaxPage = $RecordCount % $PageSize;
 if($RecordCount % $PageSize == 0){
    $MaxPage = $RecordCount / $PageSize;
 }else{
    $MaxPage = ceil($RecordCount / $PageSize);
 }

if ($RecordCount==0){echo "<tr><td colspan=7 align=center height=50>暂时没有</td></tr>";}
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $bil = $i + ($PageNo-1)*$PageSize;
	//<?php echo substr_coral($row["mtel "],10);
	
	?>


<tr><td><input type='checkbox' value='<?php echo $row["id"];?>' name="num[]"></td>
<td align="center"><?php echo $row["name"];?></td>
<td align="center"><?php echo $row["mtel"];?> | <?php echo $row["tel"];?></td>
<td align="center"><?php echo $row["email"];?></td>
<td align="center"><?php echo $row["timea"];?></td>
<td align="center"><a href="msg.php?act=view&menuid=<?php echo $row["list_id"];?>&pid=<?php echo $row["id"];?>">查看</a></td>
</tr>
<?php
 $i++;
 	}

?>

<tr><td colspan=6>
<input type='checkbox' name=chkall onclick='CheckAll(this.form)'>全选 
<input type=hidden name=action value="del">
<input type=submit value="删除" onClick="{if(confirm('确认要删除选定的吗？')){this.document.user.submit();return true;}return false;}">
</td></tr>
</form>
</table>
<?php print "总共$RecordCount  条记录  - 当前页： $PageNo / $MaxPage &nbsp;&nbsp;"; //显示第一页或者前一页的链接
		//如果当前页不是第1页，则显示第一页和前一页的链接
        if($PageNo != 1){
            $PrevStart = $PageNo - 1;
            print "<a href=?PageNo=1>首页</a>: ";
            print "<a href=?PageNo=$PrevStart>前页</a>";
        }
		print " [ ";
        $c = 0;
        //打印需要显示的页码
        for($c=$CounterStart;$c<=$CounterEnd;$c++){
            if($c < $MaxPage){
                if($c == $PageNo){
                    if($c % $PageSize == 0){
                        print "$c ";
                    }else{
                        print "$c ,";
                    }
                }elseif($c % $PageSize == 0){
                    echo "<a href=?PageNo=$c>$c</a> ";
                }else{
                    echo "<a href=?PageNo=$c>$c</a> ,";
                }//END IF
            }else{
                if($PageNo == $MaxPage){
                    print "$c ";
                    break;
                }else{
                    echo "<a href=?PageNo=$c>$c</a> ";
                    break;
                }//END IF
            }//END IF
       }//NEXT
      echo "] ";
      if($PageNo < $MaxPage){  //如果当前页不是最后一页，则显示下一页链接
          $NextPage = $PageNo + 1;
          echo "<a href=?PageNo=$NextPage>下页</a>";
      }
      //同时如果当前页补上最后一页，要显示最有一页的链接
      if($PageNo < $MaxPage){
       $LastRec = $RecordCount % $PageSize;
        if($LastRec == 0){
            $LastStartRecord = $RecordCount - $PageSize;
        }
        else{
            $LastStartRecord = $RecordCount - $LastRec;
        }

        print " : ";
        echo "<a href=?PageNo=$MaxPage>末页</a>";
        }
		echo "</span>";
}
if ($act=="view"){
$pid=$_REQUEST["pid"]+0;
if(!$pid or $pid==0)
exit();
$sql="select * from  message where id=$pid";
$result =$lnk -> query($sql); 
while($rs=mysqli_fetch_assoc($result))
{
?>
<table class="width98 table table-striped table-bordered table-hover js-table" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
<tr>
  <td colspan=2 class=td height=25>查看&nbsp;</td>
</tr>
<tr>
  <td width="20%" height=25 align=right>联系人&nbsp; </td>
  <td><?php echo $rs["name"];?></td>
</tr>
<tr>
  <td align=right height=25>联系方式 &nbsp;</td>
  <td><?php echo $rs["mtel"];?> | <?php echo $rs["tel"];?></td>
</tr>
<tr>
  <td align=right height=25>电子邮箱&nbsp;</td>
  <td><?php echo $rs["email"];?></td>
</tr>
<tr>
  <td align=right height=25>留言信息</td>
  <td><?php echo $rs["message"];?></td>
</tr>
</table>
<?php }
}
?>
 
 <script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>