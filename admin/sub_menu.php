<div class="text-center">
	<?php 
	$left_id= getIdMianId($menuid)+0;
	$result=$lnk -> query("select * from mainbt1 where left_id='".$left_id."' order by px");
	if ($result)
	while ($kind=mysqli_fetch_assoc($result)){ 
	//if($kind["id"]!=$menu_id)
		if(yn($kind["id"],$_SESSION['uname_admin'])){
			echo "<a href='".phpname($kind["typea"])."?menuid=".$kind["id"]."'><span class='btn ";
			echo $menuid==$kind["id"] ?" btn-danger ": " btn-info ";
			echo "'>".$kind['leftname']."</span></a> &nbsp;&nbsp;&nbsp;";
		 }
	 }
	?>

	
	</div>
</div>