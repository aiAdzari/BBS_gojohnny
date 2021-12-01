<?php
header('content-type:application/json;charset=utf8');
session_start();
// 创建连接
if (empty($_GET['id'])) {
    $id = !empty($_SESSION['id']) ? $_SESSION['id'] : 1;
} else {
    $_SESSION['id'] = $_GET['id'];
    $id = $_GET['id'];
}
require('conn.php');

    $perpage=10;//每页显示的数据个数
	$total_sql="select count(*) from tiopic_reply where main_id = '$id'";
	$total_result =mysqli_query($conn,$total_sql);
	$total_row=mysqli_fetch_row($total_result);
	$total = $total_row[0];//获取最大页码数
	$total_page = ceil($total/$perpage);//向上取一个整数

$user=array("total_page"=>$total_page ,"reply_num"=>$total_row,);
if (!empty($user)) {
    echo json_encode($user);
} else {
    echo 1;
}
?>