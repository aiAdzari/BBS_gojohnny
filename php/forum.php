<?php
    header('content-type:application/json;charset=utf8');  
    session_start(); 
    $page= isset($_GET['page']) ?$_GET['page'] : 1 ;//接收页码
    $page= !empty($page) ? $page : 1;   //页码若为空则默认设置为1
    if (empty($_GET['F']))
    {
    	$F=!empty($_SESSION['F'])?$_SESSION['F']:1;
    }
    else
    {
    	$_SESSION['F']=$_GET['F'];
    	$F=$_GET['F'];
    }

?>