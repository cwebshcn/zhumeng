<?php
include 'result_api.php';
 ?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>51赋能活动查询结果</title>
		<script src="js/jquery-2.1.0.min.js" type="text/javascript" charset="utf-8"></script>		
		<script src="js/jquery.cookie.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/result.css?ld=<?php echo time();?>"/>
	</head>
	<body >
		<div class="return">
			<span><a href="search.html">返回搜索</a></span>
		</div>
		
		<div class="title">
			<div class="title-msg">
				<span>活动名称</span>
				<p>51赋能活动查询</p>
			</div>
		</div>
		
		
		<div class="center-title">
			<span>查询结果<i style="font-size:1.2rem;color:#fa7e3f;padding:5px;">
			所有奖项和操作勾选确认以后就不可更改！
		</i></span>
		</div>
		
		<div class="result-list" >
			<table style="width:98%;font-size:1.2rem;" align="center" data-toggle="table" data-url="" data-height="299" data-click-to-select="true"  data-select-item-name="radioName" id="table-ShipChk">
			
			<tr>
				<td class="text-center"><strong style="color:#666">兑换奖项</strong></td>
				<td class="text-center"><strong style="color:#666">下家</strong></td>
				<td class="text-center"><strong style="color:#666">下下家</strong></td>
				<td class="text-center"><strong style="color:#666">可兑换金额</strong></td>

			</tr>
			<tr style="background-color:#ccc;">
				<td class="text-center" style="color:#fff">宣传奖</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_card["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_card["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_card["count_cash_all"]["cash"]?>  <?php if($count_card["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
			</tr>
			<!-- <tr>
				<td class="text-center" style="color:#666">领看奖</td>
				<td class="text-center" style="color:#666"><?php 
				$n=0;
				foreach ($count_take["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#666"><?php echo $count_take["count_userc"];?></td>
				<td class="text-center" style="color:#666"><?php echo $count_take["count_cash_all"]["cash"]?>  <?php if($count_take["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
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
				<td class="text-center" style="color:#fff"><?php echo $count_interact["count_cash_all"]["cash"]?>  <?php if($count_interact["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
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
				<td class="text-center" style="color:#666"><?php echo $count_spot["count_cash_all"]["cash"]?>  <?php if($count_spot["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
			</tr> -->
			<tr style="background-color:#ccc;color:#fff">
				<td class="text-center" style="color:#fff">成交奖（线下）</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_deal["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal["count_cash_all"]["cash"]?>  <?php if($count_deal["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
			</tr>
			<!-- <tr >
				<td class="text-center" style="color:#666">成交奖（线上）</td>
				<td class="text-center" style="color:#666"><?php 
				$n=0;
				foreach ($count_online["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#666"><?php echo $count_online["count_userc"];?></td>
				<td class="text-center" style="color:#666"><?php echo $count_online["count_cash_all"]["cash"]?>  <?php if($count_online["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
			</tr>
			<tr style="background-color:#ccc;color:#fff">
				<td class="text-center" style="color:#fff">成交奖(线上＋线下)</td>
				<td class="text-center" style="color:#fff"><?php 
				$n=0;
				foreach ($count_deal_online["arr_userb"] as $userb) {
					if($userb["self_status"]!=0)
						$n++;
				};
				echo $n;

				?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal_online["count_userc"];?></td>
				<td class="text-center" style="color:#fff"><?php echo $count_deal_online["count_cash_all"]["cash"]?>  <?php if($count_deal_online["count_cash_all"]["status"]=="已兑奖") echo "已兑奖";?> </td>
			</tr> -->
			
		</table>


			</div>
		</div>
			<?php
		function get_css($name){
			global $count_card;
			global $count_take;
			global $count_interact;
			global $count_spot;
			global $count_deal;
			global $count_online;
			global $count_deal_online;
			$obj_name=${"count_$name"};
			if($obj_name["cash_status"]==0){
				if($obj_name["count_cash_all"]["cash"]>0){
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
		$css_online = get_css("online");
		$css_deal_online = get_css("deal_online");
		?>
		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_card["color"];?>">
				宣传奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_card["checked"];?> <?php echo $css_card["disabled"];?>> 
				<?php echo $css_card["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_card" placeholder="备注" <?php echo $css_card["readonly"];?>>
				<?php echo $count_card["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_card["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_card["disabled"];?>
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=card&note='+note_card.value)}";?>">兑奖</button>
		</div>

		<!-- <div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_take["color"];?>">
				带看奖   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_take["checked"];?> <?php echo $css_take["disabled"];?>> 
				<?php echo $css_take["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_take" placeholder="备注" <?php echo $css_take["readonly"];?>>
				<?php echo $count_take["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_take["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_take["disabled"];?>
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=take&note='+note_take.value)}";?>">兑奖</button>
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
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=interact&note='+note_interact.value)}";?>">兑奖</button>
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
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=spot&note='+note_spot.value)}";?>">兑奖</button>
		</div> -->


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
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=deal&note='+note_deal.value)}";?>">兑奖</button>
		</div>
		<!-- <div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_online["color"];?>">
				成交奖（线上）   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_online["checked"];?> <?php echo $css_online["disabled"];?>> 
				<?php echo $css_online["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem"  id="note_online" placeholder="备注" <?php echo $css_online["readonly"];?>>
				<?php echo $count_online["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_online["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_online["disabled"];?>
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=online&note='+note_online.value)}";?>">兑奖</button>
		</div>

		<div style="font-size:1.4rem;margin-top:2rem; background-color: #f0f0f0;">
			<div style="text-align: center;color:<?php echo $css_deal_online["color"];?>">
				成交奖（线上+线下）   
				<input type="checkbox" value="" style="width:2rem;height:2rem;" <?php echo $css_deal_online["checked"];?> <?php echo $css_deal_online["disabled"];?>> 
				<?php echo $css_deal_online["text"];?>
			</div>
			<textarea style="width:80%;height:5rem; border:1px solid #e0e0e0; font-size:1.2rem" id="note_deal_online" placeholder="备注" <?php echo $css_deal_online["readonly"];?>>
				<?php echo $count_deal_online["cashinfo"]["operate_note"];?>
			</textarea>
			<button style="font-size:1.6rem; background-color: <?php echo $css_deal_online["color"];?>;color:#fff;width:80%;height:2rem" <?php echo $css_deal_online["disabled"];?>
				onclick="<?php echo "if(confirm('确定兑奖后就不能撤回，是否确认?')){go('?code=$key&act=update&obj=deal_online&note='+note_deal_online.value)}";?>">兑奖</button>
		</div> -->

			<div class="addname_table">
				<div class="addname_left">学生姓名(必填)</div>
				<div class="addcon_right"><input type="text" placeholder="输入信息" id="class_student" :value="student"></div>
				<div class="addname_left">推荐人姓名(选填)</div>
				<div class="addcon_right"><input type="text" placeholder="输入信息" id="class_teacher" :value="teacher"></div>
				<input type="hidden" value="<?php echo $userGroup["phone"]?>" id="class_phone">
			</div>

		<!-- 新的勾选课程 -->
			<div style="font-size:1.2rem;color:#666;text-align: center; margin-top:2rem; background-color: #f0f0f0;padding:5px;" id="classList"> 
				<span v-for="(v,index) in list">
					<div style="font-size:3rem;">
					<input type="checkbox" :value="v.class_id" :classname="v.class_name" :itemid="v.item_id" :userid="v.user_id" @click="buyCourse" style="width:3rem;height:3rem;" disabled="disabled" checked="checked" v-if="isInArray(checked,v.class_id)">
					<input type="checkbox" :value="v.class_id" :classname="v.class_name" :itemid="v.item_id" :userid="v.user_id" @click="buyCourse" style="width:3rem;height:3rem;" v-else>

					{{v.class_name}}
					</div>
				</span>
			</div>

		<div style="padding-top:25px; padding-bottom: 100px;font-size:1.4rem;">兑换码/手机号
			<div style=" font-size:2rem"><?php echo $userGroup["redeem_code"]?>/<?php echo $userGroup["phone"]?></div>
		</div>
	</div>
		
		<div class="login_btn">
			<span><a href='index.html' style='color:#fff;'>退 出 登 录</a></span>
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
	<script src="https://cdn.bootcss.com/vue/2.5.9/vue.js"></script>
	<script>
		function go(url){
			window.location.href=url;
		}
		function change_status(obj,objname){
			var objv=$(obj).prop("checked") || 0;
			if(objv)
				objvalue=1;
			console.log(objvalue);
			if(confirm("确定勾选，勾选后就不能撤回?")){
				$.ajax({
					url: "result.php?code=<?php echo $key;?>&act=status_update&objname="+objname+"&objvalue="+objvalue,
					type:"get"
				});
			}else{
				$(obj).removeAttr("checked");
				// $.ajax({
				// 	url: "result.php?code=<?php echo $key;?>&act=status_update&objname="+objname+"&objvalue=0",
				// 	type:"get"
				// });
			}
		}
		
		var classList = new Vue({
			el:"#classList",
			data:{
				list:[],
				checked:"",
				teacher:"",
				student:[],
			},
			methods :{

				//勾选采集数据
				buyCourse : function(e){
					var obj = e.target;
					
					
					var info = {
						item_id:$(obj).attr("itemid"),
						user_id:$(obj).attr("userid"),
						class_id:obj.value,
						student: $("#class_student").val(),
						teacher : $("#class_teacher").val(),
						class_name :$(obj).attr("classname"), 
						phone : $("#class_phone").val(), 
					}
					if(!info.student){
						alert("请填写学生姓名！");
						$(obj).prop("checked",false);
						return;
					}
					if(window.confirm(info.class_name+"课程！确认后不能修改！")){
						this.ajaxCourseBuy(info,obj);
					}else{
						console.log(info);
						$(obj).prop("checked",false);
					}
					console.log("user:"+info.user_id+">>class:"+info.class_id+">>item:"+info.item_id);
				},
				//提交数据
				ajaxCourseBuy:function(info,obj){
					$.ajax({
						url:"api/operator_insert_buy_course.php",
						type:"POST",
						data:info,
						success : function(msg){
							$(obj).attr("disabled",true);
						}
					});

				},
				isInArray :function(arr, val){
					var i, iLen;
				    if(!(arr instanceof Array) || arr.length === 0){
				        return false;
				    }
				    if(typeof Array.prototype.indexOf === 'function'){
				        return !!~arr.indexOf(val)
				    }
				    for(i = 0, iLen = arr.length; i < iLen; i++){
				        if(val === arr[i]){
				            return true;
				        }
				    }
				    return false;
				}
			}
		});
		//加载数据  原本是AJAX操作 替换AJAX 
		var checkedData="<?php echo $classChecked['class_id'];?>";
		var checked = checkedData.split(",");
		var info={
				list:<?php echo json_encode($class);?>,
				checked:checked,
				teacher:"<?php echo $classChecked['teacher'];?>",
				student:"<?php echo $classChecked['student'];?>",
			}
			classList.list=info.list;
			classList.checked=info.checked;
			classList.teacher=info.teacher;
			classList.student=info.student;

			

	</script>
</html>
