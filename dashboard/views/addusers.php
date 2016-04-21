<div class="row">
	<div class="col-md-8 col-md-offset-2">	
		<h1>Add User</h1>		
		<form action="users/add" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="emailinput">Email Address</label>
				<input type="email" class="form-control" id="emailinput" name="email" placeholder="Email" required />
			</div>
			<div class="form-group">
				<label for="firstnameinput">First Name</label>
				<input type="text" class="form-control" id="firstnameinput" name="firstname" placeholder="First Name" required />
			</div>
			<div class="form-group">
				<label for="lastnameinput">Last Name</label>
				<input type="text" class="form-control" id="lastnameinput" name="lastname" placeholder="Last Name" required />
			</div>
			<div class="form-group">
				<label for="employeeidinput">Employee ID</label>
				<input type="text" class="form-control" id="employeeidinput" name="employeeid" placeholder="Employee ID" />
			</div>
			<div class="form-group has-feedback passwordinput">
				<label for="passwordinput">Password</label>
				<input type="password" class="form-control" id="passwordinput" name="password" pattern=".{7,}" title="Passwords must be at minimum 7 characters long" />
			</div>
			<div class="form-group has-feedback passwordinputrepeat">
				<label for="repeatpasswordinput">Repeat Password</label>
				<input type="password" class="form-control" id="repeatpasswordinput" name="repeatpassword" />
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
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
			<button type="submit" class="btn btn-success">Add New User</button>
		</form>
	</div>
</div>