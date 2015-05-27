<?php
include "operation.php";
$user=new user();
session_start();
if(isset($_GET['action'])){

	$user->logout($_SESSION['email'],$_SESSION['login_time']);
	
	header("location:login.php");
	session_destroy();


}
?>