<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>creatsql</title>
</head>

<body>
	<h1>数据库脚本启动</h1>
	<?php
	$host = 'localhost:3306'; //数据库地址与端口
	$username = 'root';		//数据库账号名
	$password = 'password';	//数据库密码
	$dbname = 'bbs_gojohnny'; //数据库名称

	$conn = mysqli_connect($host, $username, $password);
	mysqli_set_charset($conn, 'utf8'); //初次连接数据库

	if ($conn == FALSE) {
		die('<p>连接失败了小火汁</p>');
	} else {
		echo ('<p>成功辣！！！</p>');
	}

	//创建数据库
	$shell = 'CREATE DATABASE ' . $dbname;
	if (mysqli_query($conn, $shell)) {
		echo '<p>数据库创建成功辣！！！</p>';
	} else {
		echo '<br>数据库创建失败失败失败失败失败：' . mysqli_error($conn);
		echo '<p>或许是已经创建成功惹(小声bb)</p>';
	}

	//创建板块表 forums
	$conn = mysqli_connect($host, $username, $password, $dbname);
	mysqli_set_charset($conn, 'utf8'); //重新连接数据库

	if ($conn == FALSE) {
		die('<p>很遗憾，重连失败</p>');
	} else {
		echo ('<p>重连成功！！！</p>');
	}

	$shell = "CREATE TABLE forums (
 id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 `forum_name` varchar(50) NOT NULL,
  `forum_description` varchar(200) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `last_post_time` datetime NOT NULL
 );"; //具体表字段设置
	if (mysqli_query($conn, $shell)) {
		echo "<p>数据表 forums 创建成功辣</p>";
	} else {
		echo "<br>创建数据表 forums 错误错误错误: " . mysqli_error($conn);
	}

	//创建用户表 member
	$shell = "CREATE TABLE member (
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
   `level` INT(11) NOT NULL DEFAULT '1',
   `title` VARCHAR(50) NULL DEFAULT NULL,
   `user_description` TEXT NULL DEFAULT NULL,
  `log_time` datetime NOT NULL
);";
	if (mysqli_query($conn, $shell)) {
		echo "<p>数据表 member 创建成功辣</p>";
	} else {
		echo "<br>创建数据表 member错误: " . mysqli_error($conn);
	}

	//创建帖子表 tiopic
	$shell = "CREATE TABLE tiopic (
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 `main_id` INT(11) NOT NULL,
 `author` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `last_post_time` datetime NOT NULL
);";
	if (mysqli_query($conn, $shell)) {
		echo "<p>数据表 tiopic 创建成功辣</p>";
	} else {
		echo "<br>创建数据表 tiopic 错误: " . mysqli_error($conn);
	}

	//创建帖子回复表 tiopic_reply
	$shell = "CREATE TABLE tiopic_reply (
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 `main_id` INT(11) NOT NULL, 
 `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `last_post_time` datetime NOT NULL
);";
	if (mysqli_query($conn, $shell)) {
		echo "<p>数据表 tiopic_reply 创建成功辣</p>";
	} else {
		echo "<br>创建数据表 tiopic_reply 错误: " . mysqli_error($conn);
	}

	//创建数据库成功！！！
	echo "<br>Hello, " . $dbname;
	?>
</body>

</html>
</body>

</html>