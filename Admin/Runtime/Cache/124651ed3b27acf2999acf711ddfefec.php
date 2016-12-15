<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>乐启后台管理系统</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div>
	<div class="row" style="margin-bottom: 25px;">
		<div class="col-md-11" style="padding-top: 15px;padding-left: 30px;">乐启后台管理系统</div>
		<div class="col-md-1" style="padding-top: 15px;">
			<div class="dropdown">
				<span class="glyphicon glyphicon-user"></span>
				&nbsp;<?php echo (session('username')); ?>&nbsp;
				<a href="#" id="dropdownLogout" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-chevron-down"></span>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownLogout">
					<li><a href="__APP__/Login/logout">退出登录</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Admin/index?option=1" role="button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-home"></span>&nbsp;首页</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Admin/userInfo" role="button" class="btn btn-primary btn-block">用户信息管理</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Admin/userInfo" role="button" class="btn btn-primary btn-block" disabled="disabled">用户权限管理(暂不可用)</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<a href="__APP__/Admin/userInfo" role="button" class="btn btn-primary btn-block" disabled="disabled">收费规则(暂不可用)</a>
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<?php if(($option) == "1"): ?><div class="panel panel-primary">
				<div class="panel-heading">
					服务器信息
				</div>
				<div class="panel-body">
					<ul class="current-status">
                                <li>
                                    <span></span> <span class="bold">登录时间 :<?php echo date('Y-m-d H:i:s',time()) ?> </span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">服务器系统 :<?php echo ($_SERVER['SERVER_SOFTWARE']); ?> </span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">服务器软件 : <?php echo php_uname();?> </span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">PHP版本 : 5.4.16</span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">MYSQL版本 : 5.6.12</span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">主机名 :<?php echo ($_SERVER['HTTP_HOST']); ?> </span>
                                </li>
                                <li>
                                    <span></span> <span class="bold">通信协议 : <?php echo ($_SERVER['REQUEST_SCHEME']); ?></span>
                                </li>
                            </ul>
				</div>
				<div class="panel-footer">
					<div class="alert alert-success" role="alert">
                        <span class="icon-info-sign" aria-hidden="true"></span>
                        <span class="sr-only">错误:</span>
                            系统提示：强烈建议您使用IE9+、新版本的chrome、safari、firfox、opera浏览器
                    </div>
				</div>
			</div><?php endif; ?>
		<?php if(($option) == "2"): ?><div class="panel panel-default">
			<div class="panel-heading">
				<a href="__URL__/add" role="button" class="btn btn-primary">新增用户</a>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>ID</td>
						<td>用户名</td>
						<td>性别</td>
						<td>注册时间</td>
						<td>权限</td>
						<td>操作</td>
					</tr>
					<?php if(is_array($userInfo)): foreach($userInfo as $key=>$u): ?><tr>
						<td><?php echo ($u["id"]); ?></td>
						<td><?php echo ($u["username"]); ?></td>
						<td>
							<?php if($u["sex"] == 1): ?>男
							<?php else: ?>
							女<?php endif; ?>
						</td>
						<td><?php echo (date('Y-m-d',$u["time"])); ?></td>
						<td>
							<?php if($u["state"] == 1): ?>店小二
								<?php else: ?>
									管理员<?php endif; ?>
						</td>
						<td>
							<?php if($u["state"] == 1): ?><a href="__URL__/modifyPass?id=<?php echo ($u["id"]); ?>" role="button" class="btn btn-primary">修改密码</a>
								<?php else: endif; ?>
							<?php if($u["state"] == 1): ?><span id="delBtn<?php echo ($u["id"]); ?>" onclick="confirmDel(this.id)"><a href="__URL__/del?id=<?php echo ($u["id"]); ?>" role="button" class="btn btn-primary" disabled="disabled">删除用户</a></span>
								<?php else: endif; ?>
						</td>
					</tr><?php endforeach; endif; ?>
				</table>
			</div>
		</div><?php endif; ?>
		<?php if(($option) == "3"): ?><div class="panel panel-default">
				<div class="panel-heading">
					<table width="100%">
						<tr>
							<td align="left">新增用户</td>
							<td align="right"><a href="__URL__/userInfo" role="button" class="btn btn-primary">返回</a></td>
						</tr>
					</table>
				</div>
				<div class="panel-body" style="width: 30%;margin-left: 100px;">
					<form action="__APP__/Login/register" method="post" role="form" name="doRegisterForm" >
						<div class="input-group form-group">
							<span class="input-group-addon">&nbsp;用&nbsp;户&nbsp;名&nbsp;</span>
							<input type="text" name="username" class="form-control" onkeyup="check()">
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon">&nbsp;&nbsp;&nbsp;密&nbsp;码&nbsp;&nbsp;&nbsp;</span>
							<input type="password" name="password" class="form-control" onkeyup="check()">
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon">确认密码</span>
							<input type="password" name="confirm" class="form-control" onkeyup="check()">
						</div>
						<!-- <div class="input-group form-group">
							<span class="input-group-addon">状态</span>
							<input type="password" name="password" class="form-control">
						</div> -->
						<div class="btn-group form-group input-group" data-toggle="buttons">
    						<span class="input-group-addon">&nbsp;&nbsp;&nbsp;性&nbsp;别&nbsp;&nbsp;&nbsp;</span>
    						<label class="btn btn-primary active" style="width: 50%">
    							<input type="radio" name="sex" autocomplete="off" value="1" checked="">男
    						</label>
    						<label class="btn btn-primary" style="width: 50%">
    							<input type="radio" name="sex" autocomplete="off" value="0">女
    						</label>
    					</div>
    					<!-- <div class="btn-group form-group input-group" data-toggle="buttons">
    						<span class="input-group-addon">&nbsp;&nbsp;&nbsp;权&nbsp;限&nbsp;&nbsp;&nbsp;</span>
    						<label class="btn btn-primary active" style="width: 50%">
    							<input type="radio" name="state" autocomplete="off" value="1" checked="">店员
    						</label>
    						<label class="btn btn-primary" style="width: 50%">
    							<input type="radio" name="state" autocomplete="off" value="0">管理员
    						</label>
    					</div> -->
						<button type="submit" class="btn btn-primary btn-block" name="subbtn" disabled="">提交</button>
					</form>
				</div>
			</div><?php endif; ?>
		<?php if(($option) == "4"): ?><div class="panel panel-default">
				<div class="panel-heading">
					<table width="100%">
						<tr>
							<td align="left">修改密码</td>
							<td align="right">
								<a href="__URL__/userInfo" role="button" class="btn btn-primary">返回</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="panel-body" style="width: 30%;margin-left: 100px;">
					<form action="__URL__/newPassword" method="post" role="form">
						<div class="input-group form-group">
							<span class="input-group-addon">新密码</span>
							<input type="hidden" name="id" value="<?php echo ($id); ?>">
							<input type="password" name="newpassword" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary btn-block">提交</button>
					</form>
				</div>
			</div><?php endif; ?>
	</div>
