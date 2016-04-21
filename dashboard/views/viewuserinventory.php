<div class="row">
	<h1>Employee Inventory for <?php echo $user->getFirstName(); ?> <?php echo $user->getLastName(); ?></h1>
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel-heading"></div>
			<table class="table">
				<tr>					
					<th>Product ID</th>
					<th>Description</th>
					<th>Quantity</th>	
				</tr>
				<?php echo generateUserInventoryTable(); ?>
			</table>
		</div>
	</div>
</div>