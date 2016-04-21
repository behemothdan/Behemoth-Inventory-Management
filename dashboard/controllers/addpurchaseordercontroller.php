<?php
	if( !empty($_POST)){	
		$poadded = createNewPurchaseOrder($_POST['ponumber'], $_POST['description'], $_POST['ordertotal']);		
		
		if( $poadded == 1 ){
			$lineitemcount = count($_POST['productid']);			
			
			$itemcounter = 0;
			
			$productidarray = $_POST['productid'];
			$productdescriptionarray = $_POST['productdescription'];
			$productquantityarray = $_POST['productquantity'];
			$productcostarray = $_POST['productcost'];
			$productweightarray = $_POST['productweight'];
			$productpointvaluearray = $_POST['productpointvalue'];
			
			while( $itemcounter < $lineitemcount ){				
				$currentitem = getInventoryItemDetails($productidarray[$itemcounter]);
			
				addPurchaseOrderLineItem($_POST['ponumber'], 
				$currentitem['partnumber'], 
				$productquantityarray[$itemcounter], 
				$currentitem['description'],
				$productcostarray[$itemcounter], 
				$productweightarray[$itemcounter], 
				$productpointvaluearray[$itemcounter]);
				
				$productexists = checkItemExists($currentitem['partnumber']);
				
				if( $productexists == 0 ) {
					addInventoryItem($currentitem['partnumber'], 
					$productquantityarray[$itemcounter], 
					$currentitem['description'],	
					$productcostarray[$itemcounter], 
					$productweightarray[$itemcounter], 
					$productpointvaluearray[$itemcounter]);				
				} elseif ( $productexists == 1 ){
					updateInventoryItem($currentitem['partnumber'], 
					$productquantityarray[$itemcounter], 
					$currentitem['description'],
					$productcostarray[$itemcounter], 
					$productweightarray[$itemcounter], 
					$productpointvaluearray[$itemcounter]);
				}
				
				$itemcounter++;
			}
		}		
	}
?>