<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	$basicUser = new BasicUser;
	$message_id = $_GET['message_id'];
	$basicUser->deleteMessageById($message_id);
	header("Location: messages.php");	
?>