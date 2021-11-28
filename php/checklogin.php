<?php
$login = false;
session_start();

function check_login()
{
	if (isset($_SESSION['login']) && $_SESSION['login'] === true)
		return $_SESSION['level'];
	else
		return false;
}
?>