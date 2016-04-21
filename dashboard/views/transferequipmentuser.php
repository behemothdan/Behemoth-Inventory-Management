<div class="row">
	<h1>Location List</h1>
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>Location</th>
					<th>Phone Number</th>
					<th>Manage</th>
				</tr>				
				<?php echo getTransferTechLocationList( $user->getEmployeeID() ); ?>
			</table>
		</div>
	</div>
</div>