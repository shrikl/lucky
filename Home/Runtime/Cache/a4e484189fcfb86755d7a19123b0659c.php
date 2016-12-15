<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>今日账单</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jumbotron">
			<h1>Lucky Table Game</h1>
			<p>店小二 <?php echo (session('username')); ?> 你好</p>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__URL__/index" role="button" class="btn btn-primary btn-block">返回</a>
			</div>
		</div>
		<?php if(($accountList) == "0"): ?><div class="alert alert-danger" role="alert">
				<center><b>客人尚未到来</b></center>
				<center><b>钱财仍需等待</b></center>
			</div><?php endif; ?>
		<?php if(($accountList) != "0"): ?><div class="panel panel-primary">
				<div class="panel-heading">
					今日总览
				</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td><span class="label label-warning">应收总额</span>&nbsp;<?php echo ($tmoney); ?>元</td>
							<td><span class="label label-warning">总客流量</span>&nbsp;<?php echo ($pnumber); ?>人</td>
							<td><span class="label label-warning">矿&nbsp;泉&nbsp;水</span>&nbsp;<?php echo ($y2n); ?>支</td>
						</tr>
						<tr>
							<td><span class="label label-warning">实收总额</span>&nbsp;<?php echo ($amoney); ?>元</td>
							<td><span class="label label-warning">总会员数</span>&nbsp;<?php echo ($vnumber); ?>人</td>
							<td><span class="label label-warning">4元饮料</span>&nbsp;<?php echo ($y4n); ?>支</td>
						</tr>
						<tr>
							<td><span class="label label-warning">现金收款</span>&nbsp;<?php echo ($xpay); ?>元</td>
							<td><span class="label label-warning">微信收款</span>&nbsp;<?php echo ($wpay); ?>元</td>
							<td><span class="label label-warning">支付宝收款</span>&nbsp;<?php echo ($zpay); ?>元</td>
						</tr>
					</table>
				</div>
			</div><?php endif; ?>
		<?php if(is_array($accountList)): foreach($accountList as $key=>$a): ?><div class="panel panel-primary">
				<div class="panel-heading">
					订单号: <?php echo (date('YmdHis',$a["stime"])); ?>
				</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>
								<span class="label label-warning">开始时间</span>
							</td>
							<td>
								<span class="label label-warning">结束时间</span>
							</td>
							<td>
								<span class="label label-warning">客官人数</span>
							</td>
							<td>
								<span class="label label-warning">会员人数</span>
							</td>
							<td>
								<span class="label label-warning">桌子号码</span>
							</td>
							<td>
								<span class="label label-warning">应收金额</span>
							</td>
							<td>
								<span class="label label-warning">实收金额</span>
							</td>
						</tr>
						<tr class="info">
							<td>
								<?php echo (date('H:i',$a["stime"])); ?>
							</td>
							<td>
								<?php echo (date('H:i',$a["etime"])); ?>
							</td>
							<td>
								<?php echo ($a["pnumber"]); ?>
							</td>
							<td>
								<?php echo ($a["vnumber"]); ?>
							</td>
							<td>
								<?php if($a["tnumber"] == 888): ?>包房
									<?php else: ?>
										<?php echo ($a["tnumber"]); ?>号桌<?php endif; ?>
							</td>
							<td>
								<?php echo ($a["total"]); ?>
							</td>
							<td>
								<?php echo ($a["actual"]); ?>
							</td>
						</tr>
					</table>
				</div>
				<div class="panel-footer">
					<span class="label label-warning">店小二</span>&nbsp;&nbsp;<?php echo ($a["administrator"]); ?>
					&nbsp;&nbsp;
					<span class="label label-warning">收银人</span>&nbsp;&nbsp;<?php echo ($a["cid"]); ?>
				</div>
			</div><?php endforeach; endif; ?>
	</div>
	<div class="col-md-2"></div>
</div>
</body>
</html>