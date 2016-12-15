<?php
	class LoginAction extends Action{
		public function login() {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$code     = $_POST['code'];

			if($_SESSION['code'] != md5($code)) {
				$this->error("验证码错误!");
			}

			$m = D('User');
			$data['username'] = $username;
			$data['password'] = $password;
			$c = $m->where($data)->find();

			if($c) {
				if($c['state'] == 1) {
					$this->error('非管理员用户！');
				}else if($c['state'] == 0) {
					$_SESSION['id'] = $c['id'];
					$_SESSION['username'] = $username;
					$this->assign('option', 1);
					$this->display('Admin:index');
				}
			}else{
				$this->error('用户名或密码错误！');
			}
		}
		public function logout() {
			$_SESSION = array();
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-1, '/');
			}
			session_destroy();
			$this->redirect('Index/index');
		}
		public function checkName() {
			if($_GET['username']) {
				$username = $_GET['username'];
				$data['username'] = $username;
				$m = M('User');
				$c = $m->where($data)->count();
				if($c > 0) {
					echo 1;
				}else{
					echo 0;
				}
			}else{
				
			}
		}
		public function register() {
			$m = D('User');
			$m->create();
			$c = $m->add();
			if($c) {
				$this->redirect('Admin/userInfo');
			}else{
				$this->redirect('Admin/add');
			}
		}
	}
?>