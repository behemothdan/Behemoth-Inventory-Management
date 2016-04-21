<?php
	$validationmessage = "";
	$createnewlocation = true;
	
	if( !empty($_POST)){
		global $validationmessage;
				
		createNewManager($_POST["selectlocation"], $_POST["selectmanager"]);
	}
?>