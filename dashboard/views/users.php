<div class="row">
	<h1>Employee List</h1>
	<div class="container">
		<div class="panel panel-default table-responsive">
			<div class="panel=heading"></div>
			<table class="table">
				<tr>					
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Location</th>
					<th>Employee ID</th>
					<th>Position</th>		
					<?php if( $user->getRole() == "admin" ) { ?>
					<th>Edit User</th>
					<?php } ?>
				</tr>
				<?php echo generateUserList(); ?>
			</table>
		</div>
	</div>
</div>