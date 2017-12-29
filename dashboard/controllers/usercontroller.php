<?php
	$validationmessage = "";
	$createnewuser = true;
	
	if( !empty($_POST) ){
		global $validationmessage;

		// This will return a value greater than 0 if the email or employee ID already exist in the system
		$doesexist = checkUserExists($_POST["email"], $_POST["employeeid"]);		
				
		if( $doesexist == 0 ) {
			if( $_POST['password'] != $_POST['repeatpassword'] ){
				$validationmessage = "Your passwords must match.";
				$creatnewuser = false;
			}
			
			if( $createnewuser == true ) {
				$createsuccess = createNewUser($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['employeeid'], $_POST['password'], $_POST['role'], $_POST['location']);
				if( $createsuccess == 1 ){
					echo "<div class='col-md-12 alert alert-success alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>The new user was created successfully.</div>";
				} else {
					echo "<div class='col-md-12 alert alert-warning alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>There was an error creating the user. Please try again or contact support.</div>";
				}
			}
		}			
	}
?>