<div class="row col-md-8 col-md-offset-2">	
	<h1>Add Location Managers</h1>
	<form action="locations/managers/add" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="selectlocation">Select Location</label>
			<select class="form-control" id="selectlocation" name="selectlocation">
				<?php echo generateLocationSelectList(); ?>
			</select>
		</div>
		
		<div class="form-group">
			<label for="selectmanager">Select Manager</label>
			<select class="form-control" id="selectmanager" name="selectmanager">
				<?php echo generateManagerSelectList(); ?>
			</select>
		</div>		
		
		<button type="submit" class="btn btn-default">Add New Location Manager</button>
	</form>
</div>