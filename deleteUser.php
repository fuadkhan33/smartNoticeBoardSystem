<?php
	include('User.php');
	$adminUser = new AdminUser;
	$adminUser->deleteUser($_GET['userID']);
	header("Location: dashBoard.php");
?>