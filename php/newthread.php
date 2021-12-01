<?php
$login = false;
session_start(); //链接session
require('conn.php'); //连接数据库
if (!check_login()) //验证登录状态
{
	echo "<script>alert('请登录后再进行发帖');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") //检测是否POST表单

{
	$Err = 0;
	$author = $_SESSION['username'];
	date_default_timezone_set("PRC");
	$last_post_time = date("Y-m-d H:i:s"); //提取表单数据
	if (empty($_POST["title"])) {
		echo "<script>alert('未输入标题');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		$Err += 1;
	} else {
		$title = test_input($_POST["title"]);
	}
	if (empty($_POST["content"])) {
		echo "<script>alert('未输入内容');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		$Err += 1;
	} else {
		$content = test_input($_POST['content']);
	}

	$F = $_SESSION['F']; //重要！获取当前论坛id
	if ($Err == 0) {
		$sql = "insert into tiopic(main_id,author,title,content,last_post_time) values('$F','$author','$title','$content','$last_post_time')";
		$que = mysqli_query($conn, $sql);
		if ($que) {
			echo "<script>alert('发布成功qaq');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		} else {
			echo "<script>alert('出错啦哈哈，有人又要忙了，笑晕了');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
		}
	} else {
		echo false;
	}
}
function check_login()
{
	if (isset($_SESSION['login']) && $_SESSION['login'] === true)
		return $_SESSION['level'];
	else
		return false;
}
function test_input($data)
//过滤用户输入的非法字符
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
