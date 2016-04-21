<div class="row">	
	<h1>View Purchase Orders</h1>			
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>PO Number</th>
					<th>Description</th>
					<th>Cost</th>
					<th>Paid/Unpaid</th>
					<th>View</th>
					<th>Edit</th>
				</tr>
				<?php echo getPurchaseOrders(); ?>
			</table>
		</div>
	</div>	
</div>