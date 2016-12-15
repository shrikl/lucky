<?php
	class CommonAction extends Action{
		public function _initialize() {
			if(!isset($_SESSION['username']) && $_SESSION['username'] == "") {
				$this->redirect("Index/index");
			}else{
				$m = M('User');
				$data['username'] = $_SESSION['username'];
				$data['state'] = 0;
				$c = $m->where($data)->select();
				if(!$c) {
					$this->redirect("Index/index");
				}
			}
		}
	}
?>