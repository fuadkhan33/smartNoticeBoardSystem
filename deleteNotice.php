<?php
	include('User.php');
	$noticeID = $_GET['noticeID'];
	$adminUser = new AdminUser;
	$adminUser->deleteNotice($noticeID);
	header('Location: home.php')
?>