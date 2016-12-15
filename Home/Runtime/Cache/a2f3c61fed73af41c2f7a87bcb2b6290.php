<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>乐启账本 -- 首页</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/bootstrap-datetimepicker.min.css">
	<script src="__PUBLIC__/Js/bootstrap-datetimepicker.js"></script>
	<script src="__PUBLIC__/Js/bootstrap-datetimepicker.fr.js"></script>
</head>
<body>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jumbotron">
			<h1>Lucky Table Game</h1>
			<p>店小二 <?php echo (session('username')); ?> 你好</p>
			<p><a href="__APP__/Login/do_logout" target="_top">退出登录</a></p>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">来客人啦</div>
			<div class="panel-body">
				<form action="__URL__/newOrder" method="post" role="form">
					<div class="form-group input-group">
						<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;一共来了</span>
						<input type="number" class="form-control" id="newOrderPnumber" name="pnumber" onkeyup="check()">
						<span class="input-group-addon">位客官&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其中有&nbsp;</span>
						<input type="number" class="form-control" id="newOrderVnumber" name="vnumber" onkeyup="check()">
						<span class="input-group-addon">位是尊贵会员</span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">他们就坐于</span>
						<input type="number" class="form-control" id="newOrderTnumber" name="tnumber" onkeyup="check()">
						<span class="input-group-addon">号桌&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</div>
					<button type="submit" class="btn btn-primary btn-block" id="newOrderSubBtn" disabled="disabled">Game Start</button>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__URL__/todayAccount" role="button" class="btn btn-primary btn-block">今日账单</a>
			</div>
		</div>
		<form action="__URL__/historyAccount" method="post" role="form">
			<div class="panel-group" id="historyAccountAccordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="historyAccountHeadingOne">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#historyAccountAccordion" href="#historyAccountCollapseOne" aria-expanded="true" aria-controls="historyAccountCollapseOne" role="button" class="btn btn-primary btn-block" style="color: white;">
							历史账单
							</a>
						</h4>
					</div>
					<div id="historyAccountCollapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="historyAccountHeadingOne">
						<div class="panel-body">
							<div class="input-group form-group">
								<span class="input-group-addon">日期</span>
								<input type="text" id="historyAccountInp1" name="historyAccountSdate" readonly class="form-control" onchange="checkHistoryDate()">
								<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
								<input type="text" id="historyAccountInp2" name="historyAccountEdate" readonly class="form-control" onchange="checkHistoryDate()">
							</div>
						</div>
						<div class="panel-footer">
							<button type="submit" id="historyAccountSubBtn" class="btn btn-warning btn-block" disabled="disabled">查询</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Wolf/index" role="button" class="btn btn-primary btn-block" disabled="disabled">预定(暂不可用)</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Wolf/index" role="button" class="btn btn-primary btn-block" disabled="disabled">发布狼人赛(暂不可用)</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/User/index" role="button" class="btn btn-primary btn-block" disabled="disabled">会员管理(暂不可用)</a>
			</div>
		</div>
		<!-- <div class="panel panel-default">
			<div class="panel-body">
				<a href="__URL__/test" role="button" class="btn btn-primary btn-block">Test</a>
			</div>
		</div> -->
	</div>	
	<div class="col-md-5">
		<?php if(($accountList) == "0"): ?><div class="alert alert-danger" role="alert">
				<center><b>现在没有客人哦</b></center>
				<br><br>
				<center><b>桌游收好了吗？</b></center>
				<center><b>垃圾收拾了吗？</b></center>
				<center><b>桌椅摆放好没？</b></center>
				<center><b>冰箱饮料加满！</b></center>
				<center><b>有空别闲着</b></center>
				<center><b>复习复习旧桌游</b></center>
				<center><b>练习练习桌游教学</b></center>
				<center><b>学习学习新游戏</b></center>
				<center><b>招揽招揽客人</b></center>
				<center><b>打扫打扫店面</b></center>
				<center><b>都做完了？很好，去抽根烟吧</b></center>
			</div><?php endif; ?>
		<?php if(is_array($accountList)): foreach($accountList as $key=>$a): ?><div class="panel panel-primary">
				<div class="panel-heading">
					<table width="100%">
						<tr>
							<td align="left">
								订单号: <?php echo (date('YmdHis',$a["stime"])); ?>
							</td>
							<td align="right">
								<a href="#" class="btn btn-success" role="button" data-toggle="modal" data-target="#ASAWindow" name="<?php echo ($a["id"]); ?>" onclick="initializeASAWindow(this.name)">江湖告急先走一步</a>
								<a href="#" class="btn btn-success" role="button" data-toggle="modal" data-target="#SAWindow" name="<?php echo ($a["id"]); ?>" onclick="initializeSAWindow(this.name)">客人要结账咯</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<span class="label label-warning">开始时间</span>&nbsp;&nbsp;<?php echo (date('H:i',$a["stime"])); ?>
					</div>
					<div class="form-group">
						<table width="100%">
							<tr>
								<td align="left">
									<span class="label label-warning">客官人数</span>&nbsp;&nbsp;<?php echo ($a["pnumber"]); ?>
								</td>
								<td align="right" width="50%">
									<div class="input-group">
										<span class="input-group-addon">矿&nbsp;泉&nbsp;水</span>
										<span class="input-group-btn">
											<button type="button" class="btn btn-warning" onclick="plusy2s(<?php echo ($a["id"]); ?>)"><span class="glyphicon glyphicon-plus"></span></button>
										</span>
										<input type="number" class="form-control" id="2y<?php echo ($a["id"]); ?>" value="<?php echo ($a["y2s"]); ?>" disabled>
										<span class="input-group-btn">
											<button type="button" class="btn btn-warning" onclick="suby2s(<?php echo ($a["id"]); ?>)"><span class="glyphicon glyphicon-minus"></span></button>
										</span>
										<span class="input-group-addon">支</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<table width="100%">
							<tr>
								<td align="left">
									<span class="label label-warning">会员人数</span>&nbsp;&nbsp;<?php echo ($a["vnumber"]); ?>
								</td>
								<td align="right" width="50%">
									<div class="input-group">
										<span class="input-group-addon">4元饮料</span>
										<span class="input-group-btn"><button type="button" class="btn btn-warning" onclick="plusy4s(<?php echo ($a["id"]); ?>)"><span class="glyphicon glyphicon-plus"></span></button></span>
										<input type="number" class="form-control" id="4y<?php echo ($a["id"]); ?>" value="<?php echo ($a["y4s"]); ?>" disabled>
										<span class="input-group-btn"><button type="button" class="btn btn-warning" onclick="suby4s(<?php echo ($a["id"]); ?>)"><span class="glyphicon glyphicon-minus"></span></button></span>
										<span class="input-group-addon">支</span>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<table width="100%">
							<tr>
								<td align="left">
									<span class="label label-warning">桌子号码</span>&nbsp;
									<?php if($a["tnumber"] == 888): ?>包房
										<?php else: ?>
											<?php echo ($a["tnumber"]); ?>号桌<?php endif; ?>
								</td>
								<td align="right" width="50%">
									<div class="input-group">
										<span class="input-group-addon">备注</span>
										<input type="text" class="form-control" value="<?php echo ($a["remark"]); ?>" onchange="addRemark(<?php echo ($a["id"]); ?>,this.value)">
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<table width="100%">
						<tr>
							<td align="left">
								<span class="label label-warning">店小二</span>&nbsp;&nbsp;<?php echo ($a["administrator"]); ?>
							</td>
							<td align="right" onclick="de(this.id)" id="td<?php echo ($a["id"]); ?>">
								<form role="form" action="__URL__/deleteAccount" method="post">
									<input type="hidden" name="deleteAccountId" value="<?php echo ($a["id"]); ?>">
									<button type="submit" class="btn btn-danger" disabled="disabled">删除</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
			</div><?php endforeach; endif; ?>
	</div>
	<div class="col-md-2"></div>
