<?php
	global $match;
	$urlstatus = $match['params'];

	global $pendingtransfer;
	$pendingtransfer = $urlstatus["id"];
	
	global $currentpendingtransfer;
	$currentpendingtransfer = new LocationTransfer;
	getPendingLocationTransferDetails($pendingtransfer);	
	
	if( !empty($_POST)){	
		$lineitemcount = count($_POST['productid']);
		
		$itemcounter = 0;
		
		$productidarray = $_POST['productid'];
		$productquantitysentarray = $_POST['quantitysent'];
		$productquantityreceivedarray = $_POST['quantityreceived'];
		$locationid = $_POST['locationid'];							
		
		while( $itemcounter < $lineitemcount ){
			$productexists = checkItemExistsAtLocation($productidarray[$itemcounter], $locationid);
			
			
			if( $productexists == 0 ){
				addInventoryAtLocation( $locationid, $productidarray[$itemcounter], $productquantityreceivedarray[$itemcounter]);				
			} elseif ( $productexists == 1 ){
				updateInventoryItemAtLocation( $locationid, $productidarray[$itemcounter], $productquantityreceivedarray[$itemcounter]);
			}

			if( $productquantitysentarray[$itemcounter] != $productquantityreceivedarray[$itemcounter] ) {				
				addLocationDiscrepancies( $productidarray[$itemcounter], $productquantitysentarray[$itemcounter], $productquantityreceivedarray[$itemcounter], $pendingtransfer, $locationid);
			}
			
			$itemcounter++;
		}
		transferProcessed($pendingtransfer);
	}
?>