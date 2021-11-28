<?php
require('conn.php');// 链接数据库

session_start(); //链接session
$login = false;
$_SESSION['login'] = null;

$username=$_POST['username'];
$password=md5($_POST['password']);
$email=trim($_POST['email']);
$log_time=date("Y-m-d H:i:s");

$sql1="SELECT * from member where username='$username'";
$que=mysqli_query($conn,$sql1);
$row=mysqli_fetch_array($que);

if($row){
    echo"<script>alert('用户名已经被注册');location.href='reg.html';</script>";
}else{
    $sql="INSERT into member(username,password,email,log_time)VALUES
    ('$username','$password','$email','$log_time')";
    $que=mysqli_query($conn,$sql);
			if (!$que) {
				printf("Error: %s\n", mysqli_error($conn));
			exit();}
    $_SESSION['username']=$username;
    echo "<script>alert('注册成功');location.href='../login';</script>";
}
?>