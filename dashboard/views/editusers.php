<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Edit User</h1>
		<?php if( $editingallowed == true ) { ?>
			<form action="users/edit/<?php echo $edituser->getID(); ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="emailinput">Email Address</label>
					<input type="email" class="form-control" id="emailinput" name="email" placeholder="Email" required value="<?php echo $edituser->getEmail(); ?>" />
				</div>
				<div class="form-group">
					<label for="firstnameinput">First Name</label>
					<input type="text" class="form-control" id="firstnameinput" name="firstname" placeholder="First Name" required value="<?php echo $edituser->getFirstName(); ?>" />
				</div>
				<div class="form-group">
					<label for="lastnameinput">Last Name</label>
					<input type="text" class="form-control" id="lastnameinput" name="lastname" placeholder="Last Name" required value="<?php echo $edituser->getLastName(); ?>" />
				</div>
				<?php
					if( $user->getRole() == "admin" ){
				?>
				<div class="form-group">
					<label for="employeeidinput">Employee ID</label>
					<input type="text" class="form-control" id="employeeidinput" name="employeeid" placeholder="Employee ID" value="<?php echo $edituser->getEmployeeID(); ?>" />
				</div>
				<?php } ?>
				<div class="form-group has-feedback passwordinput">
					<label for="passwordinput">Password (Leave blank to keep same password)</label>
					<input type="password" class="form-control" id="passwordinput" name="password" pattern=".{7,}" title="Passwords must be at minimum 7 characters long" />
				</div>
				<div class="form-group has-feedback passwordinputrepeat">
					<label for="repeatpasswordinput">Repeat Password</label>
					<input type="password" class="form-control" id="repeatpasswordinput" name="repeatpassword" />
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
				</div>
				<?php
					if( $user->getRole() == "admin" ){
				?>
					<div class="form-group">
						<label for="userroleinput">Employee Position</label>
						<select class="form-control" id="userroleinput" name="role">				
							<?php echo generateUserOptions(); ?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="locationinput">Employee Location</label>
						<select class="form-control" id="locationinput" name="location">
							<?php echo generateLocationSelectList(); ?>
						</select>
					</div>
				<?php } ?>
				<button type="submit" class="btn btn-default">Update User</button>
			</form>
		<?php } else if ( $editingallowed == false) { ?>
			<h3><?php echo $validationmessage; ?></h3>
		<?php } ?>
	</div>
</div>