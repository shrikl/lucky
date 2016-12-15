<?php
	class AdminAction extends CommonAction{
		public function index() {
			$this->assign('option', $_GET['option']);
			$this->display();
		}
		public function userInfo() {
			$m = D('User');
			$arr = $m->select();
			$this->assign('option', 2);
			$this->assign('userInfo', $arr);
			$this->display('index');
		}
		public function add() {
			$this->assign('option', 3);
			$this->display('index');
		}
		public function del() {
			$id = $_GET['id'];
			$m = D('User');
			$c = $m->where('id='.$id)->delete();
			if($c) {
				$this->redirect('userInfo');
			}else{
				$this->error("删除失败！");
			}
		}
		public function modifyPass() {
			$id = $_GET['id'];
			$this->assign('id', $id);
			$this->assign('option', 4);
			$this->display('index');
		}
		public function newPassword() {
			$id = $_POST['id'];
			$newpassword = $_POST['newpassword'];
			$m = D('User');
			$data['password'] = $newpassword;
			$c = $m->where('id='.$id)->save($data);
			if($c) {
				$this->redirect('userInfo');
			}else{
				$this->error("修改失败！");
			}
		}
	}
?>