<?php
	class AccountModel extends RelationModel{
		protected $_auto = array(
			array("stime", "time", 1, "function"),
			array("uid", "getId", 1, "callback"),
			array("oid", "getOid", 1, "callback"),
		);
		protected $_link = array(
			"User" => array(
				'mapping_type' => BELONGS_TO,
				// 'class_name' => 'User',
				'foreign_key' => 'uid',
				'mapping_name' => 'auser',
				// 'mapping_fields' => 'username',
				'as_fields' => 'username:administrator',
			),
		);
		protected function getId() {
			return $_SESSION['id'];
		}
		protected function getOid() {
			return md5(time());
		}
	}
?>