<?php
header('content-type:application/json;charset=utf8');
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true){
	$user=array("msg"=>'true' ,"username"=>$_SESSION['username'], "id"=>$_SESSION['id'], "level"=>$_SESSION['level'], "title"=>$_SESSION['title'], "log_time"=>$_SESSION['log_time']);
}	
else{
	$user=array("msg"=>'false');
}
	echo json_encode($user);

?>