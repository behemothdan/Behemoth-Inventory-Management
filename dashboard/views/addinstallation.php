<div class="row col-md-8 col-md-offset-2">	
	<h1>Add Installation</h1>	
	<form action="installations/add" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="installationtype">Installation Type</label>
			<select class="form-control" id="installationtype" name="installationtype">
				<option value="install">New Installation</option>
				<option value="service">Service</option>
			</select>
		</div>
		<div class="form-group">
			<label for="csidinput">CSID</label>
			<input type="text" class="form-control" id="csidinput" name="csidinput" placeholder="CSID" required />
		</div>			
		<div class="form-group">
			<label for="dateinput">Date</label>
			<input type="text" class="form-control" id="dateinput" name="dateinput" placeholder="Date" required />
		</div>	
		<div class="form-group">
			<label for="customernameinput">Customer Name</label>
			<input type="text" class="form-control" id="customernameinput" name="customernameinput" placeholder="Customer Name" required />
		</div>
		<div class="form-group">
			<label for="addressinput">Address</label>
			<input type="text" class="form-control" id="addressinput" name="addressinput" placeholder="Address" required />
		</div>		
		<div class="form-group">
			<label for="cityinput">City</label>
			<input type="text" class="form-control" id="cityinput" name="cityinput" placeholder="City" required />
		</div>
		<div class="form-group">
			<label for="stateinput">State</label>
			<input type="text" class="form-control" id="stateinput" name="stateinput" placeholder="State" required />
		</div>
		<div class="form-group">
			<label for="zipinput">State</label>
			<input type="text" class="form-control" id="zipinput" name="zipinput" placeholder="ZIP" required />
		</div>			
		<div class="form-group">
			<table class="table">
				<tr>					
					<th>Product ID</th>
					<th>Description</th>
					<th>Available</th>	
					<th>Quantity to Transfer</th>	
				</tr>				

				<?php echo generateUserInventoryInstallTable(); ?>
			</table>
		</div>
		<div class="form-group">
			<label for="notesinput">Notes</label>
			<textarea rows="4" class="form-control" id="notesinput" name="notesinput"></textarea>			
		</div>					
		<button type="submit" class="btn btn-default">Add Installation</button>
	</form>
</div>