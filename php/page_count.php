<?php
header('content-type:application/json;charset=utf8');
session_start();
// 创建连接
if (empty($_GET['F'])) {
    $F = !empty($_SESSION['F']) ? $_SESSION['F'] : 1;
} else {
    $_SESSION['F'] = $_GET['F'];
    $F = $_GET['F'];
}
require('conn.php');

/* $page = isset($_GET['page']) ? $_GET['page'] : 1; //接收页码
$page = !empty($page) ? $page : 1;   //页码若为空则默认设置为1 */

$table_name = "tiopic"; //查取表名设置
$perpage = 10; //每页显示的数据个数
//最大页数和总记录数
$total_sql = "select count(*) from $table_name WHERE main_id='$F'";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_row($total_result);
$total = $total_row[0]; //获取最大页码数
$total_page = ceil($total / $perpage); //向上取一个整数

// $user=array("total_page"=>$total_page ,"page"=>$page,);
if ($total_page > 1) {
    echo $total_page;
} else {
    echo 1;
}
