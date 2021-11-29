<?php
header('content-type:application/json;charset=utf8');
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 1; //接收页码
$page = !empty($page) ? $page : 1;   //页码若为空则默认设置为1
if (empty($_GET['F'])) {
    $F = !empty($_SESSION['F']) ? $_SESSION['F'] : 1;
} else {
    $_SESSION['F'] = $_GET['F'];
    $F = $_GET['F'];
}
// 创建连接
require('conn.php');

$table_name = "tiopic"; //查取表名设置
$perpage = 15; //每页显示的数据个数
//最大页数和总记录数
$total_sql = "select count(*) from $table_name";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_row($total_result);
$total = $total_row[0]; //获取最大页码数
$total_page = ceil($total / $perpage); //向上取一个整数
//临界点
$page = $page > $total_page ? $total_page : $page; //当下一页数大于最大页数时的情况
$page = $page ? $page : 1;
//分页设置初始化
$start = ($page - 1) * $perpage;
//$start = 0;
$sql = "select * from tiopic where main_id = '$F' order by id desc limit $start ,$perpage"; //获取帖子信息
$que = mysqli_query($conn, $sql);
if (!$que) {
    printf("Error: %s\n", mysqli_error($conn));
    exit(); //这一段代码救了我的命，拯救了我一晚上，在此留下记号。
}
$sum = mysqli_num_rows($que);

if ($sum > 0) {
    while ($row = mysqli_fetch_assoc($que)) {
        $results[] = $row;
    }
}
if ($results) {
    echo json_encode($results);
} else {
    echo false;
}
?>