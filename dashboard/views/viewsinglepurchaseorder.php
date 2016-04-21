<div class="row">
	<div class="col-md-12">
		<h1>Purchase Order Details</h1>
		<div class="container">
			<div class="row">
				<h2>Information</h2>
				<div class="col-md-6">
					<address>
						<h4>PO Number: <?php echo $podetails[1]; ?></h4><br />
						<h4>Cost: $<?php echo $podetails[3]; ?></h4>
					</address>
				</div>
				<div class="col-md-6">
					<?php
						if( $podetails['paid'] == 0 ){
							echo "<div class='alert alert-danger'>Unpaid</div>";
						} else if ( $podetails['paid'] == 1 ){
							echo "<div class='alert alert-success'>Paid</div>";
						}
					?>
					<h4>Description<h4>
					<blockquote>
						<p>
							<?php echo $podetails[2]; ?>
						</p>
					</blockquote>
				</div>
			</div>
			<div class="row">
				<h2>Equipment Purchased</h2>
					<div class="panel panel-default table-responsive">								
						<table class="table">
							<tr>					
								<th>Product ID</th>
								<th>Quantity</th>
								<th>Description</th>
								<th>Cost</th>
								<th>Weight</th>
								<th>Point Value</th>
							</tr>
							<?php echo $polineitems; ?>
						</table>						
					</div>				
			</div>
		</div>
	</div>
</div>