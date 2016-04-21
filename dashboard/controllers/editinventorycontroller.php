<?php
	if( !empty($_POST)){	
		$itemquantityarray = $_POST["itemquantity"];
		$itemidarray = $_POST["itemid"];
		
		$lineitemcount = count($_POST['itemquantity']);				
		$itemcounter = 0;
		
		while( $itemcounter < $lineitemcount ){		
			$productid = $itemidarray[$itemcounter];
			$productquantity = $itemquantityarray[$itemcounter];
			
			$status = updateInventoryQuantities( $productid, $productquantity );
			$itemcounter++;
		}		
		
		if( $status == 1 ){
			echo "<div class='col-md-12 alert alert-success alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>The inventory items were successfully updated.</div>";
		} else {
			echo "<div class='col-md-12 alert alert-warning alert-dismissable' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>There was an error updating one or more inventory items. Please try again or contact support.</div>";
		}
	}
?>