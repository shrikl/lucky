<?php
	class IndexAction extends Action{
		public function index() {
			$endTime = strtotime('2017-1-16 12:00:00');
			$nowTime = time();
			if($nowTime >= $endTime) {
				$this->display();
			}else{
				$this->redirect('Login/index');
			}
		}
	}
?>