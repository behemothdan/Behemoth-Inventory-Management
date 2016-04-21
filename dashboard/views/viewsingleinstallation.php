<div class="row">
	<div class="col-md-12">
		<h1>Installation and Service Details</h1>
		<div class="container">
			<div class="row">
				<h2>Customer Information</h2>
				<div class="col-md-6">
					<address>
						<strong><?php echo $installdetails[0][1]; ?></strong><br />
						<?php echo $installdetails[0][2]; ?><br />
						<?php echo $installdetails[0][3]; ?>, <?php echo $installdetails[0][4]; ?> <?php echo $installdetails[0][5]; ?><br />
						<abbr title="CSID">CSID:</abbr> <?php echo $installdetails[0][7]; ?><br />
						<abbr title="Type of Service">Service:</abbr> <?php echo ucwords($installdetails[0][9]); ?><br />
						Date: <?php echo $installdetails[0][6]; ?>
					</address>
				</div>
				<div class="col-md-6">
					Tech: <abbr title="<?php echo $installdetails[0][12]; ?>"><?php echo $installdetails[0][14]; ?> <?php echo $installdetails[0][15]; ?></abbr>
					<h4>Notes<h4>
					<blockquote>
						<p>
							<?php echo $installdetails[0][8]; ?>
						</p>
					</blockquote>
				</div>
			</div>
			<div class="row">
				<h2>Equipment Installation</h2>
					<div class="panel panel-default table-responsive">						
						<table class="table">
							<tr>					
								<th>Product ID</th>
								<th>Description</th>
								<th>Quantity Installed</th>	
							</tr>
							<?php echo $installlineitems; ?>
						</table>
					</div>				
			</div>
		</div>
	</div>
</div>