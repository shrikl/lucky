<?php
	class CommonAction extends Action{
		/**
 	 	 * 初始化方法 _initialize接口
 	 	 * 可用于扩展需要
 	 	 */
		public function _initialize() {
			if(!isset($_SESSION['username']) || $_SESSION['username'] == "") {
				$this->redirect("Index/index");
			}else{
				// $m = D('User');
				// $data['username'] = $_SESSION['username'];
				// $c = $m->where($data)->find();
				// if(!$c) {
				// 	$this->redirect("Index/index");
				// }
			}
		}
	}
?>