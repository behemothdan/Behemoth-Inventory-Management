<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h1>Process Pending Equipment Transfers</h1>
	<?php
		$status =  getProcessedStatus($currentpendingtransfer->getTransferId());
		$userrole = $user->getRole();
		
		if( $status == 0 ){	
	?>
	<form action="inventory/pending/<?php echo $currentpendingtransfer->getTransferId(); ?>" method="post" enctype="multipart/form-data">
		<div class="page-header">
			<h2><small>Transfer Location</small> <?php echo $currentpendingtransfer->getLocationName(); ?></h2>
			<h3><small>Submitted By</small> <?php echo $currentpendingtransfer->getSubmittedFirstName(); ?> <?php echo $currentpendingtransfer->getSubmittedLastName(); ?></h3>
			<h3><small>Transfer ID</small> <?php echo $currentpendingtransfer->getTransferId(); ?> <small>Date Submitted</small> <?php echo $currentpendingtransfer->getDateSubmitted(); ?></h3>
			<input type="hidden" name="locationid" value="<?php echo $currentpendingtransfer->getLocationId(); ?>" />
		</div>	
		<table class="table">
			<tr>
				<th>Product ID</th>
				<th>Description</th>				
				<th>Quantity Sent</th>
				<th>Quantity Received</th>
			</tr>
			<?php echo getPendingLocationTransferLineItems($currentpendingtransfer->getTransferId()); ?>
		</table>
		<div class="col-md-12 alert alert-info">
			<p><strong>Heads up!</strong> Please be aware that if you indicate that the amount you received of a product does not match the quantity filled out by the submitter, you will be contacted in order to help resolve equipment discrepancies.</p>
		</div>
		<div class="col-md-2">
			<?php if( $userrole == "manager" ) { ?>
				<button type="submit" class="btn btn-primary">Accept Equipment Transfer</button>
			<?php } ?>
		</div>
	</form>
	<?php } elseif ($status == 1) { ?>	
		<div class="col-md-12 alert alert-info">
			<p>This Equipment Transfer has been processed.</p>
		</div>		
	<?php } ?>
</div>