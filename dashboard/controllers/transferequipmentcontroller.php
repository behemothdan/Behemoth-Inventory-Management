<?php
	if( !empty($_POST)){	
		global $user;
		$currentdate = date('Y/m/d H:i:s');
		$newtransferid = createNewLocationTransfer($_POST['location'], $user->getID());
		
		$itemtransfercount = count($_POST['itemid']);
		
		$lineitemcounter = 0;
		
		$productidarray = $_POST['itemid'];
		$productquantityarray = $_POST['itemquantity'];
		
		while ( $lineitemcounter < $itemtransfercount ){
			addLocationTransferLineItems($newtransferid, $productidarray[$lineitemcounter], $productquantityarray[$lineitemcounter]);
			$lineitemcounter++;
		}
	}
?>