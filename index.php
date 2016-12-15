<?php
	// 1. 确定应用名称 Home
	define('APP_NAME', 'Home');
	// 2. 确定应用路径 ‘./’ => 当前目录(所有目录名称首字母大写)
	define('APP_PATH', './Home/');
	// 3. 开启调试模式 取消缓存
	define('APP_DEBUG', true);
	// 4. 引入核心文件 严格区分大小写
	require './ThinkPHP/ThinkPHP.php';
?>