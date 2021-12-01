<?php
header('content-type:application/json;charset=utf8');
$login = false;
session_start(); //链接session

require('conn.php');

if (empty($_GET['id']))
{
	$id=!empty($_SESSION['id'])?$_SESSION['id']:1;
}
else
{
	$_SESSION['id']=$_GET['id'];
	$id=$_GET['id'];
}

$sql="select * from tiopic where id='$id'";
$que=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($que);

if (!empty($row)) {
    echo json_encode($row);
} else {
    echo 0;
}