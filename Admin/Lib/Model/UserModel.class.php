<?php
	class UserModel extends Model{
		//实现自动验证
		protected $_auto = array(
			array("time", "time", 1, "function"),
		);
	}
?>