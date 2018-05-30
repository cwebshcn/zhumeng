<?php 

//include 'PHPExcel/PHPExcel.php'; 
session_start();
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
header("Content-type: text/html; charset=utf-8"); 

$pid = $_REQUEST["pid"]+0;


//所属项目
if($pid<=0){
    echo "参数错误！";
    exit;
}



if(@$_POST['leadExcel'] == "true")
{
    $filename = $_FILES['inputExcel']['name'];
    $tmp_name = $_FILES['inputExcel']['tmp_name'];
    $msg = uploadFile($filename,$tmp_name);
    echo $msg;
}

//导入Excel文件
//导入Excel文件
function uploadFile($file,$filetempname)
{
    global $pid;
    //自己设置的上传文件存放路径
    $filePath = '../temp/exl/';
    $str = "";  
    //下面的路径按照你PHPExcel的路径来修改
    include 'config/config.php';
    require_once '../lib/PHPExcel/PHPExcel.php';
    //require_once 'PHPExcel/PHPExcel/IOFactory.php';
    //require_once 'PHPExcel/PHPExcel/Reader/Excel5.php';

    //注意设置时区
    $time=date("y-m-d-H-i-s");//去当前上传的时间
    //获取上传文件的扩展名
    $extend=strrchr ($file,'.');
    //上传后的文件名
    $name=$time.$extend;
    $uploadfile=$filePath.$name;//上传后的文件名地址
    //move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
    $result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
    //echo $result;
    if($result) //如果上传文件成功，就执行导入excel操作
    {
        
        $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        $objPHPExcel = $objReader->load($uploadfile);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();           //取得总行数
        $highestColumn = $sheet->getHighestColumn(); //取得总列数

       
        /* 第一种方法*/
        //循环读取excel文件,读取一条,插入一条
        $error_success_num = 0;
        $error_intention_num = 0;
        $success_success_num = 0;
        $success_intention_num = 0;

        $error_success_msg="";
        $error_intention_msg="";

        $success_success_msg="";
        $success_intention_msg="";
        for($j=4;$j<=$highestRow;$j++)                        //从第一行开始读取数据
        {
            $str="";
            for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
            {
                $str1 =$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();//读取单元格
                $str.=trim($str1).'|';
            }
            $strs = explode("|",$str);
       
            $error_success=false;  //不存在完全相同数据
            $error_intention=false;  //不存在完全相同数据           
            
            //如果存在数据成功数据
            if(!empty($strs[1])){
                $datasql="select user_name,phone,status_success from user_exl_input where phone='".trim($strs[1])."' and item_id='$pid'";
                $result=$lnk->query($datasql);
                while ($rs=mysqli_fetch_assoc($result)){
                    $error_success=true;
                    $error_success_msg.=$strs[0]."-".$strs[1]."<br>";
                    $error_success_num++;
                    if($rs["status_success"]!=1){
                        $sql="update user_exl_input set status_success='1' where item_id='$pid' and phone = '".trim($strs[1])."'";
                        $lnk -> query($sql); 
                        $success_success_num ++;
                    }
                }
                if(!$error_success){
                    $sql="INSERT INTO user_exl_input(item_id,user_name,phone,status_success,status_intention) VALUES ('$pid','".trim($strs[0])."','".trim($strs[1])."','1','0')";
                    $lnk -> query($sql); 
                    $success_success_num ++;
                }
            }

            //如果存在数据有意向数据
            if(!empty($strs[3])){
                $datasql="select user_name,phone,status_intention from user_exl_input where phone='".trim($strs[3])."' and item_id='".$pid."'";
                $result=$lnk->query($datasql);
                while ($rs=mysqli_fetch_assoc($result)){
                    $error_intention=true;
                    $error_intention_msg.=$strs[2]."-".$strs[3]."<br>";
                    $error_intention_num++;
                    if($rs["status_intention"]!=1){
                        $sql="update user_exl_input set status_intention='1' where item_id='$pid' and phone = '".trim($strs[3])."'";
                        $lnk -> query($sql); 
                        $success_intention_num ++;
                    }
                }
                if(!$error_intention){
                    $sql="INSERT INTO user_exl_input(item_id,user_name,phone,status_success,status_intention) VALUES ('$pid','".trim($strs[2])."','".trim($strs[3])."','0','1')";
                    $lnk -> query($sql); 
                    $success_intention_num ++;

                }
            }

        }
        unlink($uploadfile); //删除上传的excel文件
        $msg = "成功导入：$success_success_num 个(已存在：$error_success_num)<br> 有意向导入：$success_intention_num 个(已存在：$error_intention_num)";
        $msg.= "<button style='font-size:16px;margin:15px;background:#ff3300;color:#fff;padding-left:15px;padding-right:15px;' onclick='window.self.close();'> 关闭并返回 </button>";

        

        /* 第二种方法
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        echo 'highestRow='.$highestRow;
        echo "<br>";
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
        echo 'highestColumnIndex='.$highestColumnIndex;
        echo "<br>";
        $headtitle=array();
        for ($row = 1;$row <= $highestRow;$row++)
        {
            $strs=array();
            //注意highestColumnIndex的列数索引从0开始
            for ($col = 2;$col < $highestColumnIndex;$col++)
            {
                $strs[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }   
            $sql = "INSERT INTO data_ren('name','company','department','job','jobnumber','mtel','tel','email','username') VALUES (
            '{$strs[0]}',
            '{$strs[1]}',
            '{$strs[2]}',
            '{$strs[3]}',
            '{$strs[4]}',
            '{$strs[5]}',
            '{$strs[6]}',
            '{$strs[7]}',
            '".$_SESSION['uname_web'].")";
            //die($sql);
			$lnk -> query($sql); 	
            /*if(!mysqli_query($sql))
            {
                return false;
                echo 'sql语句有误';
            }
        }*/
    }
    else
    {
       $msg = "导入失败！";
       $msg.= "<button style='font-size:16px;margin:15px;background:#ff3300;color:#fff;padding-left:15px;padding-right:15px;' onclick='window.location.href=\"?pid=$pid\"'> 返回重新导入 </button>";
    }

    echo ($msg);
    exit;
}

?>

<form action="load_user_excel.php?pid=<?php echo $pid;?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="leadExcel" value="true">
    <table align="center" width="90%" border="0">
    <tr>
       <td>
        <input type="file" name="inputExcel"><input type="submit" value="导入数据">
       </td>
    </tr>
    </table>
</form>