</div>

<!-- Settle Account Window -->
<div class="modal fade" id="SAWindow" tabindex="-1" role="dialog" aria-labelledby="SAWindowLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="SAWindowLabel">有钱收啦</h4>
			</div>
			<form action="__URL__/settleAccount" method="post" role="form">			
				<div class="modal-body">
					<div class="form-group input-group">
						<span class="input-group-addon">应收</span>
						<input type="text" class="form-control" id="settleAccountTotal" disabled="disabled">
						<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">实收</span>

						<input type="hidden" id="settleAccountId" name="settleAccountId">
						
						<input type="number" class="form-control" id="settleAccountActual" step="0.5" name="settleAccountActual" onkeyup="checkSA()">
						<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
					</div>
					<div class="btn-group" data-toggle="buttons" style="width: 100%">
						<label class="btn btn-primary active" style="width: 33%">
							<input type="radio" name="settleAccountPayment" value="1" autocomplete="off" checked>现金
						</label>
						<label class="btn btn-primary" style="width: 33%">
							<input type="radio" name="settleAccountPayment" value="2" autocomplete="off">微信
						</label>
						<label class="btn btn-primary" style="width: 34%">
							<input type="radio" name="settleAccountPayment" value="3" autocomplete="off">支付宝
						</label>
					</div>
					时间: <span id="time"></span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="SASubBtn" disabled="disabled">袋入袋</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Advance Settle Account Window -->
