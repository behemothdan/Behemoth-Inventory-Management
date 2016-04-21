<div class="row">
	<h1>Inventory</h1>
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>Product ID</th>
					<th>Description</th>
					<th>Average Cost</th>
					<th>Weight</th>
					<th>Point Value</th>
					<th>Quantity</th>
					<th>Location Quantity</th>
					<th>Tech Quantity</th>
				</tr>
				<?php echo generateCompleteInventoryList(); ?>
			</table>
		</div>
	</div>
</div>