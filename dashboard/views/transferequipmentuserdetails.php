<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Transfer Equipment to Technician</h1>
		<form action="inventory/transferuser/<?php echo $locationurl; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="technician">Select Technician</label>				
				<select class="form-control" id="technician" name="technician">
					<?php echo generateLocationTechList($locationurl); ?>
				</select>
			</div>				
			<div class="form-group">
				<table class="table">
					<tr>					
						<th>Product ID</th>
						<th>Description</th>
						<th>Available</th>	
						<th>Quantity To Transfer</th>	
					</tr>				

					<?php echo generateTransferUserInventoryList($locationurl); ?>
				</table>
			</div>
				<button type="submit" class="btn btn-default">Submit Equipment Transfer</button>
		</form>
	</div>
</div>