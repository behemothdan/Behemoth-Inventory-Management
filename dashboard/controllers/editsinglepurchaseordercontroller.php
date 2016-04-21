<?php
	global $validationmessage;
	$validationmessage = "";
	
	global $podetails;
	global $polineitems;
	global $currentponumber;
	
	global $match;
	global $user;
	$urlstatus = $match['params'];
	
	if( $user->getID() != $urlstatus["id"] && $user->getRole() != "admin" ) {
		$validationmessage = "You do not have permission to edit this page.";		
		$editingallowed = false;		
	}
		
	if ( empty($_POST) ) {
		// Initially load the PO data
		$podetails = getPoDetails($urlstatus["id"]);
		$polineitems = generateEditPoLineItems($podetails['ponumber']);
	
		$currentponumber = $podetails['ponumber'];		
	}			
	
	if( !empty($_POST) ){
		// We need to store the original PO in case we need to update individual line items with a new one
		// We also need the item quantity before update so we can update the inventory appropriately
		$podetails = getPoDetails($urlstatus["id"]);
		$polineitems = generateEditPoLineItems($podetails['ponumber']);
		$currentponumber = $podetails['ponumber'];		
	
		$poupdated = updatePoDetails( $_POST['ponumber'], $_POST['ordertotal'], $_POST['paidstatus'], $_POST['description'] );
		
		if( $poupdated == 1 ){
			$lineitemcount = count($_POST['productquantity']);
			$itemcounter = 0;
			
			$productidarray = $_POST['productid'];
			$productquantityarray = $_POST['productquantity'];						
			
			while( $itemcounter < $lineitemcount ){
				$currentquantity = getPoItemQuantity( $productidarray[$itemcounter], $currentponumber );
				$quantitychange = $productquantityarray[$itemcounter] - $currentquantity;				
				updateInventoryItemQuantity( $productidarray[$itemcounter], $quantitychange );
				
				updatePurchaseOrderLineItem( $currentponumber, $_POST['ponumber'], $productquantityarray[$itemcounter], $productidarray[$itemcounter] );								
				$itemcounter++;
			}

			echo "<div class='col-md-12 alert alert-success alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>The purchase order was successfully updated.</div>";
		} else {
			echo "<div class='col-md-12 alert alert-warning alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>There was an error updating the purchase order. Please try again or contact support.</div>";
		}
		
		// Force the page to reload the data after submitting updates
		$podetails = getPoDetails($urlstatus["id"]);
		$polineitems = generateEditPoLineItems($podetails['ponumber']);			
				
	}	
?>