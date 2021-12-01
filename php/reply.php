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
	$page= isset($_GET['page']) ?$_GET['page'] : 1 ;//接收页码
	$page= !empty($page) ? $page : 1;
	$total_sql="select count(*) from tiopic_reply where main_id = '$id'";
	$total_result =mysqli_query($conn,$total_sql);
	$total_row=mysqli_fetch_row($total_result);
	$total = $total_row[0];//获取最大页码数
	$total_page = ceil($total/$perpage);//向上取一个整数
	//临界点
	$page=$page>$total_page ? $total_page:$page;//当下一页数大于最大页数时的情况
	$page= $page ? $page : 1;
	//分页设置初始化
	$start=($page-1)*$perpage;
	//$start = 0;
	$sql_reply="select * from tiopic_reply where main_id = '$id' order by id asc limit $start ,$perpage";//获取帖子信息
	$que_reply=mysqli_query($conn,$sql_reply);

    $sum = mysqli_num_rows($que_reply);
    if ($sum > 0) {
        while ($row_reply=mysqli_fetch_assoc($que_reply)) {
            $results[] = $row_reply;
        }
    }

if (!empty($results)) {
    echo json_encode($results);
} else {
    echo 1;
}
?>