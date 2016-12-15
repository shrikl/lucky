<?php 
	class LoginAction extends Action{
		public function index() {
			$endTime = strtotime('2017-1-16 12:00:00');
			$nowTime = time();
			if($nowTime >= $endTime) {
				$this->redirect('Index/index');
			}else{
				$this->display();
			}
		}
		public function do_login() {
			if(!$this->isPost()) {
				$this->redirect("Login/index");
			}

			$username = $_POST['username'];
			$password = $_POST['password'];
			$code     = $_POST['code'];

			if($_SESSION['code'] != md5($code)) {
				$this->error("验证码错误!");
			}

			$m = M('User');

			$data['username'] = $username;
			$data['password'] = $password;

			$arr = $m->field('id')->where($data)->find();

			if($arr) {
				$_SESSION['id'] = $arr['id'];
				$_SESSION['username'] = $username;
				$this->redirect('Account/index');
			}else{
				$this->error('用户名或密码错误!');
			}
		}
		public function do_logout() {
			$_SESSION = array();
			//判断是否基于COOKIE
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time()-1, '/');
			}
			session_destroy(); //清除服务器端的session文件
			$this->redirect('Login/index');
		}
	}
?>