<div class="modal fade" id="ASAWindow" tabindex="-1" role="dialog" aria-labelledby="ASAWindowLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="ASAWindowLabel">人走钱留</h4>
			</div>
			<form action="__URL__/advanceSettleAccount" method="post" role="form">			
				<div class="modal-body">
					<div class="form-group input-group">
						<span class="input-group-addon">先走</span>
						<input type="number" class="form-control" id="advanceSettleAccountPnumber" name="advanceSettleAccountPnumber" onkeyup="getASA()">
						<span class="input-group-addon">人</span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">会员</span>
						<input type="number" class="form-control" id="advanceSettleAccountVnumber" name="advanceSettleAccountVnumber" value="0" onkeyup="getASA()" disabled="disabled">
						<span class="input-group-addon">人</span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">应收</span>
						<input type="text" class="form-control" id="advanceSettleAccountTotal" disabled="disabled">
						<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">实收</span>

						<input type="hidden" id="advanceSettleAccountId" name="advanceSettleAccountId">
						<input type="hidden" id="advanceSettleAccountYs" name="advanceSettleAccountYs">
						<input type="hidden" id="advanceSettleAccountEtime" name="advanceSettleAccountEtime">

						<input type="number" class="form-control" id="advanceSettleAccountActual" step="0.5" name="advanceSettleAccountActual" onkeyup="checkASA()">
						<span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
					</div>
					<div class="btn-group" data-toggle="buttons" style="width: 100%">
						<label class="btn btn-primary active" style="width: 33%">
							<input type="radio" name="advanceSettleAccountPayment" value="1" autocomplete="off" checked>现金
						</label>
						<label class="btn btn-primary" style="width: 33%">
							<input type="radio" name="advanceSettleAccountPayment" value="2" autocomplete="off">微信
						</label>
						<label class="btn btn-primary" style="width: 34%">
							<input type="radio" name="advanceSettleAccountPayment" value="3" autocomplete="off">支付宝
						</label>
					</div>
					时间: <span id="advanceSettleAccountTime"></span>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="ASASubBtn" disabled="disabled">袋入袋</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	/*********************************************************************************/
	/*******************************取消删除按钮的禁用状态****************************/
	function de(id) {
		var c = "#" + id;
		$(c).find("button:first").removeAttr("disabled");
	}
	/*********************************************************************************/
	/********************初始化结账窗口 ajax获取结账金额和时间************************/
	function initializeSAWindow(id) {
		document.getElementById("settleAccountActual").value = "";
		document.getElementById("settleAccountId").value     = id;
		var y2 = document.getElementById("2y"+id).value;
		var y4 = document.getElementById("4y"+id).value;
		$.get('__URL__/getSettleAccount', {
			"id": id,
			"y2": y2,
			"y4": y4,
		}, function(jdata) {
			document.getElementById("settleAccountTotal").value = jdata['total'];
			document.getElementById("time").innerHTML           = jdata['sc'];
		});
	}
	/*********************************************************************************/
	/*******************************初始化提前结账窗口********************************/
	function initializeASAWindow(id) {
		document.getElementById("advanceSettleAccountId").value         = id;
		document.getElementById("advanceSettleAccountPnumber").value    = "";
		document.getElementById("advanceSettleAccountTotal").value      = "";
		document.getElementById("advanceSettleAccountActual").value     = "";
		document.getElementById("advanceSettleAccountVnumber").value    = "0";
		document.getElementById("advanceSettleAccountVnumber").disabled = "disabled";
		document.getElementById("advanceSettleAccountTime").innerHTML   = "";
	}
	/*********************************************************************************/
	/**************************ajax获取提前结账金额和时间*****************************/
	function getASA() {
		var p = document.getElementById("advanceSettleAccountPnumber").value;
		var v = document.getElementById("advanceSettleAccountVnumber").value;
		var maxp;
		if(p == "" || p == 0) {
			document.getElementById("advanceSettleAccountVnumber").disabled = "disabled";
			document.getElementById("advanceSettleAccountVnumber").value    = 0;
		}else{
			document.getElementById("advanceSettleAccountVnumber").removeAttribute("disabled");
		}
		var id = document.getElementById("advanceSettleAccountId").value;
		// alert(v);
		$.get('__URL__/getAdvanceSettleAccount', {
			"id": id,
			"p": p,
			"v": v,
		}, function(jdata) {
			maxp = jdata['pnumber'];
			maxv = jdata['vnumber'];
			if(parseInt(p) >= parseInt(maxp)) {
				alert("先走人数需小于总人数！");
				document.getElementById("advanceSettleAccountPnumber").value  = "";
				emptyAll();
			}else if(parseInt(v) != 0) {
				if(parseInt(v) > parseInt(maxv)) {
					alert("会员人数需小于总会员人数！");
					document.getElementById("advanceSettleAccountVnumber").value  = 0;
					emptyAll();
				}else{
					if(parseInt(v) > parseInt(p)) {
						alert("会员人数需小于先走人数！");
						document.getElementById("advanceSettleAccountVnumber").value  = 0;
						emptyAll();
					}else{
						document.getElementById("advanceSettleAccountTotal").value    = jdata['total'];
						document.getElementById("advanceSettleAccountYs").value       = jdata['total'];
						document.getElementById("advanceSettleAccountEtime").value    = jdata['etime'];
						document.getElementById("advanceSettleAccountTime").innerHTML = jdata['sc'];
					}
				}
			}else{
				document.getElementById("advanceSettleAccountTotal").value    = jdata['total'];
				document.getElementById("advanceSettleAccountYs").value       = jdata['total'];
				document.getElementById("advanceSettleAccountEtime").value    = jdata['etime'];
				document.getElementById("advanceSettleAccountTime").innerHTML = jdata['sc'];
			}
		});
		checkASA();
	}
	function emptyAll() {
		document.getElementById("advanceSettleAccountTotal").value    = "";
		document.getElementById("advanceSettleAccountYs").value       = "";
		document.getElementById("advanceSettleAccountEtime").value    = "";
		document.getElementById("advanceSettleAccountTime").innerHTML = "";
	}
	/*********************************************************************************/
	/********************检查新增订单的表单输入域是否有为空项*************************/
	function check() {
		var p = document.getElementById("newOrderPnumber").value;
		var v = document.getElementById("newOrderVnumber").value;
		var t = document.getElementById("newOrderTnumber").value;
		if(p == "" || v == "" || t == "") {
			document.getElementById("newOrderSubBtn").disabled = "disabled";
		}else{
			document.getElementById("newOrderSubBtn").removeAttribute("disabled");
		}
	}
	/*********************************************************************************/
	/************************检查结账订单的表单输入域是否有为空项*********************/
	function checkSA() {
		var a = document.getElementById("settleAccountActual").value;
		if(a == "" || a == 0) {
			document.getElementById("SASubBtn").disabled = "disabled";
		}else{
			document.getElementById("SASubBtn").removeAttribute("disabled");
		}
	}
	/*********************************************************************************/
	/********************检查提前结账订单的表单输入域是否有为空项*********************/
	function checkASA() {
		var p = document.getElementById("advanceSettleAccountPnumber").value;
		var v = document.getElementById("advanceSettleAccountVnumber").value;
		var a = document.getElementById("advanceSettleAccountActual").value;
		var y = document.getElementById("advanceSettleAccountYs").value;
		if(a == "" || a == 0 || p == "" || p == 0 || v == "" || y == "" || isNaN(y)) {
			document.getElementById("ASASubBtn").disabled = "disabled";
		}else{
			document.getElementById("ASASubBtn").removeAttribute("disabled");
		}
	}
	/*********************************************************************************/
	/**********************************modifywater************************************/
	function plusy2s(id) {
		var y2 = document.getElementById("2y"+id).value;
		y2 = parseInt(y2);
		y2 += 1;
		document.getElementById("2y"+id).value = y2;
		modifywater(id, 2, y2);
	}
	function suby2s(id) {
		var y2 = document.getElementById("2y"+id).value;
		y2 = parseInt(y2);
		y2 -= 1;
		if(y2 < 0) {
			document.getElementById("2y"+id).value = "0";
			y2 = 0;
		}else{
			document.getElementById("2y"+id).value = y2;
		}
		modifywater(id, 2, y2);
	}
	function plusy4s(id) {
		var y4 = document.getElementById("4y"+id).value;
		y4 = parseInt(y4);
		y4 += 1;
		document.getElementById("4y"+id).value = y4;
		modifywater(id, 4, y4);
	}
	function suby4s(id) {
		var y4 = document.getElementById("4y"+id).value;
		y4 = parseInt(y4);
		y4 -= 1;
		if(y4 < 0) {
			document.getElementById("4y"+id).value = "0";
			y4 = 0;
		}else{
			document.getElementById("4y"+id).value = y4;
		}
		modifywater(id, 4, y4);
	}
	function modifywater(id, y, n) {
		$.get('__URL__/modifyWater', {
			"id": id,
			"y": y,
			"n": n,
		}, function(jdata) {

		});
	}
	/*********************************************************************************/
	/******************************检查历史记录时间段*********************************/
	function checkHistoryDate() {
		var d1 = document.getElementById("historyAccountInp1").value;
		var d2 = document.getElementById("historyAccountInp2").value;
		if(d1 != "" && d2 != "") {
			d1 = d1 + " 00:00:00";
			d2 = d2 + " 00:00:00";
			d1 = Date.parse(new Date(d1));
			d2 = Date.parse(new Date(d2));
			d1 = d1 / 1000;
			d2 = d2 / 1000;
			if(d1 > d2) {
				alert("日期选择有误，请重新选择！");
				document.getElementById("historyAccountInp1").value = "";
				document.getElementById("historyAccountInp2").value = "";
				document.getElementById("historyAccountSubBtn").disabled = "disabled";
			}else{
				document.getElementById("historyAccountSubBtn").removeAttribute("disabled");
			}
		}
	}
	/*********************************************************************************/
	/**********************************添加备注***************************************/
	function addRemark(id, value) {
		$.get('__URL__/addRemark', {
			"id": id,
			"content": value,
		}, function(jdata) {
			// alert(jdata);
		});
	}
	/*********************************************************************************/
</script>
<script type="text/javascript">
	$("#historyAccountInp1").datetimepicker({
		format: 'yyyy-mm-dd',
		weekStart: 0,
		// todayBtn:  1,
		autoclose: true,
		// todayHighlight: 1,
		startView: 2,
		minView: 2,
		startDate: '2016-1-1',
		endDate: new Date(),
		// forceParse: 0,
		// showMeridian: 1
	});
	$("#historyAccountInp2").datetimepicker({
		format: 'yyyy-mm-dd',
		weekStart: 0,
		// todayBtn:  1,
		autoclose: true,
		// todayHighlight: 1,
		startView: 2,
		minView: 2,
		startDate: '2016-1-1',
		endDate: new Date(),
		// forceParse: 0,
		// showMeridian: 1
	});
</script>
</body>
</html>