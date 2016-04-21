<div class="row">
	<div class="col-md-12">	
		<h1>Transfer Equipment to Location</h1>		
		<form action="inventory/transferlocation" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="locationselect">Transfer Equipment</label>				
				<select class="form-control" id="locationselect" name="location">
					<?php echo generateLocationSelectList(); ?>
				</select>
			</div>
			<div class="form-group">				
				<table class="table">
				<tr>					
					<th>Product ID</th>
					<th>Description</th>
					<th>Available</th>	
					<th>Quantity to Transfer</th>	
				</tr>				
					<?php echo generateTransferInventoryList(); ?>
				</table>
			</div>
			<button type="submit" class="btn btn-success">Submit Equipment Transfer</button>
		</form>
	</div>
</div>