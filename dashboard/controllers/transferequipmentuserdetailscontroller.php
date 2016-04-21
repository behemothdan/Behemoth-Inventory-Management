<?php
	global $match;
	$urlstatus = $match['params'];
	
	global $locationurl;
	$locationurl = $urlstatus["id"];

	if( !empty($_POST)){		
		$itemtransfercount = count($_POST['itemid']);
		
		$techid = $_POST['technician'];		
		
		$lineitemcounter = 0;
		
		$productidarray = $_POST['itemid'];
		$productquantityarray = $_POST['itemquantity'];		
		
		while ( $lineitemcounter < $itemtransfercount ){
			addTechInventory($techid, $productidarray[$lineitemcounter], $productquantityarray[$lineitemcounter], $locationurl);
			$lineitemcounter++;
		}
	}
?>