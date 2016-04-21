<?php
	global $validationmessage;
	$validationmessage = "";
	
	global $match;
	global $user;
	$urlstatus = $match['params'];
	
	global $editingallowed;
	$editingallowed = true;
	
	if( $user->getID() != $urlstatus["id"] && $user->getRole() != "admin" ) {
		$validationmessage = "You do not have permission to edit this page.";		
		$editingallowed = false;		
	}
	
	
	if( !empty($_POST)){
	
		global $validationmessage;
		
		if( $_POST['password'] == "" ){
			$password = NULL;			
		} else {
			$password = $_POST['password'];
		}
		
		// The role might be null if an employee is updating their account since they do not have permission to change their employee status
		// In the update function we will grab their current role and use it if this comes through as null
		if( $_POST['role'] == "" ){
			$role = NULL;
		} else {
			$role = $_POST['role'];
		}
		
		if( $_POST['location'] == "" ){
			$location = NULL;
		} else {
			$location = $_POST['location'];
		}
		
		$status = updateUser($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['employeeid'], $role, $location, $password);
		if( $status == 1 ){
			echo "<div class='col-md-12 alert alert-success alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>The user was updated successfully.</div>";
		} else {
			echo "<div class='col-md-12 alert alert-warning alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>There was an error updating the user. Please try again or contact support.</div>";
		}
	}
?>