</div>

<script> 
    $(function() {
    	$("#dropdownLogout").popover(); 
    }); 
</script>
<script type="text/javascript">
	$(function() {
		$("input[name='username']").keyup(function() {
			var username = $(this).val();
			$.get("__APP__/Login/checkName", {
				"username": username
			}, function(jdata) {
				if(jdata == 1) {
					if(!document.getElementById("chkname")) {
						$("input[name='username']").after("<span class='input-group-addon' id='chkname'>用户名已存在</span>");
					}
					document.getElementsByName("subbtn")[0].disabled = "disabled";
				}else if(jdata == 0) {
					if(document.getElementById("chkname")) {
						$("span#chkname").remove();
					}
				}
			});
		});
	});
</script>
<script type="text/javascript">
	function check() {
		var ou  = document.doRegisterForm.username.value;
		var op1 = document.doRegisterForm.password.value;
		var op2 = document.doRegisterForm.confirm.value;
		var ob  = document.getElementsByName("subbtn")[0];
		var s1  = "<span class='glyphicon glyphicon-remove'></span>";
		var s2  = "<span class='input-group-addon' id='chkspan'><span class='glyphicon glyphicon-remove'></span></span>";
		var s3  = "<span class='glyphicon glyphicon-ok'></span>";
		var s4  = "<span class='input-group-addon' id='chkspan'><span class='glyphicon glyphicon-ok'></span></span>";
		if(op1 == "" && op2 == "") {
			$("span#chkspan").remove();
		}
		if(op1 != op2) {
			if(document.getElementById("chkspan")) {
				$("span#chkspan").html(s1);
			}else{
				$("input[name='confirm']").after(s2);
			}
		}else if(op1 == op2 && op1 != "" && op2 != ""){
			if(document.getElementById("chkspan")) {
				$("span#chkspan").html(s3);
			}else{
				$("input[name='confirm']").after(s4);
			}
		}
		if(ou == "" || op1 == "" || op2 == "") {
			ob.disabled = "disabled";
		}else {
			if(op1 != op2) {
				ob.disabled = "disabled";
			}else if(op1 == op2 && op1 != "" && op2 != ""){
				ob.removeAttribute("disabled");
			}
		}
	}
	function confirmDel(id) {
		var c = "#" + id;
		$(c).find("a:first").removeAttr("disabled");
	}
</script>
</body>
</html>