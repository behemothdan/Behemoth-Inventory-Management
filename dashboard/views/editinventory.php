<div class="row">
	<div class="col-md-12">
		<h1>Edit Inventory</h1>
		<form action="inventory/edit" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<table class="table">
					<tr>					
						<th>Product ID</th>
						<th>Description</th>
						<th>Quantity in Warehouse</th>							
					</tr>				
					<?php echo generateUpdatedInventoryQuantityList(); ?>
				</table>			
			</div>
			<button type="submit" class="btn btn-primary">Submit Updated Quantities</button>
		</form>
	</div>
</div>