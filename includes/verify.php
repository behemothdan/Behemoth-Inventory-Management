<?php
	require '../includes/connection.php';
	connect();

	$tbl_name="users";

	$myemail=$_POST['email']; 
	$mypassword=$_POST['password'];	

	// To protect MySQL injection
	$myemail = stripslashes($myemail);
	$mypassword = stripslashes($mypassword);
	$encryptedpassword = md5($mypassword);
	$count=$db->query("SELECT count(*) FROM $tbl_name WHERE email='$myemail' and password='$encryptedpassword'")->fetchColumn();

	session_start();

	if( $count == 1 ){
		$_SESSION["myemail"] = $myemail;
		$_SESSION["encryptedpassword"] = $encryptedpassword;
		header("location:../dashboard/");
	}
	else {
		header("location:../index.php");
	}
?>