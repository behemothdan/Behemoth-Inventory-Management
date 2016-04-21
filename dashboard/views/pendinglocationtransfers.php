<div class="row">	
	<h1>Pending Equipment Transfers</h1>			
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>Location</th>
					<th>Transfer Date</th>
					<th>Submitted By</th>					
					<th>Transfer ID</th>										
				</tr>
				<?php echo getCurrentPendingLocationTransfers($currentmanagerid); ?>
			</table>
		</div>
	</div>	
</div>