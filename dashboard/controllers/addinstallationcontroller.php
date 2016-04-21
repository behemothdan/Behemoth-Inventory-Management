<?php
	global $match;
	global $user;
	$urlstatus = $match['params'];
	
	global $locationurl;
	$locationurl = $urlstatus["id"];		

	if( !empty($_POST)){				
		$itemtransfercount = count($_POST['itemid']);				
		$lineitemcounter = 0;		
		
		$productidarray = $_POST['itemid'];
		$productquantityarray = $_POST['itemquantity'];				
		
		// Basic Customer Information
		$customername = $_POST["customernameinput"];
		$address = $_POST["addressinput"];
		$city = $_POST["cityinput"];
		$state = $_POST["stateinput"];
		$zip = $_POST["zipinput"];
		$installdate = $_POST["dateinput"];
		$customerid = $_POST["csidinput"];
		$notes = $_POST["notesinput"];
		$installtype = $_POST["installationtype"];
		$techid = $user->getID();
		
		$newinstallid = addNewInstallation( $customername, $address, $city, $state, $zip, $installdate, $customerid, $notes, $installtype, $techid );
		
		if( $newinstallid > 0 ){
			while ( $lineitemcounter < $itemtransfercount ){
				addInstallationInventory($newinstallid, $productidarray[$lineitemcounter], $productquantityarray[$lineitemcounter]);
				$lineitemcounter++;
			}		
		}
	}
?>