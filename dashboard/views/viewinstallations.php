<div class="row">
	<h1>Installations and Services</h1>
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>Customer Name</th>
					<th>CSID</th>
					<th>Date of Service</th>						
					<?php if( $user->getRole() == "admin" ) { ?>
					<th>View Service Details</th>
					<?php } ?>
				</tr>
				<?php echo generateInstallationList(); ?>
			</table>
		</div>
	</div>
</div>