<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>乐启后台管理系统 -- 管理员登录</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row" style="margin-top: 10%;">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				乐启后台管理系统 -- 管理员登录
			</div>
			<div class="panel-body">
				<form action="__APP__/Login/login" method="post" role="form">
					<div class="input-group form-group">
						<span class="input-group-addon">用户名</span>
						<input type="text" name="username" class="form-control" onkeyup="check()">
					</div>
					<div class="input-group form-group">
						<span class="input-group-addon">&nbsp;密&nbsp;码&nbsp;</span>
						<input type="password" name="password" class="form-control" onkeyup="check()">
					</div>
					<div class="input-group form-group">
						<span class="input-group-addon">验证码</span>
						<input type="text" name="code" class="form-control" onkeyup="check()">
						<span class="input-group-addon">
							<img src="__APP__/Public/code" onclick="this.src=this.src+'?'+Math.random()" id="codeimg">&nbsp;&nbsp;
							<a href="#" onclick="changeCode()">换一张</a>
						</span>
					</div>
					<button type="submit" class="btn btn-primary btn-block" id="subBtn" disabled="disabled">登录</button>
					<a href="__ROOT__/index.php/Login/index" role="button" class="btn btn-primary btn-block">乐启账本</a>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>

<script type="text/javascript">
	function changeCode() {
		var codeimg = document.getElementById("codeimg");
		codeimg.src = codeimg.src+'?'+Math.random();
	}
	function check() {
		var ou = document.getElementsByName("username")[0].value;
		var op = document.getElementsByName("password")[0].value;
		var oc = document.getElementsByName("code")[0].value;
		if(ou == "" || op == "" || oc == "") {
			document.getElementById("subBtn").disabled = "disabled";
		}else{
			document.getElementById("subBtn").removeAttribute("disabled");
		}
	}
</script>
</body>
</html>