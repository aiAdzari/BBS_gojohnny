<?php
$login = false;
session_start(); //链接session
unset($_SESSION['login']);
unset($_SESSION['level']);

session_destroy();

echo"<script>alert('退出成功');location.href='../index.html';</script>";
?>