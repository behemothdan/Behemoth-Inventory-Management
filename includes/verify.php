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
	$sql="SELECT * FROM $tbl_name WHERE email='$myemail' and password='$encryptedpassword'";
	$count = $db->prepare($sql);
	$count->execute();
	$count = $count->fetchAll();

	session_start();

	if($count[0][0]==1){
		$_SESSION["myemail"] = $myemail;
		$_SESSION["encryptedpassword"] = $encryptedpassword; 		
		header("location:../dashboard/");
	}
	else {
		header("location:../index.php");
	}
?>