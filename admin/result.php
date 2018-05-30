<?php
include 'result_api.php';
 ?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>51ZBK赋能活动查询结果</title>
		<script src="js/jquery-2.1.0.min.js" type="text/javascript" charset="utf-8"></script>		
		<script src="js/jquery.cookie.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/result.css"/>
	</head>
	<body>
		<div class="return">
			<span><a href="search.html">返回搜索</a></span>
		</div>
		
		<div class="title">
			<div class="title-msg">
				<span>活动名称</span>
				<p>51ZBK赋能活动查询</p>
			</div>
		</div>
		
		
		<div class="center-title">
			<span>查询结果</span>
		</div>
		
		<div class="result-list">
			<table style="width:98%;font-size:1.2rem;" align="center" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
			
			<tr>
				<td class="text-center"><strong style="color:#666">兑换奖项</strong></td>
				<td class="text-center"><strong style="color:#666">下家</strong></td>
				<td class="text-center"><strong style="color:#666">下下家</strong></td>
				<td class="text-center"><strong style="color:#666">可兑换金额</strong></td>

			</tr>
			<tr style="background-color:#ccc;">
				<td class="text-center" style="color:#fff">开卡奖</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_card["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_card["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_card["count_cash_all"]?> <?php if($count_card["cash_status"]) echo $count_card["count_cash"]?> 元</td>
			</tr>
			<tr>
				<td class="text-center" style="color:#666">带看奖</td>
				<td class="text-center" style="color:#666"><?php 
				$n=0;
				foreach ($count_take["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#666"><?php echo $count_take["count_userc"];?></td>
				<td class="text-center" style="color:#666"><?php echo $count_take["count_cash_all"]?>  <?php if($count_take["cash_status"]) echo $count_take["count_cash"]?> 元</td>
			</tr>
			<tr style="background-color:#ccc;color:#fff">
				<td class="text-center" style="color:#fff">互动奖</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_interact["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_interact["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_interact["count_cash_all"]?>  <?php if($count_interact["cash_status"]) echo $count_interact["count_cash"]?> 元</td>
			</tr>
			<tr >
				<td class="text-center" style="color:#666">到场奖</td>
				<td class="text-center" style="color:#666"><?php 
				$n=0;
				foreach ($count_spot["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#666"><?php echo $count_spot["count_userc"];?></td>
				<td class="text-center" style="color:#666"><?php echo $count_spot["count_cash_all"]?>  <?php if($count_spot["cash_status"]) echo $count_spot["count_cash"]?> 元</td>
			</tr>
			<tr style="background-color:#ccc;color:#fff">
				<td class="text-center" style="color:#fff">成交奖</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_deal["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal["count_cash_all"]?>  <?php if($count_deal["cash_status"]) echo $count_deal["count_cash"]?> 元</td>
			</tr>
			<tr>
				<td class="text-center" style="color:#666">成交奖(线上)</td>
				<td class="text-center" style="color:#666"><?php 
				$n=0;
				foreach ($count_deal_online["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#666"><?php echo $count_deal_online["count_userc"];?></td>
				<td class="text-center" style="color:#666"><?php echo $count_deal_online["count_cash_all"]?>  <?php if($count_deal_online["cash_status"]) echo $count_deal_online["count_cash"]?> 元</td>
			</tr>

		</table>
		<?php
		function get_css($name){
			global $count_card;
			global $count_take;
			global $count_interact;
			global $count_spot;
			global $count_deal;
			global $count_deal_online;
			$obj_name=${"count_$name"};
			if($obj_name["cash_status"]==0){
				if($obj_name["count_cash_all"]>0){
					//未领取
					$color="#fa7e3f";
					$disabled="";
					$readonly="";
					$checked='checked="checked"';
					$text = "可领奖";
				}else{
					//未满足条件
					$color="#666666";
					$disabled="disabled='disabled'";
					$readonly='readonly="readonly"';
					$checked='';
					$text = '未满足条件';
				}
			}else{
				//已领取
				$color="#666666";
				$disabled='disabled="disabled"';
				$readonly='readonly="readonly"';
				$checked='checked="checked"';
				$text = '已领奖['.date("m-d H:i",$obj_name["cashinfo"]["operate_date"]).']';
			}
			return array("color"=>$color,"disabled"=>$disabled,"readonly"=>$readonly,"checked"=>$checked,"text"=>$text);
		}

		$css_card = get_css("card");
		$css_take = get_css("take");
		$css_interact = get_css("interact");
		$css_spot = get_css("spot");
		$css_deal = get_css("deal");
		$css_deal_online = get_css("deal_online");
		?>
		<div style="font-size:1.2rem;color:#fa7e3f;text-align: center; margin-top:2rem; background-color: #f0f0f0;padding:5px;"> 
			<input type="checkbox" value="1" onchange="change_status(this,'spot')" style="width:1.5rem;height:1.5rem;" <?php if($userGroup["get_spot"]) echo 'checked="checked" disabled="disabled"';?>>本人到场   
			<input type="checkbox" value="1" onchange="change_status(this,'deal')" style="width:1.5rem;height:1.5rem;" <?php if($userGroup["get_deal"]) echo 'checked="checked" disabled="disabled"';?>>本人成交(线下)  
			<input type="checkbox" value="1" onchange="change_status(this,'deal_online')" style="width:1.5rem;height:1.5rem;"<?php if($userGroup["get_deal_online"]) echo 'checked="checked" disabled="disabled"';?>>本人成交(线上)
		</div>
		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_card["color"];?>">
				开卡奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_card["checked"];?> <?php echo $css_card["disabled"];?>> 
				<?php echo $css_card["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_card" placeholder="备注" <?php echo $css_card["readonly"];?>>
				<?php echo $count_card["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_card["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_card["disabled"];?>
				onclick="<?php echo "go('?code=$key&act=update&obj=card&note='+note_card.value)";?>">兑奖</button>
		</div>

		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_take["color"];?>">
				带看奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_take["checked"];?> <?php echo $css_take["disabled"];?>> 
				<?php echo $css_take["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_take" placeholder="备注" <?php echo $css_take["readonly"];?>>
				<?php echo $count_take["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_take["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_take["disabled"];?>
				onclick="<?php echo "go('?code=$key&act=update&obj=take&note='+note_take.value)";?>">兑奖</button>
		</div>

		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_interact["color"];?>">
				互动奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_interact["checked"];?> <?php echo $css_interact["disabled"];?>> 
				<?php echo $css_interact["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_interact" placeholder="备注" <?php echo $css_interact["readonly"];?>>
				<?php echo $count_interact["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_interact["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_interact["disabled"];?>
				onclick="<?php echo "go('?code=$key&act=update&obj=interact&note='+note_interact.value)";?>">兑奖</button>
		</div>

		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_spot["color"];?>">
				到场奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_spot["checked"];?> <?php echo $css_spot["disabled"];?>> 
				<?php echo $css_spot["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_spot" placeholder="备注" <?php echo $css_spot["readonly"];?>>
				<?php echo $count_spot["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_spot["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_spot["disabled"];?> 
				onclick="<?php echo "go('?code=$key&act=update&obj=spot&note='+note_spot.value)";?>">兑奖</button>
		</div>


		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_deal["color"];?>">
				成交奖（线下）   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_deal["checked"];?> <?php echo $css_deal["disabled"];?>> 
				<?php echo $css_deal["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem"  id="note_deal" placeholder="备注" <?php echo $css_deal["readonly"];?>>
				<?php echo $count_deal["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_deal["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_deal["disabled"];?>
				onclick="<?php echo "go('?code=$key&act=update&obj=deal&note='+note_deal.value)";?>">兑奖</button>
		</div>

		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_deal_online["color"];?>">
				成交奖（线上）   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_deal_online["checked"];?> <?php echo $css_deal_online["disabled"];?>> 
				<?php echo $css_deal_online["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_deal_online" placeholder="备注" <?php echo $css_deal_online["readonly"];?>>
				<?php echo $count_deal_online["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_deal_online["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_deal_online["disabled"];?>
				onclick="<?php echo "go('?code=$key&act=update&obj=deal_online&note='+note_deal_online.value)";?>">兑奖</button>
		</div>

		

		<div style="padding-top:25px; padding-bottom: 100px;font-size:1.4rem;">兑换码/手机号
			<div style=" font-size:2rem"><?php echo $userGroup["redeem_code"]?>/<?php echo $userGroup["phone"]?></div>
		</div>
	</div>
		
		<div class="login_btn">
			<span>退 出 登 录</span>
		</div>
		
		
		<!--确认兑换窗口-->
		<div class="toast">
			<div class="toast-center">
				<dl>
					<dt><span>确认兑换</span></dt>
					<dd>
						<div class="left-btn">取消</div>
						<div class="right-btn">确认</div>
					</dd>
					
				</dl>
			</div>
		</div>
		
		
		
	</body>
	<script>
		function go(url){
			window.location.href=url;
		}
		function change_status(obj,objname){
			var objv=$(obj).prop("checked") || 0;
			if(objv)
				objvalue=1;
			console.log(objvalue);
			$.ajax({
				url: "result.php?code=<?php echo $key;?>&act=status_update&objname="+objname+"&objvalue="+objvalue,
				type:"get"
			});
		}
	</script>
</html>
