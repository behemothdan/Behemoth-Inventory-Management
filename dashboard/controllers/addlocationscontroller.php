<?php
	$validationmessage = "";
	$createnewlocation = true;
	
	if( !empty($_POST)){
		global $validationmessage;				
		createNewLocation($_POST["locationnameinput"], $_POST["addressinput"], $_POST["cityinput"], $_POST["stateinput"], $_POST["zipinput"], $_POST["phoneinput"]);	
		if( $status == 1 ){
			echo "<div class='col-md-12 alert alert-success alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>The new location was added successfully.</div>";
		} else {
			echo "<div class='col-md-12 alert alert-warning alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>There was an error adding the location. Please try again or contact support.</div>";
		}
	}
?>